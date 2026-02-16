<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

class Brxe_Dvly_Featured_Products extends \Bricks\Element
{
    public $category = 'dvly-elements';
    public $name = 'dvly-featured-products';
    public $icon = 'ti-star';
    public $scripts = ['brxeFeaturedProductsInit'];

    public function enqueue_scripts()
    {
        wp_enqueue_style('splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css', [], null);
        wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js', [], null, true);

        wp_register_script(
            'brxe-dvly-featured-products-init',
            false,
            ['splide-js'],
            null,
            true
        );

        wp_add_inline_script('brxe-dvly-featured-products-init', "
            window.brxeFeaturedProductsInit = function () {
                document.querySelectorAll('#featured-products-slider').forEach(function (slider) {
                    if (!slider || slider.classList.contains('is-initialized')) return;

                    var perPage = parseInt(slider.dataset.perPage) || 4;
                    var loop = slider.dataset.loop === 'true';
                    var arrowsColor = slider.dataset.arrowsColor || '#eeeeee';

                    var splide = new Splide(slider, {
                        type: loop ? 'loop' : 'slide',
                        perPage: perPage,
                        perMove: 1,
                        gap: slider.dataset.gap ? slider.dataset.gap + 'px' : '24px',
                        autoplay: slider.dataset.autoplay === 'true',
                        pagination: false,
                        arrows: true,
                        arrowPath: '',
                        classes: {
                            arrows: 'splide__arrows custom-splide-arrows',
                            arrow : 'splide__arrow custom-splide-arrow',
                            prev  : 'splide__arrow--prev custom-splide-arrow-prev',
                            next  : 'splide__arrow--next custom-splide-arrow-next',
                        },
                        breakpoints: {
                            992: {
                                perPage: 3
                            },
                            768: {
                                perPage: 2
                            }
                        },
                    });

                    // Apply arrow color
                    splide.on('mounted', function () {
                        const arrows = slider.querySelectorAll('.custom-splide-arrow');
                        arrows.forEach(arrow => {
                            arrow.style.color = arrowsColor;
                        });
                    });

                    splide.mount();
                    slider.classList.add('is-initialized');
                });
            };

            document.addEventListener('DOMContentLoaded', function () {
                if (typeof window.brxeFeaturedProductsInit === 'function') {
                    window.brxeFeaturedProductsInit();
                }
            });

            if (window.bricks) {
                window.bricks.on('frontend.update', function () {
                    if (typeof window.brxeFeaturedProductsInit === 'function') {
                        window.brxeFeaturedProductsInit();
                    }
                });
            }
        ");

        wp_enqueue_script('brxe-dvly-featured-products-init');
    }

    public function get_label()
    {
        return esc_html__('Featured Products', 'bricks');
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
        $this->control_groups['product_item'] = [
            'title' => esc_html__('Product Item', 'bricks'),
            'tab'   => 'content',
        ];        
    }

    public function set_controls()
    {
        $this->controls['above_title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Above Title', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Featured', 'bricks'),
        ];

        $this->controls['title'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Title', 'bricks'),
            'type' => 'text',
            'default' => esc_html__('Our Top Picks', 'bricks'),
        ];

        $this->controls['description'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Description', 'bricks'),
            'type' => 'textarea',
            'default' => esc_html__('Discover our best-selling products.', 'bricks'),
        ];

        $this->controls['selected_products'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__('Select Products', 'bricks'),
            'type' => 'select',
            'multiple' => true,
            'options' => $this->get_product_options(),
            'description' => esc_html__('Select up to 4 products to display.', 'bricks'),
        ];

        $this->controls['per_page'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Products Per Page', 'bricks'),
            'type' => 'number',
            'default' => 4,
            'min' => 2,
            'max' => 6,
        ];

        $this->controls['gap'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Gap Between Items (px)', 'bricks'),
            'type' => 'number',
            'default' => 24,
            'min' => 0,
            'max' => 100,
        ];

        $this->controls['autoplay'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Autoplay', 'bricks'),
            'type' => 'checkbox',
            'default' => false,
        ];

        $this->controls['loop_slider'] = [
            'tab'     => 'content',
            'group'   => 'appearance',
            'label'   => esc_html__('Loop', 'bricks'),
            'type'    => 'checkbox',
            'default' => false,
            'description' => esc_html__('Enable looping slides (wrap around). Default is off.', 'bricks'),
        ];

        $this->controls['arrows_color'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Arrows Color', 'bricks'),
            'type' => 'color',
            'default' => '#eeeeee',
            'css' => [
                [
                    'property' => 'fill',
                    'selector' => '.custom-splide-arrow svg path',
                ],
            ],
        ];        

        $this->controls['alignment'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Alignment', 'bricks'),
            'type' => 'text-align',
            'css' => [
                [
                    'property' => 'text-align',
                    'selector' => '.brxe-dvly-featured-products-container',
                ],
            ],
        ];

        $this->controls['above_title_typography'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Above Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-featured-products-above-title',
                ],
            ],
        ];

