<?php

/**
 * <%= template.name %>
 * 
 * @link     https://www.earlenterprise.com/
 * @since    1.0.0
 * @version  1.0.0
 * 
 * @wordpress-plugin
 * Plugin Name:    <%= template.name %>
 * Plugin URI:     https://www.earlenterprise.com/
 * Description:    <%= template.description %>
 * Version:        1.0.0
 * Author:         Earl Enterprises
 * Author URI:     https://www.earlenterprise.com/
 */

// define namespace
namespace <%= template.namespace %>;

use <%= template.namespace %>\Activator as Activator;
use <%= template.namespace %>\Deactivator as Deactivator;
use <%= template.namespace %>\Core as Core;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

// define plugin version constant
define('<%= template.const %>_VERSION', '1.0.0');

/**
 * Activator functions
 * Get an instance of the activator class and run it
 * 
 * @since 1.0.0
 * @version 1.0.0
 * @return void
 */
function activate()
{
    // require and run the activator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/activator.php';

    $activator = Activator::get_instance();
    $activator->activate();
}
// register hook for activator
register_activation_hook(__FILE__, '<%= template.namespace %>\activate');

/**
 * Deactivator functions
 * Get an instance of the deactivator class and run it
 * 
 * @since 1.0.0
 * @version 1.0.0
 * @return void
 */
function deactivate()
{
    // require and run the deactivator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/deactivator.php';

    $deactivator = Deactivator::get_instance();
    $deactivator->deactivate();
}
// register hook for deactivator
register_deactivation_hook(__FILE__, '<%= template.namespace %>\deactivate');

// require core includes file
require_once plugin_dir_path(__FILE__) . 'includes/core.php';

/**
 * Run the plugin
 * Get an instance of the plugin's core class and run it
 *
 * @since 1.0.0
 * @version 1.0.0
 * @return void
 */
function run()
{
    $plugin = Core::get_instance();
    $plugin->run();
}
// run the plugin
run();
