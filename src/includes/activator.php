<?php

/**
 * Runs on plugin activation
 * 
 * @since 1.0.0
 */

// define namespace
namespace <%= template.namespace %>;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The activator class
 * @since 1.0.0
 */
class Activator
{
    protected static $instance = NULL;

    /**
     * Get the existing instance of the class
     * 
     * @since 1.0.0
     */
    public static function get_instance()
    {
        // create an object
        if (NULL === self::$instance) {
            self::$instance = new self;
        }

        // return the instance of the class
        return self::$instance;
    }

    /**
     * the code to run on activate
     *
     * @since 1.0.0
     */
    public function activate()
    {
        // activator code goes here
    }
}
