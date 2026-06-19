<?php

if (!defined('ABSPATH')) {
    exit;
}

class Brxe_TwoA_Hero extends \Bricks\Element
{
    // Element identity used by Bricks for grouping and serialized element type.
    public $category = 'twoa-elements';
    public $name = 'twoa-hero';
    public $icon = 'ti-layout-width-full';

    public function enqueue_scripts()
    {
        $css_file = TWOA_BRICKS_ELEMENTS_PATH . 'assets/css/twoa/hero.css';

        if (!file_exists($css_file)) {
            return;
        }

        wp_enqueue_style(
            'brxe-twoa-be-hero',
            TWOA_BRICKS_ELEMENTS_URL . 'assets/css/twoa/hero.css',
            [],
            filemtime($css_file)
        );
    }

    public function get_label()
    {
        return esc_html__('TwoA Hero', 'bricks');
    }

    public function set_control_groups()
    {
        // Standardized groups used as the reference structure for future TwoA elements.
        $this->control_groups['content'] = [
            'title' => esc_html__('Content', 'bricks'),
            'tab' => 'content',
        ];

        $this->control_groups['media'] = [
            'title' => esc_html__('Media', 'bricks'),
            'tab' => 'content',
        ];

        $this->control_groups['buttons'] = [
            'title' => esc_html__('Buttons', 'bricks'),
            'tab' => 'content',
        ];

        $this->control_groups['layout'] = [
            'title' => esc_html__('Layout', 'bricks'),
            'tab' => 'content',
        ];

        $this->control_groups['style'] = [
            'title' => esc_html__('Style', 'bricks'),
            'tab' => 'content',
        ];
    }

    public function set_controls()
    {
        $this->controls['eyebrow'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Eyebrow', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Built For Growth', 'bricks'),
            'inlineEditing' => true,
        ];

        $this->controls['title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Title', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Create A Stronger First Impression', 'bricks'),
            'inlineEditing' => true,
        ];

        $this->controls['description'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Description', 'bricks'),
            'type' => 'editor',
            'default' => esc_html__('Introduce your business with a clear message, helpful context, and a focused call to action.', 'bricks'),
            'inlineEditing' => [
                'selector' => '.brxe-twoa-be-hero__description',
                'toolbar' => true,
            ],
        ];

        $this->controls['image'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Image', 'bricks'),
            'type' => 'image',
        ];

        $this->controls['media_layout'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Media Layout', 'bricks'),
            'type' => 'select',
            'options' => [
                'inline' => esc_html__('Inline Image', 'bricks'),
                'background' => esc_html__('Background Image', 'bricks'),
            ],
            'default' => 'inline',
            'rerender' => true,
        ];

        $this->controls['image_size'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Image Size', 'bricks'),
            'type' => 'select',
            'options' => [
                'thumbnail' => esc_html__('Thumbnail', 'bricks'),
                'medium' => esc_html__('Medium', 'bricks'),
                'large' => esc_html__('Large', 'bricks'),
                'full' => esc_html__('Full', 'bricks'),
            ],
            'default' => 'large',
        ];

        $this->controls['image_alt_override'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Image Alt Text', 'bricks'),
            'type' => 'text',
        ];

        $this->controls['background_overlay'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Background Overlay', 'bricks'),
            'type' => 'select',
            'options' => [
                'none' => esc_html__('None', 'bricks'),
                'light' => esc_html__('Light', 'bricks'),
                'dark' => esc_html__('Dark', 'bricks'),
            ],
            'default' => 'none',
            'rerender' => true,
        ];

        $this->controls['buttons'] = [
            'tab' => 'content',
            'group' => 'buttons',
            'label' => esc_html__('Buttons', 'bricks'),
            'type' => 'repeater',
            'titleProperty' => 'text',
            'default' => [
                [
                    'text' => esc_html__('Get Started', 'bricks'),
                    'link' => ['type' => 'external', 'url' => '#'],
                    'style' => 'primary',
                    'size' => 'md',
                ],
            ],
            'fields' => [
                'text' => [
                    'label' => esc_html__('Text', 'bricks'),
                    'type' => 'text',
                    'default' => esc_html__('Button', 'bricks'),
                ],
                'link' => [
                    'label' => esc_html__('Link', 'bricks'),
                    'type' => 'link',
                    'default' => ['type' => 'external', 'url' => '#'],
                ],
                'style' => [
                    'label' => esc_html__('Style', 'bricks'),
                    'type' => 'select',
                    'options' => [
                        'primary' => esc_html__('Primary', 'bricks'),
                        'secondary' => esc_html__('Secondary', 'bricks'),
                        'light' => esc_html__('Light', 'bricks'),
                        'dark' => esc_html__('Dark', 'bricks'),
                    ],
                    'default' => 'primary',
                ],
                'size' => [
                    'label' => esc_html__('Size', 'bricks'),
                    'type' => 'select',
                    'options' => [
                        'sm' => esc_html__('Small', 'bricks'),
                        'md' => esc_html__('Medium', 'bricks'),
                        'lg' => esc_html__('Large', 'bricks'),
                        'xl' => esc_html__('Extra Large', 'bricks'),
                    ],
                    'default' => 'md',
                ],
            ],
        ];

