<?php
/**
 * Plugin Name: My Shop Engine
 * Description: A basic e-commerce plugin to showcase
 * Version: 1.0.0
 * Author: Bojidar Valchovski
 * Author URI: https://devrix.com/
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

// Get the plugin version from the file headers.
$plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
$plugin_version = ( ! empty ( $plugin_data ) ) ? $plugin_data['Version'] : '1.0.0';

// Definitions.
defined( 'MSE_INC' ) || define( 'MSE_INC', plugin_dir_path( __FILE__ ) . 'includes/' );

function mse_autoload( $class_name ) {
    $class_file = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';
    $class_path = MSE_INC . $class_file;

    if ( file_exists( $class_path ) ) {
        require $class_path;

        return;
    }
}
spl_autoload_register( 'mse_autoload' );

function mse_init() {
    $instance = MSE_Setup::get_instance();
}
add_action( 'plugins_loaded', 'mse_init' );