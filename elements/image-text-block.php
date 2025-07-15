<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class Brxe_Dvly_Image_Text_Block extends \Bricks\Element
{
    public $category = 'dvly-elements';
    public $name = 'dvly-brxe-dvly-image-text-block';
    public $icon = 'fa-columns';

    public function get_label()
    {
        return esc_html__('Image Text Block', 'bricks');
    }

    public function set_control_groups()
    {
        $this->control_groups['content'] = [
            'title' => esc_html__('Content', 'bricks'),
            'tab' => 'content',
        ];
        $this->control_groups['appearance'] = [
            'title' => esc_html__('Appearance', 'bricks'),
            'tab' => 'content',
        ];
    }

    public function set_controls()
    {
        $this->controls['full_width'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Full Width', 'bricks'),
            'type' => 'checkbox',
            'default' => false,
        ];

        $this->controls['background_image'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Image (Left Column)', 'bricks'),
            'type' => 'image',
        ];

        $this->controls['heading_text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Heading', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Two columns block with image', 'bricks'),
        ];

        $this->controls['heading_typography'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-image-text-block__content h2',
                ],
            ],
        ];

        $this->controls['paragraph_text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Paragraph', 'bricks'),
            'type' => 'textarea',
            'default' => esc_html__('This block lets you combine an image and text side-by-side, great for highlighting content with visual storytelling. Adjust layout, image, text and call-to-action easily.', 'bricks'),
        ];

        $this->controls['paragraph_typography'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Description Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-image-text-block__content p',
                ],
            ],
        ];

        $this->controls['buttons'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Buttons', 'bricks'),
            'type' => 'repeater',
            'titleProperty' => 'cta_text',
            'default' => [
                [
                    'cta_text' => esc_html__('Learn More', 'bricks'),
                    'cta_link' => ['type' => 'external', 'url' => '#'],
                    'cta_style' => 'primary',
                    'cta_size' => 'md',
                ],
            ],
            'fields' => [
                'cta_text' => [
                    'label' => esc_html__('Button Text', 'bricks'),
                    'type' => 'text',
                    'default' => esc_html__('Click Here', 'bricks'),
                ],
                'cta_link' => [
                    'label' => esc_html__('Button Link', 'bricks'),
                    'type' => 'link',
                    'default' => ['external' => '#'],
                ],
                'cta_style' => [
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
                'cta_size' => [
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
        $container_class = !empty($settings['full_width']) ? 'brxe-dvly-image-text-block--full' : 'brxe-dvly-image-text-block--max';
        $has_image = !empty($settings['background_image']['url']);
        $container_style = !empty($settings['full_width']) ? ' style="width: 100%; padding-left: 0; padding-right: 0;"' : '';

        $this->set_attribute('_root', 'class', 'brxe-dvly-image-text-block ' . esc_attr($container_class));
        echo '<section ' . $this->render_attributes('_root') . '>';
        echo '<div class="brxe-dvly-image-text-block-container brxe-container"' . $container_style . '>';
        echo '<div class="brxe-dvly-image-text-block__grid">';

        echo '<div class="brxe-dvly-image-text-block__image"';
        if ($has_image) {
            echo ' style="background-image: url(' . esc_url($settings['background_image']['url']) . ');"';
        } else {
            echo ' style="background-color: var(--gray-300); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: var(--gray-600);"';
        }
        echo '>';

        if (!$has_image) {
            echo '<i class="ti-image" aria-hidden="true"></i>';
        }

        echo '</div>'; // .brxe-dvly-image-text-block__image

        echo '<div class="brxe-dvly-image-text-block__content">';
        echo '<h2>' . esc_html($settings['heading_text']) . '</h2>';
        echo '<p>' . esc_html($settings['paragraph_text']) . '</p>';

        if (!empty($settings['buttons']) && is_array($settings['buttons'])) {
            echo '<div class="brxe-dvly-image-text-block__buttons">';
            foreach ($settings['buttons'] as $index => $button) {
                if (!empty($button['cta_text']) && !empty($button['cta_link'])) {
                    $classes = ['brxe-button', 'brxe-dvly-image-text-block__button', 'bricks-button'];
                    if (!empty($button['cta_style'])) {
                        $classes[] = 'bricks-button-' . esc_attr($button['cta_style']);
                    }
                    if (!empty($button['cta_size'])) {
                        $classes[] = esc_attr($button['cta_size']);
                    }

                    $id = 'cta_link_' . $index;
                    $this->set_link_attributes($id, $button['cta_link']);

                    echo '<a ' . $this->render_attributes($id) . ' class="' . esc_attr(implode(' ', $classes)) . '">';
                    echo esc_html($button['cta_text']);
                    echo '</a>';
                }
            }
            echo '</div>';
        }

        echo '</div>'; // .brxe-dvly-image-text-block__content
        echo '</div>'; // .brxe-dvly-image-text-block__grid
        echo '</div>';
        echo '</section>'; // .brxe-dvly-image-text-block
    }
}