        $this->controls['content_alignment'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Content Alignment', 'bricks'),
            'type' => 'text-align',
            'default' => 'left',
            'rerender' => true,
            'css' => [
                [
                    'property' => 'text-align',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__content',
                ],
            ],
        ];

        $this->controls['content_max_width'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Content Max Width', 'bricks'),
            'type' => 'text',
            'default' => '100%',
            'description' => esc_html__('Examples: 100%, 500, 500px, 42rem, var(--gap-l)', 'bricks'),
            'rerender' => true,
        ];

        $this->controls['full_width_content'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Full Width Content', 'bricks'),
            'type' => 'checkbox',
            'default' => false,
            'rerender' => true,
        ];

        $this->controls['section_padding_y'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Section Padding Y', 'bricks'),
            'type' => 'text',
            'default' => 'var(--twoa-gap-xl)',
            'description' => esc_html__('Examples: 120, 120px, 6rem, var(--gap-xl)', 'bricks'),
            'rerender' => true,
        ];

        $this->controls['section_padding_x'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Section Padding X', 'bricks'),
            'type' => 'text',
            'default' => 'var(--twoa-gap-m)',
            'description' => esc_html__('Examples: 40, 40px, 2rem, var(--gap-l)', 'bricks'),
            'rerender' => true,
        ];

        $this->controls['media_position'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Media Position', 'bricks'),
            'type' => 'select',
            'options' => [
                'content_first' => esc_html__('Media Right', 'bricks'),
                'media_first' => esc_html__('Media Left', 'bricks'),
            ],
            'default' => 'content_first',
            'condition' => ['media_layout' => 'inline'],
        ];

