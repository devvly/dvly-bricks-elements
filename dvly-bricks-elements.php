<?php
/**
 * Plugin Name: DVLY Bricks Elements
 * Description: Custom Bricks Builder elements by DVLY for WooCommerce and more.
 * Version: 1.0.0
 * Author: Pablo Accorinti
 * Author URI: https://github.com/pabloaccorinti
 * GitHub Plugin URI: https://github.com/pabloaccorinti/dvly-bricks-elements
 * Primary Branch: main
 * Release Asset: true
 */


if (!defined('ABSPATH')) exit;

add_action('init', function () {
    $element_slugs = [
        'hero',
        'icon-features',
        'featured-product-categories',
        'featured-products',
        'image-text-block',
        'call-to-action'
    ];

    foreach ($element_slugs as $slug) {
        $file = plugin_dir_path(__FILE__) . "elements/{$slug}.php";
        if (file_exists($file)) {
            \Bricks\Elements::register_element($file);
        }
    }

    add_action('wp_enqueue_scripts', function () use ($element_slugs) {
        $base_dir = plugin_dir_path(__FILE__) . 'elements/';
        $base_uri = plugin_dir_url(__FILE__) . 'elements/';

        foreach ($element_slugs as $slug) {
            $css_file = "{$base_dir}{$slug}.css";
            if (file_exists($css_file)) {
                wp_enqueue_style(
                    'brxe-dvly-' . $slug,
                    $base_uri . "{$slug}.css",
                    [],
                    filemtime($css_file)
                );
            }
        }
    });
}, 11);
