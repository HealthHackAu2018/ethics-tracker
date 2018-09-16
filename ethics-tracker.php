<?php

/**
 * @since             1.0.0
 * @package           Ethics_Tracker
 * @copyright         2018 Health Hack AU
 *
 * @wordpress-plugin
 * Plugin Name:       EthicsTracker
 * Plugin URI:        https://smallprojects.info/ethics/
 * Description:       Provides php code that powers the ethics-tracker website.
 * Version:           0.0.20
 * Author:            EthicsTracker Team
 * Author URI:        http://github.com/HealthHackAu2018/ethics-tracker
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: HealthHackAu2018/ethics-tracker
 * Text Domain:       ethics-tracker
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ethics-tracker-activator.php
 */
function activate_ethics_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ethics-tracker-activator.php';
	Ethics_Tracker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ethics-tracker-deactivator.php
 */
function deactivate_ethics_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ethics-tracker-deactivator.php';
	Ethics_Tracker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ethics_tracker' );
register_deactivation_hook( __FILE__, 'deactivate_ethics_tracker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ethics-tracker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ethics_tracker() {

	$plugin = new Ethics_Tracker();
	$plugin->run();

}
run_ethics_tracker();

include 'functions.php';

