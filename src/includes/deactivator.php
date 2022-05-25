<?php

/**
 * Runs on plugin deactivation
 * 
 * @since 1.0.0
 */

// define namespace
namespace <%= template.namespace %>\Deactivate;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The deactivator class
 * 
 * @since 1.0.0
 */
class Methods
{
    /**
     * the code to run on deactivate
     *
     * @since 1.0.0
     */
    public static function deactivate()
    {
        // deactivator code goes here
    }
}
