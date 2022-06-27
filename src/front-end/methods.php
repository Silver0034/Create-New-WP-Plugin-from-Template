<?php

/**
 * All public functions
 * 
 * @since 1.0.0
 */

// define namespace
namespace <%= template.namespace %>;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The public class
 * 
 * @since 1.0.0
 */
class FrontEnd
{
    private $plugin_name;
    private $version;
    protected static $instance = NULL;

    /**
     * Get the existing instance of the class
     * 
     * @since 1.0.0
     */
    public static function get_instance($plugin_name = '<%= template.class %>', $version = '1.0.0')
    {
        // create an object
        if (NULL === self::$instance) {
            self::$instance = new self($plugin_name, $version);
        }

        // return the instance of the class
        return self::$instance;
    }

    /**
     * Construct the public class
     *
     * @since 1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
}
