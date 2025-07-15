<?php
// Exit if accessed directly
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

class Brxe_Dvly_Icon_Text_Items extends \Bricks\Element
{
    public $category = 'dvly-elements';
    public $name = 'dvly-icon-text-items';
    public $icon = 'ti-list';

    public function get_label()
    {
        return esc_html__('Dvly Icon Text Items', 'bricks');
    }

    public function set_control_groups()
    {
        $this->control_groups['content'] = [
            'title' => esc_html__('Content', 'bricks'),
            'tab' => 'content',
        ];
        $this->control_groups['styles'] = [
            'title' => esc_html__('Styles', 'bricks'),
            'tab' => 'content',
        ];
    }

    public function set_controls()
    {

        $this->controls['icon_text_alignment'] = [
            'tab' => 'content',
            'label' => esc_html__('Alignment', 'bricks'),
            'type' => 'text-align',
            'css' => [
                [
                    'property' => 'text-align',
                    'selector' => '.brxe-dvly-icon-text-items-container',
                ],
            ],
        ];

        // Block Title
        $this->controls['block_title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Block Title', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Our Features', 'bricks'),
        ];

        // Block Subtitle
        $this->controls['block_subtitle'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Block Subtitle', 'bricks'),
            'type' => 'textarea',
            'default' => esc_html__('Explore the key highlights of our services.', 'bricks'),
        ];

        // Typography Controls
        $this->controls['block_title_typography'] = [
            'tab' => 'content',
            'group' => 'styles',
            'label' => esc_html__('Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.brxe-dvly-icon-text-title',
                ]
            ],
        ];

