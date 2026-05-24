<?php

if (!defined('ABSPATH')) {
    exit;
}

class TwoA_Bricks_Category_Manager
{
    public function register_hooks(): void
    {
        add_filter('bricks/elements/categories', [$this, 'register_categories'], 9999);
        add_filter('bricks/builder/elements/categories', [$this, 'register_categories'], 9999);
        add_filter('bricks/builder/i18n', [$this, 'register_category_i18n'], 9999);
        add_filter('bricks/builder/first_element_category', [$this, 'set_first_element_category'], 9999, 3);
    }

    public function register_categories(array $categories): array
    {
        if ($this->is_list_of_category_objects($categories)) {
            return $this->prepend_object_categories($categories);
        }

        return $this->prepend_key_value_categories($categories);
    }

    private function is_list_of_category_objects(array $categories): bool
    {
        if ($categories === []) {
            return false;
        }

        return array_keys($categories) === range(0, count($categories) - 1)
            && is_array($categories[0] ?? null);
    }

    private function prepend_object_categories(array $categories): array
    {
        $filtered = array_values(array_filter($categories, static function ($category): bool {
            if (!is_array($category)) {
                return true;
            }

            $slug = $category['slug'] ?? $category['name'] ?? null;
            return !in_array($slug, ['twoa-elements', 'dvly-legacy-elements'], true);
        }));

        $custom = [
            [
                'slug' => 'twoa-elements',
                'name' => esc_html__('TwoA Elements', 'bricks'),
                'title' => esc_html__('TwoA Elements', 'bricks'),
            ],
            [
                'slug' => 'dvly-legacy-elements',
                'name' => esc_html__('DVLY Legacy Elements', 'bricks'),
                'title' => esc_html__('DVLY Legacy Elements', 'bricks'),
            ],
        ];

        return array_merge($custom, $filtered);
    }

    private function prepend_key_value_categories(array $categories): array
    {
        unset($categories['twoa-elements'], $categories['dvly-legacy-elements']);

        $custom = [
            'twoa-elements' => esc_html__('TwoA Elements', 'bricks'),
            'dvly-legacy-elements' => esc_html__('DVLY Legacy Elements', 'bricks'),
        ];

        return $custom + $categories;
    }

    public function register_category_i18n(array $i18n): array
    {
        $i18n['twoa-elements'] = esc_html__('TwoA Elements', 'bricks');
        $i18n['dvly-legacy-elements'] = esc_html__('DVLY Legacy Elements', 'bricks');

        return $i18n;
    }

    public function set_first_element_category($category, $post_id, $post_type)
    {
        return 'twoa-elements';
    }
}
