<?php

/**
 * Runs on plugin deactivation
 * 
 * @since 1.0.0
 */

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The deactivator class
 * 
 * @since 1.0.0
 */
class <%= template.class %>_Deactivator
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
