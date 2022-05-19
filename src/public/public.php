<?php

/**
 * All public functions
 * 
 * @since 1.0.0
 */

class <%= template.class %>_Public
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