<?php

/**
 * <%= template.name %>
 * 
 * @link     https://www.earlenterprise.com/
 * @since    1.0.0
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

use <%= template.namespace %>\Activate as Activate;
use <%= template.namespace %>\Deactivate as Deactivate;
use <%= template.namespace %>\Core as Core;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

// define plugin version constant
define('<%= template.const %>_VERSION', '1.0.0');

// activator functions
function activate()
{
    // require and run the activator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/activator.php';

   Activate\Methods::activate();
}
register_activation_hook(__FILE__, '<%= template.namespace %>\activate');

// deactivator functions
function deactivate()
{
    // require and run the deactivator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/deactivator.php';
    Deactivate\Methods::deactivate();
}
register_deactivation_hook(__FILE__, '<%= template.namespace %>\deactivate');

// require core includes file
require_once plugin_dir_path(__FILE__) . 'includes/core.php';

// run the function
function run()
{
    $plugin = new Core\Methods();
    $plugin->run();
}
run();
