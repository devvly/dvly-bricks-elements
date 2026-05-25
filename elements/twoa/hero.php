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
            'default' => esc_html__('TwoA Elements', 'bricks'),
            'inlineEditing' => true,
        ];

        $this->controls['title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Title', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Build Better Bricks Sections', 'bricks'),
            'inlineEditing' => true,
        ];

        $this->controls['description'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Description', 'bricks'),
            'type' => 'editor',
            'default' => esc_html__('A clean, responsive hero element built for the new TwoA architecture.', 'bricks'),
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
            'label' => esc_html__('Image Alt Override', 'bricks'),
            'type' => 'text',
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
            'css' => [
                [
                    'property' => 'text-align',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__content',
                ],
                [
                    'property' => 'justify-content',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__buttons',
                ],
            ],
        ];

        $this->controls['content_max_width'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Content Max Width', 'bricks'),
            'type' => 'number',
            'unit' => 'px',
            'default' => 720,
            'min' => 320,
            'max' => 1200,
            'css' => [
                [
                    'property' => '--twoa-be-hero-content-max',
                    'selector' => '{{SELECTOR}}',
                ],
            ],
        ];

        $this->controls['section_padding_y'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Section Padding Y', 'bricks'),
            'type' => 'number',
            'unit' => 'px',
            'default' => 96,
            'min' => 0,
            'css' => [
                [
                    'property' => '--twoa-be-hero-pad-y',
                    'selector' => '{{SELECTOR}}',
                ],
            ],
        ];

        $this->controls['section_padding_x'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Section Padding X', 'bricks'),
            'type' => 'number',
            'unit' => 'px',
            'default' => 24,
            'min' => 0,
            'css' => [
                [
                    'property' => '--twoa-be-hero-pad-x',
                    'selector' => '{{SELECTOR}}',
                ],
            ],
        ];

        $this->controls['media_position'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__('Media Position', 'bricks'),
            'type' => 'select',
            'options' => [
                'content_first' => esc_html__('Content First', 'bricks'),
                'media_first' => esc_html__('Media First', 'bricks'),
            ],
            'default' => 'content_first',
        ];

        $this->controls['title_tag'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Title Tag', 'bricks'),
            'type' => 'select',
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
            ],
            'default' => 'h1',
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

        $this->controls['eyebrow_color'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Eyebrow Color', 'bricks'),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__eyebrow',
                ],
            ],
        ];

        $this->controls['title_color'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Title Color', 'bricks'),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__title',
                ],
            ],
        ];

        $this->controls['description_color'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Description Color', 'bricks'),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '{{SELECTOR}} .brxe-twoa-be-hero__description',
                ],
            ],
        ];

        $this->controls['content_stack_gap'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Content Stack Gap', 'bricks'),
            'type' => 'number',
            'unit' => 'px',
            'default' => 16,
            'min' => 0,
            'css' => [
                [
                    'property' => '--twoa-be-hero-stack-gap',
                    'selector' => '{{SELECTOR}}',
                ],
            ],
        ];

        $this->controls['buttons_gap'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Buttons Gap', 'bricks'),
            'type' => 'number',
            'unit' => 'px',
            'default' => 12,
            'min' => 0,
            'css' => [
                [
                    'property' => '--twoa-be-hero-buttons-gap',
                    'selector' => '{{SELECTOR}}',
                ],
            ],
        ];
    }

    public function render()
    {
        $settings = $this->settings ?? [];
        // Backward compatibility: keep reading the old key (`above_title`) if present.
        $eyebrow = $settings['eyebrow'] ?? ($settings['above_title'] ?? '');

        // Only allow known-safe heading tags so markup stays valid and predictable.
        $title_tag = strtolower((string) ($settings['title_tag'] ?? 'h1'));
        if (!in_array($title_tag, ['h1', 'h2', 'h3'], true)) {
            $title_tag = 'h1';
        }
        $media_position = $settings['media_position'] ?? 'content_first';

        $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero');
        if ($media_position === 'media_first') {
            $this->set_attribute('_root', 'class', 'brxe-twoa-be-hero--media-first');
        }

        echo '<section ' . $this->render_attributes('_root') . '>';
        echo '<div class="brxe-twoa-be-hero__inner">';
        echo '<div class="brxe-twoa-be-hero__content">';

        if (!empty($eyebrow)) {
            // Plain text output is escaped to prevent HTML injection.
            echo '<p class="brxe-twoa-be-hero__eyebrow">' . esc_html($eyebrow) . '</p>';
        }

        if (!empty($settings['title'])) {
            // Title is plain text; heading tag is whitelisted above.
            echo '<' . $title_tag . ' class="brxe-twoa-be-hero__title">' . esc_html($settings['title']) . '</' . $title_tag . '>';
        }

        if (!empty($settings['description'])) {
            // Description supports limited rich text from the editor control.
            echo '<div class="brxe-twoa-be-hero__description">' . wp_kses_post($settings['description']) . '</div>';
        }

        $this->render_buttons($settings['buttons'] ?? []);

        echo '</div>';

        $this->render_image(
            $settings['image'] ?? [],
            $settings['image_size'] ?? 'large',
            $settings['image_alt_override'] ?? ''
        );

        echo '</div>';
        echo '</section>';
    }

    private function render_buttons($buttons): void
    {
        if (empty($buttons) || !is_array($buttons)) {
            return;
        }

        // Repeater-driven buttons with Bricks native link attributes per item.
        echo '<div class="brxe-twoa-be-hero__buttons">';

        foreach ($buttons as $index => $button) {
            if (empty($button['text']) || empty($button['link']) || !is_array($button['link'])) {
                continue;
            }

            $classes = ['brxe-button', 'bricks-button', 'brxe-twoa-be-hero__button'];

            if (!empty($button['style'])) {
                // Dynamic class parts are sanitized before composing class names.
                $classes[] = 'bricks-button-' . sanitize_html_class($button['style']);
            }

            if (!empty($button['size'])) {
                $classes[] = sanitize_html_class($button['size']);
            }

            $link_key = 'twoa_hero_button_' . $index;
            $this->set_link_attributes($link_key, $button['link']);

            echo '<a ' . $this->render_attributes($link_key) . ' class="' . esc_attr(implode(' ', $classes)) . '">';
            // Button text is plain text and escaped.
            echo esc_html($button['text']);
            echo '</a>';
        }

        echo '</div>';
    }

    private function render_image($image, string $image_size, string $alt_override): void
    {
        if (empty($image) || !is_array($image)) {
            return;
        }

        // Prefer attachment rendering for proper responsive image markup; fallback to direct URL image.
        $image_id = !empty($image['id']) ? absint($image['id']) : 0;
        $image_html = '';
        $size = in_array($image_size, ['thumbnail', 'medium', 'large', 'full'], true) ? $image_size : 'large';
        $alt = trim($alt_override);

        if ($image_id) {
            $image_html = wp_get_attachment_image($image_id, $size, false, [
                'class' => 'brxe-twoa-be-hero__image',
                'loading' => 'eager',
                'alt' => $alt !== '' ? $alt : null,
            ]);
        } elseif (!empty($image['url'])) {
            $image_html = '<img class="brxe-twoa-be-hero__image" src="' . esc_url($image['url']) . '" alt="' . esc_attr($alt) . '">';
        }

        if (!$image_html) {
            return;
        }

        echo '<div class="brxe-twoa-be-hero__media">' . $image_html . '</div>';
    }
}

