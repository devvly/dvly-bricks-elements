# TwoA Element Standards

This is the canonical standards document for new TwoA Bricks elements in this plugin. The older `docs/twoa-element-pattern.md` remains for now, but this document should guide future implementation decisions.

## Purpose

TwoA elements are curated, opinionated Bricks Builder content blocks for new cloned sites. They should help clients build safe, consistent layouts without needing to understand every low-level Bricks option.

“The goal is not to replace Bricks. The goal is to provide a curated set of opinionated, client-friendly content blocks that reduce decision fatigue and allow non-technical users to build pages safely and consistently.”

Legacy DVLY elements remain compatibility-only. Do not rename or refactor legacy slugs, classes, files, categories, CSS handles, or behavior unless a specific backward-compatible bug fix is required.

## Naming Conventions

- PHP classes use `Brxe_TwoA_{Element_Name}`. Example: `Brxe_TwoA_Hero`.
- Bricks element slugs use `twoa-{element}`. Example: `twoa-hero`.
- Element files use kebab case under `elements/twoa/`. Example: `section-heading.php`.
- SCSS files use the same kebab-case element name under `assets/scss/twoa/`.
- Compiled CSS files use the same kebab-case element name under `assets/css/twoa/`.
- CSS root classes use `.brxe-twoa-be-{element}`.
- CSS child classes use BEM-style names. Example: `.brxe-twoa-be-hero__content`.
- CSS modifier classes use BEM-style modifiers. Example: `.brxe-twoa-be-hero--media-first`.
- Asset handles use `brxe-twoa-be-{element}`. Example: `brxe-twoa-be-hero`.
- Component CSS variables use `--twoa-be-{element}-*`.
- Local variable bridge aliases use `--twoa-*` and consume existing Bricks/global variables first.

## Folder Conventions

- New TwoA PHP elements live in `elements/twoa/`.
- Legacy compatibility elements stay in `elements/legacy/dvly/`.
- Shared SCSS primitives live in `assets/scss/base/`.
- TwoA SCSS source files live in `assets/scss/twoa/`.
- Runtime compiled TwoA CSS files live in `assets/css/twoa/`.
- Documentation lives in `docs/`.

## Control Conventions

- Controls should be client-safe and limited to decisions that matter for the block.
- Use clear groups such as Content, Media, Buttons, Layout, and Style.
- Prefer plain labels over technical labels.
- Use useful descriptions for controls that accept CSS length values.
- Use select controls for finite choices instead of free text.
- Keep advanced controls out of v1 unless they solve a real client need.
- Typography and color controls may exist where content hierarchy matters, but do not add excessive visual controls by default.
- Do not add standalone color controls when typography controls already include color.
- Any control that affects markup, classes, layout, or attributes must be allowlisted during render.
- Elements may offer a simple full-width content toggle when useful. The default should remain constrained by `--container-width` through a local TwoA alias.

## Default Content Conventions

- Defaults should be client-neutral, not TwoA-branded.
- Defaults should make the block understandable immediately after insertion.
- Defaults should avoid industry-specific copy unless the element itself is industry-specific.
- Buttons may include one safe default call to action when appropriate.
- Media should be optional unless the element purpose requires media.
- Missing media must not create a broken visual state.

## Frontend Markup Conventions

- Keep markup semantic and predictable.
- Use a root wrapper that matches the Bricks element root.
- Use an inner wrapper when needed for layout width and padding.
- Use content/media/action wrappers only when they serve the layout contract.
- Avoid unnecessary empty wrappers on the frontend.
- Heading tags must be allowlisted.
- Rich text areas should use `wp_kses_post()` and should be limited to places where rich text is expected.
- Plain text fields should render as plain text.

## Empty-State Conventions

- Frontend output should skip optional empty parts.
- Do not render empty buttons wrappers, media wrappers, or repeater lists.
- Keep required layout wrappers only when they define the element layout contract.
- Builder visibility should remain usable, but do not add complex builder-only placeholder systems until a real need is proven.

## Sanitization And Escaping Standards

- Use `esc_html()` for plain text output.
- Use `wp_kses_post()` for editor/rich text output.
- Use `esc_attr()` for attributes.
- Use `esc_url()` for direct URL output.
- Prefer Bricks link helpers such as `set_link_attributes()` for Bricks link controls.
- Use strict allowlists for heading tags, layout options, alignment, media position, button styles, and button sizes.
- Use `sanitize_html_class()` only after a value has already been validated when class fragments are dynamic.
- Do not directly echo raw `$this->settings` values.
- Cast defensive values before string functions when saved data may be malformed.

## CSS/SCSS Standards

