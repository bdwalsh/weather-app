<?php
/**
 * Plugin Name:     Weather Display
 * Description:     A plugin to make api calls and display weather information.
 * Author:          Brendan Walsh
 * Version:         1.0.0
 *
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin prefix
 */
define( 'WEATHER_PLUGIN_SLUG', 'weather_display' );

/**
 * Plugin directory url
 */
define( 'WEATHER_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * Plugin directory path
 */
define( 'WEATHER_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );


require_once WEATHER_PLUGIN_DIR_PATH . '/include/class-weather-display.php';
require_once WEATHER_PLUGIN_DIR_PATH . '/include/index.php';

$display = new Weather_display;