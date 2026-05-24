# Release Packaging

Install npm dependencies if any are added in the future:

```bash
npm install
```

Create a local release ZIP:

```bash
npm run release
```

The release command runs the lightweight asset validation step and creates:

```text
release/dvly-bricks-elements.zip
```

The ZIP keeps the existing plugin root folder for compatibility:

```text
dvly-bricks-elements/
├─ dvly-bricks-elements.php
├─ README.md
├─ includes/
├─ elements/
└─ assets/
```

Keeping `dvly-bricks-elements/` as the ZIP root preserves compatibility with existing installs, the current plugin basename, and the current updater assumptions.

Development files such as `.git/`, `.github/`, `node_modules/`, `tools/`, `release/`, `package.json`, and `package-lock.json` are not packaged.

GitHub Actions release jobs should run the same `npm run release` command to keep CI ZIP output consistent with local releases.