        $this->controls['block_subtitle_typography'] = [
            'tab' => 'content',
            'group' => 'styles',
            'label' => esc_html__('Subtitle Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.brxe-dvly-icon-text-subtitle',
                ]
            ],
        ];

        $this->controls['icon_color'] = [
            'tab' => 'content',
            'group' => 'styles',
            'label' => esc_html__('Icon Color', 'bricks'),
            'type' => 'color',
            'inline' => true,
            'default' => 'var(--primary)',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.brxe-item-icon i',
                ]
            ],
        ];

        $this->controls['icon_size'] = [
            'tab' => 'content',
            'group' => 'styles',
            'label' => esc_html__('Icon Size', 'bricks'),
            'type' => 'number',
            'min' => 1,
            'unit' => 'px',
            'default' => 48,
            'css' => [
                [
                    'property' => 'font-size',
                    'selector' => '.brxe-item-icon i, .brxe-item-icon svg',
                ]
            ],
            'inline' => true,
        ];

        $this->controls['item_title_typography'] = [
            'tab'   => 'content',
            'group' => 'styles',
            'label' => esc_html__('Item Title Typography', 'bricks'),
            'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'font',
                    'selector' => '.brxe-item-title',
                ],
            ],
        ];
        
        $this->controls['item_text_typography'] = [
            'tab'   => 'content',
            'group' => 'styles',
            'label' => esc_html__('Item Text Typography', 'bricks'),
            'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'font',
                    'selector' => '.brxe-item-text',
                ],
            ],
        ];        

        $this->controls['items_repeater'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Items', 'bricks'),
            'type' => 'repeater',
            'titleProperty' => 'title',
            'default' => [
                [
                    'display_type' => 'icon',
                    'icon' => ['library' => 'themify', 'icon' => 'ti-star'],
                    'title' => esc_html__('Feature One', 'bricks'),
                    'text' => esc_html__('This is the first feature description.', 'bricks'),
                    'button_text' => esc_html__('Learn More', 'bricks'),
                    'button_link' => ['type' => 'external', 'url' => '#'],
                    'button_style' => 'primary',
                    'button_size' => 'md',
                ],
                [
                    'display_type' => 'icon',
                    'icon' => ['library' => 'themify', 'icon' => 'ti-settings'],
                    'title' => esc_html__('Feature Two', 'bricks'),
                    'text' => esc_html__('This is the second feature description.', 'bricks'),
                    'button_text' => esc_html__('Get Started', 'bricks'),
                    'button_link' => ['type' => 'external', 'url' => '#'],
                    'button_style' => 'secondary',
                    'button_size' => 'md',
                ],
                [
                    'display_type' => 'icon',
                    'icon' => ['library' => 'themify', 'icon' => 'ti-world'],
                    'title' => esc_html__('Feature Three', 'bricks'),
                    'text' => esc_html__('This is the third feature description.', 'bricks'),
                    'button_text' => esc_html__('Explore', 'bricks'),
                    'button_link' => ['type' => 'external', 'url' => '#'],
                    'button_style' => 'dark',
                    'button_size' => 'md',
                ],
            ],
            'fields' => [
                'display_type' => [
                    'label' => esc_html__('Display Type', 'bricks'),
                    'type' => 'select',
                    'options' => [
                        'icon' => esc_html__('Icon', 'bricks'),
                        'image' => esc_html__('Image', 'bricks'),
                    ],
                    'default' => 'icon',
                ],
                'icon' => [
                    'label' => esc_html__('Icon', 'bricks'),
                    'type' => 'icon',
                    'default' => ['library' => 'themify', 'icon' => 'ti-star'],
                    'condition' => ['display_type' => 'icon'],
                ],
                'title' => [
                    'label' => esc_html__('Title', 'bricks'),
                    'type' => 'text',
                    'default' => esc_html__('Default Title', 'bricks'),
                ],
                'text' => [
                    'label' => esc_html__('Text', 'bricks'),
                    'type' => 'textarea',
                    'default' => esc_html__('Default description goes here.', 'bricks'),
                ],
                'button_text' => [
                    'label' => esc_html__('Button Text', 'bricks'),
                    'type' => 'text',
                    'default' => esc_html__('Click Here', 'bricks'),
                ],
                'button_link' => [
                    'type' => 'link',
                    'default' => ['external' => '#'], // Use "external" key to match Bricks' native format
                ],
                'button_style' => [
                    'label' => esc_html__('Button Style', 'bricks'),
                    'type' => 'select',
                    'options' => [
                        'primary' => esc_html__('Primary', 'bricks'),
                        'secondary' => esc_html__('Secondary', 'bricks'),
                        'light' => esc_html__('Light', 'bricks'),
                        'dark' => esc_html__('Dark', 'bricks'),
                    ],
                    'default' => 'primary',
                ],
                'button_size' => [
                    'label' => esc_html__('Button Size', 'bricks'),
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
    }

    public function render()
    {
        $settings = $this->settings ?? [];
        $items = $settings['items_repeater'] ?? [];
        $block_title = !empty($settings['block_title']) ? esc_html($settings['block_title']) : '';
        $block_subtitle = !empty($settings['block_subtitle']) ? esc_html($settings['block_subtitle']) : '';

        echo '<section ' . $this->render_attributes('_root') . '>';
        echo '<div class="brxe-dvly-icon-text-items-container brxe-container">';

        // Block Title & Subtitle
        if ($block_title || $block_subtitle) {
            echo '<div class="brxe-dvly-icon-text-header">';
            if ($block_title) {
                echo '<h2 class="brxe-dvly-icon-text-title">' . $block_title . '</h2>';
            }
            if ($block_subtitle) {
                echo '<p class="brxe-dvly-icon-text-subtitle">' . $block_subtitle . '</p>';
            }
            echo '</div>';
        }

        echo '<div class="brxe-dvly-icon-text-items-list">';

        if (!empty($items)) {
            foreach ($items as $item) {
                $display_type = $item['display_type'] ?? 'icon';
                $icon = $item['icon'] ?? [];
                $title = !empty($item['title']) ? esc_html($item['title']) : '';
                $text = !empty($item['text']) ? esc_html($item['text']) : '';
                $button_text = !empty($item['button_text']) ? esc_html($item['button_text']) : '';
                $button_style = !empty($item['button_style']) ? 'bricks-button-' . esc_attr($item['button_style']) : 'bricks-button-primary';
                $button_size = !empty($item['button_size']) ? esc_attr($item['button_size']) : 'md';

                $button_link = '#'; // Default value

                if (!empty($item['button_link']) && is_array($item['button_link'])) {
                    if ($item['button_link']['type'] === 'external') {
                        $button_link = esc_url($item['button_link']['url']);
                    } elseif ($item['button_link']['type'] === 'internal' && !empty($item['button_link']['postId'])) {
                        $button_link = get_permalink($item['button_link']['postId']); // Fetch correct URL
                    }
                }
                
                echo '<div class="brxe-item">';
                echo '<div class="brxe-item-icon">';
                if ($display_type === 'icon' && !empty($icon) && is_array($icon)) {
                    $icon_class = $icon['icon'] ?? '';
                    if ($icon_class) {
                        echo '<i class="' . esc_attr($icon_class) . '"></i>';
                    }
                } elseif ($display_type === 'image' && !empty($item['image'])) {
                    $image_url = wp_get_attachment_url($item['image']);
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                    }
                }
                echo '</div>';

                // Content
                echo '<div class="brxe-item-content">';
                if ($title) {
                    echo '<h4 class="brxe-item-title">' . $title . '</h4>';
                }
                if ($text) {
                    echo '<p class="brxe-item-text">' . $text . '</p>';
                }

                // Button (only render if we have a valid link and text)
                if (!empty($button_text) && !empty($button_link)) {
                    $button_classes = ['brxe-item-button', 'bricks-button', $button_style, $button_size];

                    echo '<a href="' . $button_link . '" class="' . esc_attr(implode(' ', $button_classes)) . '">';
                    echo esc_html($button_text);
                    echo '</a>';
                }

                echo '</div>'; // End of .brxe-item-content

                echo '</div>'; // End of .brxe-item
            }
        } else {
            esc_html_e('No items defined.', 'bricks');
        }

        echo '</div>'; // End of .brxe-dvly-icon-text-items-list
        echo '</div>'; // End of .brxe-dvly-icon-text-items-container
        echo '</section>';
    }
}