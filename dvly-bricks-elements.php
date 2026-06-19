<?php
/**
 * Plugin Name: DVLY Bricks Elements
 * Description: Custom Bricks Builder elements by DVLY for WooCommerce and more.
 * Version: 1.0.26
 * Author: DVLY
 * 
 * Update URI: https://github.com/devvly/dvly-bricks-elements
 */

if (!defined('ABSPATH')) exit;

define('TWOA_BRICKS_ELEMENTS_VERSION', '1.0.26');
define('TWOA_BRICKS_ELEMENTS_PATH', plugin_dir_path(__FILE__));
define('TWOA_BRICKS_ELEMENTS_URL', plugin_dir_url(__FILE__));
define('TWOA_BRICKS_ELEMENTS_BASENAME', plugin_basename(__FILE__));

require_once TWOA_BRICKS_ELEMENTS_PATH . 'includes/Plugin.php';

$twoa_bricks_elements_plugin = new TwoA_Bricks_Elements_Plugin();
$twoa_bricks_elements_plugin->init();
