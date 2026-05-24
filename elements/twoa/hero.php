<?php

if (!defined('ABSPATH')) {
    exit;
}

class Brxe_TwoA_Hero extends \Bricks\Element
{
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
            'brxe-twoa-hero',
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
        $this->controls['above_title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Above Title', 'bricks'),
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
                'selector' => '.brxe-twoa-hero__description',
                'toolbar' => true,
            ],
        ];

        $this->controls['image'] = [
            'tab' => 'content',
            'group' => 'media',
            'label' => esc_html__('Image', 'bricks'),
            'type' => 'image',
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
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__content',
                ],
                [
                    'property' => 'justify-content',
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__buttons',
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
                    'property' => 'max-width',
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__content',
                ],
            ],
        ];

        $this->controls['above_title_typography'] = [
            'tab' => 'content',
            'group' => 'style',
            'label' => esc_html__('Above Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__above-title',
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
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__title',
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
                    'selector' => '{{SELECTOR}} .brxe-twoa-hero__description',
                ],
            ],
        ];
    }

    public function render()
    {
        $settings = $this->settings ?? [];

        $this->set_attribute('_root', 'class', 'brxe-twoa-hero');

        echo '<section ' . $this->render_attributes('_root') . '>';
        echo '<div class="brxe-twoa-hero__inner">';
        echo '<div class="brxe-twoa-hero__content">';

        if (!empty($settings['above_title'])) {
            echo '<p class="brxe-twoa-hero__above-title">' . esc_html($settings['above_title']) . '</p>';
        }

        if (!empty($settings['title'])) {
            echo '<h1 class="brxe-twoa-hero__title">' . esc_html($settings['title']) . '</h1>';
        }

        if (!empty($settings['description'])) {
            echo '<div class="brxe-twoa-hero__description">' . wp_kses_post($settings['description']) . '</div>';
        }

        $this->render_buttons($settings['buttons'] ?? []);

        echo '</div>';

        $this->render_image($settings['image'] ?? []);

        echo '</div>';
        echo '</section>';
    }

    private function render_buttons($buttons): void
    {
        if (empty($buttons) || !is_array($buttons)) {
            return;
        }

        echo '<div class="brxe-twoa-hero__buttons">';

        foreach ($buttons as $index => $button) {
            if (empty($button['text']) || empty($button['link']) || !is_array($button['link'])) {
                continue;
            }

            $classes = ['brxe-button', 'bricks-button', 'brxe-twoa-hero__button'];

            if (!empty($button['style'])) {
                $classes[] = 'bricks-button-' . sanitize_html_class($button['style']);
            }

            if (!empty($button['size'])) {
                $classes[] = sanitize_html_class($button['size']);
            }

            $link_key = 'twoa_hero_button_' . $index;
            $this->set_link_attributes($link_key, $button['link']);

            echo '<a ' . $this->render_attributes($link_key) . ' class="' . esc_attr(implode(' ', $classes)) . '">';
            echo esc_html($button['text']);
            echo '</a>';
        }

        echo '</div>';
    }

    private function render_image($image): void
    {
        if (empty($image) || !is_array($image)) {
            return;
        }

        $image_id = !empty($image['id']) ? absint($image['id']) : 0;
        $image_html = '';

        if ($image_id) {
            $image_html = wp_get_attachment_image($image_id, 'large', false, [
                'class' => 'brxe-twoa-hero__image',
                'loading' => 'eager',
            ]);
        } elseif (!empty($image['url'])) {
            $image_html = '<img class="brxe-twoa-hero__image" src="' . esc_url($image['url']) . '" alt="">';
        }

        if (!$image_html) {
            return;
        }

        echo '<div class="brxe-twoa-hero__media">' . $image_html . '</div>';
    }
}
