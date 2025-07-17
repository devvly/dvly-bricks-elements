<?php
/**
 * Plugin Name: DVLY Bricks Elements
 * Description: Custom Bricks Builder elements by DVLY for WooCommerce and more.
 * Version: 1.0.5
 * Author: DVLY
 */

if (!defined('ABSPATH')) exit;

/**
 * Configuration
 */
$dvly_config = [
    'slug'         => 'dvly-bricks-elements',
    'user'         => 'devvly',
    'repo'         => 'dvly-bricks-elements',
    'plugin_file'  => plugin_basename(__FILE__),
    'element_slugs' => [
        'hero',
        'icon-features',
        'featured-product-categories',
        'featured-products',
        'image-text-block',
        'call-to-action',
        'logo-grid'
    ]
];

/**
 * Include Plugin Update Checker
 */
require_once plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

$dvly_updater = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/' . $dvly_config['user'] . '/' . $dvly_config['repo'],
    __FILE__,
    $dvly_config['slug']
);

// Use GitHub release assets (uses attached ZIP instead of GitHub auto-zip)
$dvly_updater->getVcsApi()->enableReleaseAssets();

// Optional: If your repo is private, add token like:
// $dvly_updater->setAuthentication('YOUR_GITHUB_PAT');

/**
 * Register Bricks elements
 */
add_action('init', function () use ($dvly_config) {
    foreach ($dvly_config['element_slugs'] as $slug) {
        $file = plugin_dir_path(__FILE__) . "elements/{$slug}.php";
        if (file_exists($file)) {
            \Bricks\Elements::register_element($file);
        }
    }
}, 11);

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', function () use ($dvly_config) {
    $base_dir = plugin_dir_path(__FILE__) . 'elements/';
    $base_uri = plugin_dir_url(__FILE__) . 'elements/';

    foreach ($dvly_config['element_slugs'] as $slug) {
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