- Keep styles scoped to the element root class.
- Use BEM-style classes for predictable selectors.
- Use per-element SCSS files and compiled CSS files.
- Use shared base mixins and breakpoints where they already exist.
- Avoid global CSS leaks.
- Avoid hardcoded styles that fight Bricks or theme global styles.
- Prefer CSS variables for repeated component values.
- TwoA elements should not introduce an independent design system.
- TwoA elements should use local `--twoa-*` aliases that consume existing Bricks/global variables first and provide safe fallbacks.
- Do not overwrite Bricks/global variables from the plugin.
- Do not output plugin-owned global `:root` design tokens from element CSS.
- Element CSS should use TwoA aliases after the bridge is defined, not raw Bricks/global variables directly throughout the component.
- Do not edit compiled CSS directly except for emergency hotfixes; update SCSS and rebuild.
- Padding and gap controls should use non-negative CSS length normalization.

## Asset Loading Standards

- Each TwoA element should enqueue only its own compiled CSS when the element is used.
- Do not globally enqueue all TwoA element CSS by default.
- Use `filemtime()` for local CSS versioning when the file exists.
- If a CSS file is missing, the element should fail gracefully without fatal errors.
- Avoid JavaScript unless the element cannot work correctly without it.

## Responsive Behavior Standards

- Mobile behavior should be predictable and readable by default.
- Use one-column stacking on small screens for split layouts.
- Apply side-by-side media/content layouts at a medium breakpoint or larger.
- If an element supports media left/right, keep mobile stacking graceful and apply ordering at desktop/tablet widths when possible.
- If an element supports background image media, render the selected image as a real `<img>` and position it behind the content instead of using CSS `background-image`.
- Buttons should wrap safely.
- Text max widths should prevent overly long lines.

## Accessibility Standards

- Heading tags should follow page hierarchy and be configurable where appropriate.
- Do not use heading tags for decorative labels by default.
- Images should use attachment markup when possible.
- Prefer real `<img>` markup for Hero background images instead of CSS `background-image` when the image is user-selected content.
- Image alt overrides should be supported when the image conveys meaning.
- Background images that are decorative should use empty alt text by default.
- Decorative images may use empty alt text where appropriate.
- Links and buttons should have visible text.
- Avoid empty anchors and controls without accessible names.

## Hero Decisions

- `twoa-hero` is the proof-of-concept reference element for the current phase.
- Hero remains registered through the current TwoA registration config.
- Hero stays in the `twoa-elements` category.
- Hero uses client-neutral defaults: Built For Growth, Create A Stronger First Impression, and a focused call-to-action description.
- Hero eyebrow defaults to a `p` tag, not a heading.
- Hero title defaults to `h1` and allows `h1` through `h6`.
- Hero eyebrow allows `p`, `div`, `span`, and `h2` through `h6`.
- Hero button style, button size, alignment, media position, and tags are strictly allowlisted.
- Hero renders buttons only when at least one valid button exists.
- Hero media is optional and renders only when a valid image exists.
- Hero supports constrained content by default and an optional full-width content mode.
- Hero supports inline image media and background image media as separate media layout choices.
- Hero background images render as decorative real image markup with empty alt text and optional light/dark overlays.
- Hero does not include standalone eyebrow/title/description color controls because typography controls already cover color.
- Hero defines local variable bridge aliases on its root instead of outputting global design tokens.
- Hero keeps root, inner, and content wrappers because they define the layout contract.

## What Not To Abstract Yet

- Do not create a shared helper trait yet.
- Do not create a large element framework.
- Do not abstract based on Hero alone.
- Do not build automatic registration until there is a real need.
- Do not refactor legacy DVLY elements as part of TwoA work.

## When To Introduce Shared Helpers Later

Shared helpers may be introduced after Hero, Section Heading, and CTA exist and real repetition is visible. Candidate helpers include heading tag allowlists, CSS length normalization, safe button rendering, media rendering, and alignment mapping.

Any helper extraction should be small, readable, and covered by manual Bricks checks.

## New Element Checklist

- Confirm the element is needed for new cloned sites.
- Add the PHP file under `elements/twoa/`.
- Add the slug to the TwoA registration config only when ready.
- Use the `twoa-elements` category.
- Use `Brxe_TwoA_*` class naming.
- Use a `twoa-*` element slug.
- Add per-element SCSS and compiled CSS.
- Enqueue only the element CSS from `enqueue_scripts()`.
- Provide useful client-neutral defaults.
- Keep controls grouped and client-safe.
- Avoid duplicate controls, especially standalone color controls next to typography controls that already include color.
- Allowlist all finite settings before output.
- Escape all frontend output.
- Avoid empty optional wrappers on the frontend.
- Test with missing optional content.
- Test responsive behavior on mobile and desktop.
- Run PHP lint.
- Run CSS build.
- Run release build before packaging.