        $this->controls['title_typography'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Title Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-featured-products-title',
                ],
            ],
        ];

        $this->controls['description_typography'] = [
            'tab' => 'content',
            'group' => 'appearance',
            'label' => esc_html__('Description Typography', 'bricks'),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-featured-products-description',
                ],
            ],
        ];
        $this->controls['product_title_typography'] = [
            'tab'   => 'content',
            'group' => 'product_item',
            'label' => esc_html__('Product Title Typography', 'bricks'),
            'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-featured-product-title',
                ],
            ],
        ];
        
        $this->controls['product_price_typography'] = [
            'tab'   => 'content',
            'group' => 'product_item',
            'label' => esc_html__('Product Price Typography', 'bricks'),
            'type'  => 'typography',
            'css'   => [
                [
                    'property' => 'typography',
                    'selector' => '.brxe-dvly-featured-product-price',
                ],
            ],
        ];        
    }

    private function get_product_options($limit = 200)
    {
        $limit = (int) apply_filters('dvly_featured_products_options_limit', $limit);
        if ($limit < 1) {
            $limit = 1;
        }

        $transient_key = 'dvly_fp_options_' . $limit;
        $cached = get_transient($transient_key);
        if (is_array($cached)) {
            return $cached;
        }

        $product_ids = wc_get_products([
            'status' => 'publish',
            'limit' => $limit,
            'return' => 'ids',
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        $options = [];
        foreach ($product_ids as $product_id) {
            $options[$product_id] = get_the_title($product_id);
        }

        set_transient($transient_key, $options, 10 * MINUTE_IN_SECONDS);

        return $options;
    }

    public function render()
    {
        $settings = $this->settings ?? [];
        $above_title = esc_html($settings['above_title'] ?? '');
        $title = esc_html($settings['title'] ?? '');
        $description = esc_html($settings['description'] ?? '');
        $default_ids = wc_get_products([
            'status' => 'publish',
            'limit' => 4,
            'return' => 'ids',
            'orderby' => 'date',
            'order' => 'DESC',
        ]);
        $selected_products = !empty($settings['selected_products']) ? $settings['selected_products'] : $default_ids;
        $per_page = intval($settings['per_page'] ?? 4);
        $gap = intval($settings['gap'] ?? 24);
        $autoplay = !empty($settings['autoplay']) ? 'true' : 'false';
        $loop_slider = !empty($settings['loop_slider']) ? 'true' : 'false';
        $arrows_color = '#eeeeee';

        if (!empty($settings['arrows_color'])) {
            if (is_array($settings['arrows_color']) && isset($settings['arrows_color']['color'])) {
                $arrows_color = $settings['arrows_color']['color'];
            } elseif (is_string($settings['arrows_color'])) {
                $arrows_color = $settings['arrows_color'];
            }
        }        
        
        echo '<section ' . $this->render_attributes('_root') . ' class="brxe-dvly-featured-products brxe-section">';
        echo '<div class="brxe-dvly-featured-products-container brxe-container">';

        if ($above_title || $title || $description) {
            echo '<div class="brxe-dvly-featured-products-header">';

            if ($above_title) {
                echo '<h6 class="brxe-dvly-featured-products-above-title">' . $above_title . '</h6>';
            }
            if ($title) {
                echo '<h2 class="brxe-dvly-featured-products-title">' . $title . '</h2>';
            }
            if ($description) {
                echo '<p class="brxe-dvly-featured-products-description">' . $description . '</p>';
            }

            echo '</div>';
        }

        echo '<div class="splide" id="featured-products-slider" data-per-page="' . esc_attr($per_page) . '" data-gap="' . esc_attr($gap) . '" data-autoplay="' . esc_attr($autoplay) . '" data-loop="' . esc_attr($loop_slider) . '" data-arrows-color="' . esc_attr($arrows_color) . '">';

        echo '<div class="splide__track">';
        echo '<ul class="splide__list">';

        foreach ($selected_products as $product_id) {
            $product = wc_get_product($product_id);
            if ($product) {
                $link = get_permalink($product_id);
                $title = $product->get_name();
                $image = wp_get_attachment_image($product->get_image_id(), 'medium', false, ['loading' => 'eager']);
                $price_html = $product->get_price_html();

                echo '<li class="splide__slide">';
                echo '<div class="brxe-dvly-featured-product-item">';
                echo '<div class="brxe-dvly-featured-product-item-image">';
                echo '<a href="' . esc_url($link) . '">' . $image . '</a>';
                echo '</div>';
                echo '<div class="brxe-dvly-featured-product-item-content">';
                echo '<h4 class="brxe-dvly-featured-product-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h4>';

                echo '<div class="brxe-dvly-featured-product-price">' . $price_html . '</div>';

                $add_to_cart_url = esc_url($product->add_to_cart_url());
                $add_to_cart_text = esc_html($product->add_to_cart_text());
                $add_to_cart_class = implode(' ', array_filter([
                    'button',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                ]));

                echo '<div class="brxe-dvly-featured-product-add-to-cart">';
                echo '<div class="brxe-dvly-featured-product-add-to-cart-container">';
                echo '<a href="' . $add_to_cart_url . '" data-product_id="' . esc_attr($product_id) . '" class="' . $add_to_cart_class . '" rel="nofollow">' . $add_to_cart_text . '</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        }

        echo '</ul></div></div></div></section>';
    }
}
