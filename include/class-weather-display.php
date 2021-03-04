<?php
/**
 * Weather Display Plugin
 *
 * This is the base plugin file for the weather display
 *
 * @category   Weather Display
 * @package    WordPress
 */

/**
 * The Weather Display Class.
 */
class Weather_Display {

  /**
   * The initial setup of the plugin
   */
  public function __construct() {

    $this->load_scripts();
    $this->load_styles();
    
    add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

  }

  /**
   * Register Scripts
   *
   * @return void
   */
  public function load_scripts() {

    add_action( 'wp_enqueue_scripts', 'script_enqueue' );
      
    function script_enqueue() {
      wp_register_script( 'weather-display-js', plugin_dir_url( __FILE__ ) . '/front/js/main.js', array('jquery') );
      
      wp_register_script( 'font-awesome', 'https://kit.fontawesome.com/b74ed9925b.js' );
      wp_enqueue_script('jquery'); 
    
      wp_enqueue_script( 'weather-display-js' );
      wp_enqueue_script( 'font-awesome' );
    }

  }

  /**
   * Enqueue stylesheets
   *
   * @return void
   */
  private function load_styles() {
    wp_enqueue_style( 'weather-display-css', plugin_dir_url( __FILE__ ) . '/front/css/main.css', array(), false );
  }

  /**
   * Add the admin page to the WP sidebar
   *
   * @return void
   */
  public function add_admin_page() {
    add_menu_page( 'Weather Display Settings', 'Weather Display', 'manage_options', 'weather-admin-page', array( $this, 'build_admin_page' ) );
    
    //register setting
    add_action( 'admin_init', 'add_settings' );

    function add_settings() {
      register_setting( 'weather-settings', 'weather-settings_city' );
    }

  }

  /**
   * Builds out the admin HTML
   *
   * @return void
   */
  public function build_admin_page() {
    include WEATHER_PLUGIN_DIR_PATH . '/include/admin/admin.php';
  }

}


