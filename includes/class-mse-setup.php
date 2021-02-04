<?php
/**
 * Our initial plugin setup class.
 */

class MSE_Setup {

    /**
     * Holds the singleton instance.
     */
    private static $instance;

    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new MSE_Setup();
        }

        return self::$instance;
    }

    public function __construct() {
        new MSE_Products();

        new MSE_Orders();
    }
}