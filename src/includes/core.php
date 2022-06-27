<?php

/**
 * The core for the plugin
 * 
 * @since 1.0.0
 */

// define namespace
namespace <%= template.namespace %>;

use <%= template.namespace %>\Admin as Admin;
use <%= template.namespace %>\FrontEnd as FrontEnd;
use <%= template.namespace %>\Loader as Loader;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The core plugin class
 * @since 1.0.0
 */
class Core
{
    protected $loader;
    protected $plugin_name;
    protected $version;
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

        // define front end hooks
        $this->define_front_end_hooks();
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/methods.php';

        // require front end file
        require_once plugin_dir_path(dirname(__FILE__)) . 'front-end/methods.php';

        // create instance of loader
        $this->loader = Loader::get_instance();
    }

    /**
     * Register admin hooks
     * 
     * @since 1.0.0
     */
    private function define_admin_hooks()
    {
        // get instance of admin
        $admin = Admin::get_instance($this->get_plugin_name(), $this->get_version());

        // add hooks
    }

    /**
     * Register front end hooks
     * 
     * @since 1.0.0
     */
    private function define_front_end_hooks()
    {
        // get instance of admin
        $front_end = FrontEnd::get_instance($this->get_plugin_name(), $this->get_version());

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
