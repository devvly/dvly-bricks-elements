<?php
/**
 * Plugin Name: DVLY Bricks Elements
 * Description: Custom Bricks Builder elements by DVLY for WooCommerce and more.
 * Version: 1.0.0
 * Author: Pablo Accorinti
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




/**
 * Auto detect updates
 */

 add_filter('site_transient_update_plugins', function ($transient) {
    if (empty($transient->checked)) return $transient;

    $plugin_slug = 'dvly-bricks-elements';
    $plugin_file = plugin_basename(__FILE__);
    $github_user = 'pabloaccorinti';
    $github_repo = 'dvly-bricks-elements';

    // Get latest release from GitHub
    $response = wp_remote_get("https://api.github.com/repos/{$github_user}/{$github_repo}/releases/latest", [
        'headers' => ['Accept' => 'application/vnd.github.v3+json']
    ]);

    if (is_wp_error($response)) return $transient;

    $release = json_decode(wp_remote_retrieve_body($response));

    if (!isset($release->tag_name)) return $transient;

    $new_version = ltrim($release->tag_name, 'v'); // e.g. v1.0.1 -> 1.0.1
    $current_version = get_plugin_data(__FILE__)['Version'];

    if (version_compare($new_version, $current_version, '>')) {
        $transient->response[$plugin_file] = (object) [
            'slug'        => $plugin_slug,
            'plugin'      => $plugin_file,
            'new_version' => $new_version,
            'url'         => $release->html_url,
            'package'     => $release->zipball_url,
        ];
    }

    return $transient;
});

add_filter('plugins_api', function ($result, $action, $args) {
    if ($action !== 'plugin_information') return $result;
    if ($args->slug !== 'dvly-bricks-elements') return $result;

    $github_user = 'YOUR_GITHUB_USERNAME';
    $github_repo = 'dvly-bricks-elements';

    $response = wp_remote_get("https://api.github.com/repos/{$github_user}/{$github_repo}/releases/latest", [
        'headers' => ['Accept' => 'application/vnd.github.v3+json']
    ]);

    if (is_wp_error($response)) return $result;

    $release = json_decode(wp_remote_retrieve_body($response));

    $result = (object)[
        'name'          => 'DVLY Bricks Elements',
        'slug'          => $args->slug,
        'version'       => ltrim($release->tag_name, 'v'),
        'author'        => '<a href="https://github.com/' . $github_user . '">Pablo Accorinti</a>',
        'homepage'      => $release->html_url,
        'download_link' => $release->zipball_url,
        'sections'      => [
            'description' => $release->body ?? 'Custom Bricks Builder elements for WooCommerce and more.',
        ],
    ];

    return $result;
}, 10, 3);
