#!/usr/bin/env node

const fs = require('fs');
const path = require('path');

function fail(message) {
  console.error(`[assets] ERROR: ${message}`);
  process.exit(1);
}

function assertExists(root, relativePath) {
  const fullPath = path.join(root, relativePath);
  if (!fs.existsSync(fullPath)) {
    fail(`Missing expected runtime path: ${relativePath}`);
  }
}

function run() {
  const root = process.cwd();

  assertExists(root, 'dvly-bricks-elements.php');
  assertExists(root, 'includes');
  assertExists(root, 'elements');
  assertExists(root, 'assets');

  console.log('[assets] No asset compilation required yet. Runtime asset paths validated.');
}

run();
