<?php
// element-hero.php

if (!defined('ABSPATH'))
  exit; // Exit if accessed directly

class Brxe_Dvly_Hero extends \Bricks\Element
{
  // Element properties
  public $category = 'dvly-elements';
  public $name = 'dvly-hero';
  public $icon = 'ti-layout-width-full';

  // Return localized element label
  public function get_label()
  {
    return esc_html__('Hero', 'bricks');
  }

  // Set builder control groups
  public function set_control_groups()
  {
    $this->control_groups['content'] = [
      'title' => esc_html__('Content', 'bricks'),
      'tab' => 'content',
    ];
    $this->control_groups['cta'] = [
      'title' => esc_html__('Call to Action', 'bricks'),
      'tab' => 'content',
    ];
    $this->control_groups['appereance'] = [
      'title' => esc_html__('Appereance', 'bricks'),
      'tab' => 'content',
    ];
  }

  // Set builder controls
  public function set_controls()
  {

    $this->controls['hero_alignment'] = [
      'tab' => 'content',
      'group' => 'appereance',
      'label' => esc_html__('Alignment', 'bricks'),
      'type' => 'text-align',
      'css' => [
        [
          'property' => 'text-align',
          'selector' => '.brxe-dvly-hero-content',
        ],
        [
            'property' => 'justify-content',
            'selector' => '.brxe-dvly-hero-buttons',
        ],
      ],
    ];
    // Hero Above title
    $this->controls['hero_above_title'] = [
      'tab' => 'content',
      'group' => 'content',
      'label' => esc_html__('Hero above title', 'bricks'),
      'type' => 'text',
      'spellcheck' => true, // Default: false
      // 'trigger' => 'enter', // Default: 'enter'
      'inlineEditing' => true,
      'default' => 'Here goes the text above the hero title',
    ];

    $this->controls['above_title_typography'] = [
      'tab' => 'content',
      'group' => 'appereance',
      'label' => esc_html__('Above title typography', 'bricks'),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxe-dvly-hero-above-title',
        ],
      ],
      'inline' => true,
    ];


    // Hero Title
    $this->controls['hero_title'] = [
      'tab' => 'content',
      'group' => 'content',
      'label' => esc_html__('Hero title', 'bricks'),
      'type' => 'text',
      'spellcheck' => true, // Default: false
      // 'trigger' => 'enter', // Default: 'enter'
      'inlineEditing' => true,
      'default' => 'Here goes your text ..',
    ];

    $this->controls['title_typography'] = [
      'tab' => 'content',
      'group' => 'appereance',
      'label' => esc_html__('Title typography', 'bricks'),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxe-dvly-hero-title',
        ],
      ],
      'inline' => true,
    ];

    $this->controls['hero_subtitle'] = [
      'tab' => 'content',
      'group' => 'content',
      'label' => esc_html__('Hero subtitle', 'bricks'),
      'type' => 'editor',
      'inlineEditing' => [
        'selector' => '.brxe-dvly-hero-subtitle', // Mount inline editor to this CSS selector
        'toolbar' => true, // Enable/disable inline editing toolbar
      ],
      'default' => esc_html__('Here goes the content ..', 'bricks'),
    ];


    $this->controls['subtitle_typography'] = [
      'tab' => 'content',
      'group' => 'appereance',
      'label' => esc_html__('Subtitle typography', 'bricks'),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.brxe-dvly-hero-subtitle',
        ],
      ],
      'inline' => true,
    ];

    $this->controls['hero_buttons'] = [
      'tab' => 'content',
      'group' => 'cta',
      'label' => esc_html__('Buttons', 'bricks'),
      'type' => 'repeater',
      'titleProperty' => 'cta_text', // Display button text in repeater title
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
    // Retrieve settings safely
    $settings = $this->settings ?? [];

    // ✅ Ensure Bricks Builder applies live styles by adding the `_root` class dynamically
    $this->set_attribute('_root', 'class', $this->name);
    $this->set_attribute('_root', 'class', 'brxe-section');


    // Start rendering the HTML structure
    echo '<section ' . $this->render_attributes('_root') . '>';
    echo '<div class="brxe-dvly-hero-content brxe-container">';


    if (isset($this->settings['hero_above_title'])) {
      echo '<h3 class="brxe-dvly-hero-above-title">' . $this->settings['hero_above_title'] . '</h3>';
    }

    if (isset($this->settings['hero_title'])) {
      echo '<h1 class="brxe-dvly-hero-title">' . $this->settings['hero_title'] . '</h1>';
    }


    if (isset($this->settings['hero_subtitle'])) {
      echo '<div class="brxe-dvly-hero-subtitle">' . $this->settings['hero_subtitle'] . '</div>';
    }


    if (!empty($settings['hero_buttons']) && is_array($settings['hero_buttons'])) {
      echo '<div class="brxe-dvly-hero-buttons">';

      foreach ($settings['hero_buttons'] as $button) {
        if (!empty($button['cta_text']) && !empty($button['cta_link'])) {
          $button_classes = ['brxe-button', 'brxe-dvly-hero-button', 'bricks-button'];
          if (!empty($button['cta_style'])) {
            $button_classes[] = 'bricks-button-' . esc_attr($button['cta_style']);
          }
          if (!empty($button['cta_size'])) {
            $button_classes[] = esc_attr($button['cta_size']);
          }

          // Set Bricks link attributes (handles all link types)
          $link_key = 'cta_link_' . md5($button['cta_text'] . $button['cta_link']['url'] ?? uniqid());
          $this->set_link_attributes($link_key, $button['cta_link']);

          echo '<a ' . $this->render_attributes($link_key) . ' class="' . esc_attr(implode(' ', $button_classes)) . '">';
          echo esc_html($button['cta_text']);
          echo '</a>';
        }
      }

      echo '</div>';
    }



    echo '</div>';
    echo '</section>';
  }

}
