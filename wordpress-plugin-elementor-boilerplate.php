<?php
/**
 * Plugin Name: Elementor Custom Widget
 * Description: Custom Elementor widgets.
 * Plugin URI: https://github.com/litys/wordpress-plugin-elementor-boilerplate
 * Version: 1.0.0
 * Author: LityS
 * Author URI: https://github.com/litys
 * Text Domain: litys-custom-blocks
 * Domain Path: /languages
 * License: MIT
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class LityS_Elementor_Custom_Widget {

  public function __construct() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    add_action('elementor/init', [$this, 'add_elementor_categories']);
  }

  public function enqueue_assets() {
    wp_enqueue_style('litys-custom-blocks-css', plugin_dir_url(__FILE__) . 'dist/css/main.css', [], '1.0.0');
    wp_enqueue_script('litys-custom-blocks-js', plugin_dir_url(__FILE__) . 'dist/js/main.js', [], '1.0.0', true);
  }

  public function add_elementor_categories() {
    \Elementor\Plugin::instance()->elements_manager->add_category(
      'litys-custom-blocks',
      [
        'title' => __('LityS Custom Widgets', 'litys-custom-blocks'),
        'icon' => 'fa fa-plug',
      ],
      0
    );
  }

  public function register_widgets() {
    require_once(__DIR__ . '/widgets/demo.php');

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Demo());
  }

}

function litys_elementor_custom_widget_init() {
  new LityS_Elementor_Custom_Widget();
}
add_action('plugins_loaded', 'litys_elementor_custom_widget_init');

add_action('plugins_loaded', function () {
  load_plugin_textdomain('litys-custom-blocks', false, dirname(plugin_basename(__FILE__)) . '/languages/');
});