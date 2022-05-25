<?php

/**
 * All admin functions
 * 
 * @since 1.0.0
 */

// define namespace
namespace <%= template.namespace %>\Admin;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The admin class
 * 
 * @since 1.0.0
 */
class Methods
{
    private $plugin_name;
    private $version;

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
