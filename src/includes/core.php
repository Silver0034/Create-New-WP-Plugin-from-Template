<?php

/**
 * The core for the plugin
 * 
 * @since 1.0.0
 */

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The core plugin class
 * @since 1.0.0
 */
class <%= template.class %>
{
    protected $loader;
    protected $plugin_name;
    protected $version;
    /**
     * Core plugin constructor
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        // define version
        $this->version = <%= template.const %>_VERSION ?? '1.0.0';

        // define name
        $this->plugin_name = '<%= template.class %>';

        // load dependencies
        $this->load_dependencies();

        // define admin hooks
        $this->define_admin_hooks();

        // define public hooks
        $this->define_public_hooks();
    }

    /**
     * Load dependencies
     * 
     * @since 1.0.0
     */
    private function load_dependencies()
    {
        // require loader file
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/loader.php';

        // require admin file
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/admin.php';

        // require public file
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/public.php';

        // create instance of loader
        $this->loader = new <%= template.class %>_Loader();
    }

    /**
     * Register admin hooks
     * 
     * @since 1.0.0
     */
    private function define_admin_hooks()
    {
        // get instance of admin
        $admin = new <%= template.class %>_Admin($this->get_plugin_name(), $this->get_version());

        // add hooks
    }

    /**
     * Register public hooks
     * 
     * @since 1.0.0
     */
    private function define_public_hooks()
    {
        // get instance of admin
        $public = new <%= template.class %>_Public($this->get_plugin_name(), $this->get_version());

        // add hooks
    }

    /**
     * Run the loader
     * 
     * @since 1.0.0
     */
    public function run()
    {
        // run the loader's run function
        $this->loader->run();
    }

    /**
     * Get plugin name
     * 
     * @since 1.0.0
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * get loader
     * 
     * @since 1.0.0
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * get the plugin version
     * @since 
     */
    public function get_version()
    {
        return $this->version;
    }
}