        $this->controls['title_tag'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Title Tag', 'bricks'),
            'type' => 'select',
            'rerender' => true,
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ],
            'default' => 'h1',
        ];

        $this->controls['eyebrow_tag'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Eyebrow Tag', 'bricks'),
            'type' => 'select',
            'rerender' => true,
            'options' => [
                'p' => 'P',
                'div' => 'DIV',
                'span' => 'SPAN',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ],
            'default' => 'p',
        ];

        $this->controls['eyebrow_typography'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Eyebrow Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__eyebrow',
                ],
            ],
        ];

        $this->controls['title_typography'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__title',
                ],
            ],
        ];

        $this->controls['description_typography'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Description Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__description',
                ],
            ],
        ];

        $this->controls['buttons_gap'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Buttons Gap', 'bricks'),
            'type' => 'text',
            'default' => 'var(--twoa-gap-s)',
            'description' => esc_html__('Examples: 12, 12px, 0.75rem, var(--gap-s)', 'bricks'),
            'rerender' => true,
        ];
    }

    public function render()
    {
        $settings = $this->settings ?? [];
        // Backward compatibility: keep reading the old key (`above_title`) if present.
        $eyebrow = $settings['eyebrow'] ?? ($settings['above_title'] ?? '');

        // Only allow known-safe heading tags so markup stays valid and predictable.
        $title_tag = $this->get_allowed_value($settings['title_tag'] ?? 'h1', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], 'h1');
        $eyebrow_tag = $this->get_allowed_value($settings['eyebrow_tag'] ?? 'p', ['p', 'div', 'span', 'h2', 'h3', 'h4', 'h5', 'h6'], 'p');
        $media_position = $this->get_allowed_value($settings['media_position'] ?? 'content_first', ['content_first', 'media_first'], 'content_first');
        $media_layout = $this->get_allowed_value($settings['media_layout'] ?? 'inline', ['inline', 'background'], 'inline');
        $background_overlay = $this->get_allowed_value($settings['background_overlay'] ?? 'none', ['none', 'light', 'dark'], 'none');
        $content_alignment = $this->get_allowed_value($settings['content_alignment'] ?? 'left', ['left', 'center', 'right'], 'left');
        $has_media = $this->has_media($settings['image'] ?? []);
        $has_inline_media = $has_media && $media_layout === 'inline';
        $has_background_media = $has_media && $media_layout === 'background';

        $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero');
        $this->set_attribute('_root', 'class', $has_media ? 'brxe-twoa-be-hero--has-media' : 'brxe-twoa-be-hero--no-media');
        $this->set_attribute('_root', 'class', $media_layout === 'background' ? 'brxe-twoa-be-hero--media-background' : 'brxe-twoa-be-hero--media-inline');
        if ($this->is_checked($settings['full_width_content'] ?? false)) {
            $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero--full-width');
        }
        if ($has_inline_media && $media_position === 'media_first') {
            $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero--media-first');
        }
        if ($has_background_media && $background_overlay !== 'none') {
            $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero--overlay-' . $background_overlay);
        }

        echo '<section ' . $this->render_attributes('_root') . '>';
        if ($has_background_media) {
            $this->render_background_image($settings['image'] ?? [], $settings['image_size'] ?? 'large');

            if ($background_overlay !== 'none') {
                echo '<div class="brxe-twoa-be-hero__background-overlay" aria-hidden="true"></div>';
            }
        }

        echo '<div class="brxe-twoa-be-hero__inner"' . $this->render_inline_style_attribute([
            'padding-top' => $this->normalize_css_length_value($settings['section_padding_y'] ?? null, 'var(--twoa-gap-xl)'),
            'padding-bottom' => $this->normalize_css_length_value($settings['section_padding_y'] ?? null, 'var(--twoa-gap-xl)'),
            'padding-left' => $this->normalize_css_length_value($settings['section_padding_x'] ?? null, 'var(--twoa-gap-m)'),
            'padding-right' => $this->normalize_css_length_value($settings['section_padding_x'] ?? null, 'var(--twoa-gap-m)'),
        ]) . '>';
        echo '<div class="brxe-twoa-be-hero__content"' . $this->render_inline_style_attribute([
            'max-width' => $this->normalize_css_length_value($settings['content_max_width'] ?? null, '100%'),
            'justify-self' => $this->map_alignment_to_justify_self($content_alignment),
        ]) . '>';

        if (!empty($eyebrow)) {
            // Plain text output is escaped to prevent HTML injection.
            echo '<' . $eyebrow_tag . ' class="brxe-twoa-be-hero__eyebrow">' . esc_html($eyebrow) . '</' . $eyebrow_tag . '>';
        }

        if (!empty($settings['title'])) {
            // Title is plain text; heading tag is whitelisted above.
            echo '<' . $title_tag . ' class="brxe-twoa-be-hero__title">' . esc_html($settings['title']) . '</' . $title_tag . '>';
        }

        if (!empty($settings['description'])) {
            // Description supports limited rich text from the editor control.
            echo '<div class="brxe-twoa-be-hero__description">' . wp_kses_post($settings['description']) . '</div>';
        }

        $this->render_buttons(
            $settings['buttons'] ?? [],
            $this->normalize_css_length_value($settings['buttons_gap'] ?? null, 'var(--twoa-gap-s)'),
            $content_alignment
        );

        echo '</div>';

        if ($has_inline_media) {
            $this->render_inline_image(
                $settings['image'] ?? [],
                $settings['image_size'] ?? 'large',
                $settings['image_alt_override'] ?? ''
            );
        }

        echo '</div>';
        echo '</section>';
    }

    private function render_buttons($buttons, string $gap, string $alignment): void
    {
        if (empty($buttons) || !is_array($buttons)) {
            return;
        }

        $button_markup = '';

        foreach ($buttons as $index => $button) {
            $button_markup .= $this->get_button_markup($button, $index);
        }

        if ($button_markup === '') {
            return;
        }

        // Repeater-driven buttons with Bricks native link attributes per item.
        echo '<div class="brxe-twoa-be-hero__buttons"' . $this->render_inline_style_attribute([
            'gap' => $gap,
            'justify-content' => $this->map_alignment_to_flex_justify($alignment),
        ]) . '>';

        echo $button_markup;
        echo '</div>';
    }

    private function get_button_markup($button, int $index): string
    {
        if (!is_array($button) || empty($button['text']) || empty($button['link']) || !is_array($button['link'])) {
            return '';
        }

        $style = $this->get_allowed_value($button['style'] ?? 'primary', ['primary', 'secondary', 'light', 'dark'], 'primary');
        $size = $this->get_allowed_value($button['size'] ?? 'md', ['sm', 'md', 'lg', 'xl'], 'md');
        $classes = ['brxe-button', 'bricks-button', 'brxe-twoa-be-hero__button', 'bricks-button-' . $style, $size];
        $link_key = 'twoa_hero_button_' . $index;

        $this->set_link_attributes($link_key, $button['link']);

        ob_start();
        echo '<a ' . $this->render_attributes($link_key) . ' class="' . esc_attr(implode(' ', $classes)) . '">';
        // Button text is plain text and escaped.
        echo esc_html($button['text']);
        echo '</a>';

        return (string) ob_get_clean();
    }

    private function render_inline_image($image, string $image_size, string $alt_override): void
    {
        $image_html = $this->get_image_html($image, $image_size, (string) $alt_override, 'brxe-twoa-be-hero__image', 'eager', false);

        if (!$image_html) {
            return;
        }

        echo '<div class="brxe-twoa-be-hero__media">' . $image_html . '</div>';
    }

    private function render_background_image($image, string $image_size): void
    {
        $image_html = $this->get_image_html($image, $image_size, '', 'brxe-twoa-be-hero__background-image', 'eager', true);

        if (!$image_html) {
            return;
        }

        echo '<div class="brxe-twoa-be-hero__background-media" aria-hidden="true">' . $image_html . '</div>';
    }

    private function get_image_html($image, string $image_size, string $alt_override, string $class, string $loading, bool $force_empty_alt): string
    {
        if (empty($image) || !is_array($image)) {
            return '';
        }

        // Prefer attachment rendering for proper responsive image markup; fallback to direct URL image.
        $image_id = !empty($image['id']) ? absint($image['id']) : 0;
        $size = in_array($image_size, ['thumbnail', 'medium', 'large', 'full'], true) ? $image_size : 'large';
        $alt = trim((string) $alt_override);

        if ($image_id) {
            return (string) wp_get_attachment_image($image_id, $size, false, [
                'class' => $class,
                'loading' => $loading,
                'alt' => ($force_empty_alt || $alt !== '') ? $alt : null,
            ]);
        }

        if (!empty($image['url'])) {
            return '<img class="' . esc_attr($class) . '" src="' . esc_url($image['url']) . '" alt="' . esc_attr($alt) . '" loading="' . esc_attr($loading) . '">';
        }

        return '';
    }

    private function has_media($image): bool
    {
        if (empty($image) || !is_array($image)) {
            return false;
        }

        if (!empty($image['id']) && absint($image['id']) > 0) {
            return true;
        }

        return !empty($image['url']);
    }

    private function render_inline_style_attribute(array $styles): string
    {
        $parts = [];
        foreach ($styles as $prop => $value) {
            if (!is_string($value) || trim($value) === '') {
                continue;
            }
            $parts[] = $prop . ': ' . $value;
        }

        if (empty($parts)) {
            return '';
        }

        return ' style="' . esc_attr(implode('; ', $parts) . ';') . '"';
    }

    private function normalize_css_length_value($value, string $fallback): string
    {
        if (is_numeric($value)) {
            if ((float) $value < 0) {
                return $fallback;
            }

            return (string) $value . 'px';
        }

        if (!is_string($value)) {
            return $fallback;
        }

        $value = trim($value);
        if ($value === '') {
            return $fallback;
        }

        if (preg_match('/(^|[\s(,])-\d/', $value)) {
            return $fallback;
        }

        if (preg_match('/^(?:\d+|\d*\.\d+)$/', $value)) {
            return $value . 'px';
        }

        if (preg_match('/^(var|calc|clamp|min|max)\(.+\)$/', $value)) {
            return $value;
        }

        if (preg_match('/^(?:\d+|\d*\.\d+)(px|rem|em|%|vh|vw|vmin|vmax|ch|ex)$/', $value)) {
            return $value;
        }

        return $fallback;
    }

    private function get_allowed_value($value, array $allowed, string $fallback): string
    {
        $value = is_string($value) ? strtolower(trim($value)) : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }

    private function is_checked($value): bool
    {
        return $value === true || $value === 'true' || $value === '1' || $value === 1;
    }

    private function map_alignment_to_justify_self($alignment): string
    {
        $alignment = is_string($alignment) ? strtolower(trim($alignment)) : 'left';

        if ($alignment === 'center') {
            return 'center';
        }

        if ($alignment === 'right') {
            return 'end';
        }

        return 'start';
    }

    private function map_alignment_to_flex_justify($alignment): string
    {
        $alignment = is_string($alignment) ? strtolower(trim($alignment)) : 'left';

        if ($alignment === 'center') {
            return 'center';
        }

        if ($alignment === 'right') {
            return 'flex-end';
        }

        return 'flex-start';
    }
}

