<?php

if (!defined('ABSPATH')) {
    exit;
}

class TwoA_Bricks_Element_Manager
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function register_hooks(): void
    {
        add_action('init', [$this, 'register_elements'], 11);
    }

    public function register_elements(): void
    {
        if (!class_exists('\Bricks\Elements')) {
            return;
        }

        $this->register_legacy_elements();
        $this->register_twoa_elements();
    }

    private function register_legacy_elements(): void
    {
        foreach ($this->config['legacy_element_slugs'] as $slug) {
            $this->register_element_file(TWOA_BRICKS_ELEMENTS_PATH . 'elements/legacy/dvly/' . $slug . '.php');
        }
    }

    private function register_twoa_elements(): void
    {
        foreach ($this->config['twoa_element_slugs'] as $slug) {
            $this->register_element_file(TWOA_BRICKS_ELEMENTS_PATH . 'elements/twoa/' . $slug . '.php');
        }
    }

    private function register_element_file(string $file): void
    {
        if (file_exists($file)) {
            \Bricks\Elements::register_element($file);
        }
    }
}
