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

// stop if called directly
if (!defined('WPINC')) die;

// define plugin version constant
define('<%= template.const %>_VERSION', '1.0.0');

// activator functions
function activate_<%= template.var %>()
{
    // require and run the activator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/activator.php';
    <%= template.class %>_Activator::activate();
}
register_activation_hook(__FILE__, 'activate_<%= template.var %>');

// deactivator functions
function deactivate_<%= template.var %>()
{
    // require and run the deactivator from includes
    require_once plugin_dir_path(__FILE__) . 'includes/deactivator.php';
    <%= template.class %>_Deactivator::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_<%= template.var %>');

// require core includes file
require_once plugin_dir_path(__FILE__) . 'includes/core.php';

// run the function
function run_<%= template.var %>()
{
    $plugin = new <%= template.class %>();
    $plugin->run();
}
run_<%= template.var %>();
