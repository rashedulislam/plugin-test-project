<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpcommerz.com/
 * @since             1.0.0
 * @package           Wpcommerz
 *
 * @wordpress-plugin
 * Plugin Name:       Test Plugin For WPCommerz
 * Plugin URI:        https://wpcommerz.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            WPCommerz
 * Author URI:        https://wpcommerz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpcommerz
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPCOMMERZ_VERSION', '1.0.0' );

global $task_db_version;
$task_db_version = '1.0';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpcommerz-activator.php
 */
function activate_wpcommerz() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcommerz-activator.php';
	$activate = new Wpcommerz_Activator();
    $activate->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpcommerz-deactivator.php
 */
function deactivate_wpcommerz() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpcommerz-deactivator.php';
	Wpcommerz_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpcommerz' );
register_deactivation_hook( __FILE__, 'deactivate_wpcommerz' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpcommerz.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpcommerz() {

	$plugin = new Wpcommerz();
	$plugin->run();

}
run_wpcommerz();
