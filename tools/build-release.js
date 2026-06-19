#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const os = require('os');
const cp = require('child_process');

const PLUGIN_SLUG = 'dvly-bricks-elements';
const MAIN_FILE = 'dvly-bricks-elements.php';

function fail(message) {
  console.error(`[release] ERROR: ${message}`);
  process.exit(1);
}

function info(message) {
  console.log(`[release] ${message}`);
}

function ensureDir(dirPath) {
  fs.mkdirSync(dirPath, { recursive: true });
}

function getPluginVersion(rootDir) {
  const mainFilePath = path.join(rootDir, MAIN_FILE);
  const contents = fs.readFileSync(mainFilePath, 'utf8');
  const match = contents.match(/^[ \t*]*Version:\s*([0-9]+(?:\.[0-9]+){1,3})\s*$/m);

  if (!match) {
    fail(`Could not determine plugin version from ${MAIN_FILE}`);
  }

  return match[1];
}

function escapePowerShellSingleQuoted(value) {
  return value.replace(/'/g, "''");
}

function getRuntimeEntries(rootDir) {
  const required = [
    MAIN_FILE,
    'README.md',
    'includes',
    'elements',
    'assets',
  ];
  const optional = ['languages', 'docs'];
  const entries = [];

  for (const entry of required) {
    const fullPath = path.join(rootDir, entry);
    if (!fs.existsSync(fullPath)) {
      fail(`Missing required runtime entry: ${entry}`);
    }
    entries.push(entry);
  }

  for (const entry of optional) {
    const fullPath = path.join(rootDir, entry);
    if (fs.existsSync(fullPath)) {
      entries.push(entry);
    }
  }

  return entries;
}

function shouldSkipFile(filePath) {
  const name = path.basename(filePath).toLowerCase();
  return name.endsWith('.log') || name.endsWith('.zip');
}

function packageWithPowerShell(rootDir, zipPath, entries) {
  const entriesArray = entries.map((entry) => `'${escapePowerShellSingleQuoted(entry)}'`).join(', ');
  const script = `
$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$root = '${escapePowerShellSingleQuoted(rootDir)}'
$zipPath = '${escapePowerShellSingleQuoted(zipPath)}'
$slug = '${PLUGIN_SLUG}'
$entries = @(${entriesArray})

if (Test-Path -LiteralPath $zipPath) {
  Remove-Item -LiteralPath $zipPath -Force
}

$zipFs = [System.IO.File]::Open($zipPath, [System.IO.FileMode]::Create)
try {
  $zip = New-Object System.IO.Compression.ZipArchive($zipFs, [System.IO.Compression.ZipArchiveMode]::Create, $false)
  try {
    foreach ($entry in $entries) {
      $fullPath = Join-Path $root $entry
      if (!(Test-Path -LiteralPath $fullPath)) {
        throw "Missing runtime entry: $entry"
      }

      $item = Get-Item -LiteralPath $fullPath
      if ($item.PSIsContainer) {
        $files = Get-ChildItem -LiteralPath $fullPath -File -Recurse
        foreach ($file in $files) {
          if ($file.Name.ToLower().EndsWith('.log') -or $file.Name.ToLower().EndsWith('.zip')) {
            continue
          }
          $relative = $file.FullName.Substring($root.Length).TrimStart('\\','/')
          $zipEntryPath = ($slug + '/' + $relative) -replace '\\\\','/'
          [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $file.FullName, $zipEntryPath, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
        }
      } else {
        if ($item.Name.ToLower().EndsWith('.log') -or $item.Name.ToLower().EndsWith('.zip')) {
          continue
        }
        $relative = $item.FullName.Substring($root.Length).TrimStart('\\','/')
        $zipEntryPath = ($slug + '/' + $relative) -replace '\\\\','/'
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $item.FullName, $zipEntryPath, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
      }
    }
  } finally {
    $zip.Dispose()
  }
} finally {
  $zipFs.Dispose()
}
`;

  cp.execFileSync('powershell.exe', ['-NoProfile', '-Command', script], {
    cwd: rootDir,
    stdio: 'inherit',
  });
}

function copyRuntimeEntry(rootDir, stageRoot, entry) {
  const src = path.join(rootDir, entry);
  const dest = path.join(stageRoot, entry);

  if (fs.statSync(src).isDirectory()) {
    fs.cpSync(src, dest, {
      recursive: true,
      filter: (source) => !shouldSkipFile(source),
    });
    return;
  }

  if (!shouldSkipFile(src)) {
    ensureDir(path.dirname(dest));
    fs.copyFileSync(src, dest);
  }
}

function packageWithZipCli(rootDir, zipPath, entries) {
  const stageDir = fs.mkdtempSync(path.join(os.tmpdir(), `${PLUGIN_SLUG}-release-`));
  const stageRoot = path.join(stageDir, PLUGIN_SLUG);
  ensureDir(stageRoot);

  try {
    for (const entry of entries) {
      copyRuntimeEntry(rootDir, stageRoot, entry);
    }

    ensureDir(path.dirname(zipPath));
    const relZipPath = path.relative(stageDir, zipPath);

    cp.execFileSync('zip', ['-rq', relZipPath, PLUGIN_SLUG], {
      cwd: stageDir,
      stdio: 'inherit',
    });
  } finally {
    fs.rmSync(stageDir, { recursive: true, force: true });
  }
}

function listZipEntries(zipPath) {
  if (process.platform === 'win32') {
    const script = `
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem
$zipPath = '${escapePowerShellSingleQuoted(zipPath)}'
$zip = [System.IO.Compression.ZipFile]::OpenRead($zipPath)
try {
  foreach ($entry in $zip.Entries) {
    $entry.FullName
  }
} finally {
  $zip.Dispose()
}
`;
    const out = cp.execFileSync('powershell.exe', ['-NoProfile', '-Command', script], { encoding: 'utf8' });
    return out.split(/\r?\n/).map((line) => line.trim()).filter(Boolean);
  }

  const out = cp.execFileSync('zipinfo', ['-1', zipPath], { encoding: 'utf8' });
  return out.split(/\r?\n/).map((line) => line.trim()).filter(Boolean);
}

function validateZip(zipPath) {
  if (!fs.existsSync(zipPath)) {
    fail(`ZIP was not created: ${zipPath}`);
  }

  const stat = fs.statSync(zipPath);
  if (stat.size <= 0) {
    fail(`ZIP is empty: ${zipPath}`);
  }

  const entries = listZipEntries(zipPath);
  const expectedMain = `${PLUGIN_SLUG}/${MAIN_FILE}`;

  if (!entries.includes(expectedMain)) {
    fail(`ZIP does not contain expected bootstrap file: ${expectedMain}`);
  }

  const blockedPrefixes = [
    `${PLUGIN_SLUG}/.git/`,
    `${PLUGIN_SLUG}/.github/`,
    `${PLUGIN_SLUG}/node_modules/`,
    `${PLUGIN_SLUG}/tools/`,
    `${PLUGIN_SLUG}/release/`,
  ];
  const blockedFiles = [
    `${PLUGIN_SLUG}/package.json`,
    `${PLUGIN_SLUG}/package-lock.json`,
  ];

  for (const entry of entries) {
    if (blockedFiles.includes(entry) || blockedPrefixes.some((prefix) => entry.startsWith(prefix))) {
      fail(`ZIP contains excluded entry: ${entry}`);
    }
  }

  return { stat, entries, expectedMain };
}

function run() {
  const rootDir = process.cwd();
  const releaseDir = path.join(rootDir, 'release');
  const version = getPluginVersion(rootDir);
  const zipPath = path.join(releaseDir, `${PLUGIN_SLUG}-${version}.zip`);
  const entries = getRuntimeEntries(rootDir);

  ensureDir(releaseDir);

  info(`Plugin slug: ${PLUGIN_SLUG}`);
  info(`Plugin version: ${version}`);
  info(`Package root: ${PLUGIN_SLUG}/`);
  info(`Packaging entries: ${entries.join(', ')}`);

  try {
    if (process.platform === 'win32') {
      packageWithPowerShell(rootDir, zipPath, entries);
    } else {
      packageWithZipCli(rootDir, zipPath, entries);
    }
  } catch (error) {
    fail(`Packaging failed: ${error.message}`);
  }

  const validation = validateZip(zipPath);

  info(`SUCCESS: Created installable plugin ZIP at ${zipPath}`);
  info(`Size: ${validation.stat.size} bytes`);
  info(`Contains bootstrap: ${validation.expectedMain}`);
}

run();
