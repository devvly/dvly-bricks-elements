<?php

if (!defined('ABSPATH')) {
    exit;
}

class TwoA_Bricks_Elements_Plugin
{
    private $config;

    public function __construct()
    {
        $this->config = [
            'slug' => 'dvly-bricks-elements',
            'user' => 'devvly',
            'repo' => 'dvly-bricks-elements',
            'legacy_element_slugs' => [
                'hero',
                'icon-features',
                'featured-product-categories',
                'featured-products',
                'image-text-block',
                'call-to-action',
                'logo-grid',
            ],
            'twoa_element_slugs' => [
                'hero',
            ],
        ];
    }

    public function init(): void
    {
        $this->load_files();

        $category_manager = new TwoA_Bricks_Category_Manager();
        $category_manager->register_hooks();

        $element_manager = new TwoA_Bricks_Element_Manager($this->config);
        $element_manager->register_hooks();

        add_action('wp_enqueue_scripts', [$this, 'enqueue_legacy_styles']);

        $this->register_updater_hooks();
    }

    private function load_files(): void
    {
        require_once TWOA_BRICKS_ELEMENTS_PATH . 'includes/Bricks/Category_Manager.php';
        require_once TWOA_BRICKS_ELEMENTS_PATH . 'includes/Bricks/Element_Manager.php';
    }

    public function enqueue_legacy_styles(): void
    {
        $base_dir = TWOA_BRICKS_ELEMENTS_PATH . 'elements/';
        $base_uri = TWOA_BRICKS_ELEMENTS_URL . 'elements/';

        foreach ($this->config['legacy_element_slugs'] as $slug) {
            $css_file = $base_dir . $slug . '.css';

            if (!file_exists($css_file)) {
                continue;
            }

            wp_enqueue_style(
                'brxe-dvly-' . $slug,
                $base_uri . $slug . '.css',
                [],
                filemtime($css_file)
            );
        }
    }

    private function register_updater_hooks(): void
    {
        add_filter('site_transient_update_plugins', [$this, 'check_for_github_update']);
        add_filter('plugins_api', [$this, 'get_plugin_information'], 10, 3);
    }

    public function check_for_github_update($transient)
    {
        if (empty($transient->checked)) {
            return $transient;
        }

        $release = $this->get_latest_github_release();

        if (!$release || empty($release->tag_name)) {
            return $transient;
        }

        $new_version = ltrim($release->tag_name, 'v');

        if (version_compare($new_version, TWOA_BRICKS_ELEMENTS_VERSION, '>')) {
            $transient->response[TWOA_BRICKS_ELEMENTS_BASENAME] = (object) [
                'slug' => $this->config['slug'],
                'plugin' => TWOA_BRICKS_ELEMENTS_BASENAME,
                'new_version' => $new_version,
                'url' => $release->html_url ?? '',
                'package' => $this->get_release_download_url($release),
            ];
        }

        return $transient;
    }

    public function get_plugin_information($result, $action, $args)
    {
        if ($action !== 'plugin_information' || empty($args->slug) || $args->slug !== $this->config['slug']) {
            return $result;
        }

        $release = $this->get_latest_github_release();

        if (!$release || empty($release->tag_name)) {
            return $result;
        }

        return (object) [
            'name' => 'DVLY Bricks Elements',
            'slug' => $this->config['slug'],
            'version' => ltrim($release->tag_name, 'v'),
            'author' => '<a href="https://github.com/' . esc_attr($this->config['user']) . '">DVLY</a>',
            'homepage' => $release->html_url ?? '',
            'download_link' => $this->get_release_download_url($release),
            'sections' => [
                'description' => $release->body ?? 'Custom Bricks Builder elements for WooCommerce and more.',
            ],
        ];
    }

    private function get_latest_github_release(): ?object
    {
        $url = sprintf(
            'https://api.github.com/repos/%s/%s/releases/latest',
            rawurlencode($this->config['user']),
            rawurlencode($this->config['repo'])
        );

        $response = wp_remote_get($url, [
            'headers' => ['Accept' => 'application/vnd.github.v3+json'],
            'timeout' => 10,
        ]);

        if (is_wp_error($response)) {
            return null;
        }

        $body = json_decode(wp_remote_retrieve_body($response));

        return is_object($body) ? $body : null;
    }

    private function get_release_download_url(object $release): string
    {
        if (empty($release->assets) || !is_array($release->assets)) {
            return '';
        }

        foreach ($release->assets as $asset) {
            if (!empty($asset->browser_download_url) && substr($asset->browser_download_url, -4) === '.zip') {
                return $asset->browser_download_url;
            }
        }

        return $release->assets[0]->browser_download_url ?? '';
    }
}
