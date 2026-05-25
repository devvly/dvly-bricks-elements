# TwoA Element Pattern

This document defines the standard implementation pattern for all new TwoA Bricks elements in this plugin.

## Location and Registration
- New PHP element files live in `elements/twoa/`.
- SCSS source files live in `assets/scss/twoa/`.
- Compiled runtime CSS files live in `assets/css/twoa/`.
- Element category must be `twoa-elements`.

## File Pattern Per Element
- One SCSS source file per element.
- One compiled CSS file per element.
- Example:
  - `assets/scss/twoa/hero.scss`
  - `assets/css/twoa/hero.css`

## Namespace
- Namespace is `twoa-be` (TwoA Bricks Elements).

## Naming Conventions
- Element `public $name` should use `twoa-*`. Example: `twoa-hero`.
- Control keys should use `twoa_*` for new controls.
- CSS classes should use `.brxe-twoa-be-{element}` with BEM-style children.
- Component CSS variables should use `--twoa-be-{element}-*`.
- Shared tokens should use `--twoa-be-*`.

## Markup and CSS Structure
- Root class format: `.brxe-twoa-be-{element}`.
- Child classes follow BEM naming. Example: `.brxe-twoa-be-hero__content`.
- All selectors must stay scoped under the element root.

## Bricks Control Mappings
- Use `{{SELECTOR}}` mappings for control-driven CSS.
- Prefer mapping controls to root custom properties.
- Prefer CSS variables for spacing/layout values used repeatedly.

## Token and Fallback Strategy
- Define global TwoA token aliases in `assets/scss/base/_tokens.scss`.
- Each token should use Bricks/global variables first with fallback values.
- Example pattern:
  - `--twoa-be-color-primary: var(--primary, #111111);`

## Output Safety
- Escape and sanitize all frontend output:
  - `esc_html()` for plain text.
  - `esc_attr()` for attributes.
  - `esc_url()` for URLs.
  - `wp_kses_post()` for trusted rich text.
- Sanitize class fragments with `sanitize_html_class()`.

## Backward Compatibility
- When renaming controls, keep safe read fallbacks in render logic.
- Do not remove legacy keys abruptly if saved Bricks data may still reference them.

## Legacy Boundary
- Legacy DVLY elements remain untouched unless a bug fix is required.
- New architecture work should happen in `elements/twoa/` only.

## Build and Release
- CSS must be compiled from SCSS before packaging.
- Local CSS compile command:
  - `npm run build:css`
- Release command must compile CSS first:
  - `npm run release`
- GitHub/CI releases should use the same release script for parity.

## Compiled CSS Editing Rule
- Do not edit compiled CSS directly.
- Exception: emergency hotfixes only, followed by syncing the SCSS source.

## Test Checklist
- Run PHP lint on changed PHP files.
- Run `npm run build:css`.
- Run `npm run release`.
- Confirm ZIP includes SCSS source, compiled CSS, updated PHP, and docs.
- Verify behavior in Bricks builder and frontend.
