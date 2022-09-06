<?php

/**
 * Runs on plugin deactivation
 * 
 * @since 1.0.0
 * @version 1.0.0
 */

// define namespace
namespace <%= template.namespace %>;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The deactivator class
 * 
 * @since 1.0.0
 * @version 1.0.0
 */
class Deactivator
{
    protected static $instance = NULL;

    /**
     * Get the existing instance of the class
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return <%= template.namespace %>\Deactivator The plugin's deactivator class
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
     * the code to run on deactivate
     *
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    public function deactivate()
    {
        // deactivator code goes here
    }
}
