<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Garrison_brewing
 *
 * @wordpress-plugin
 * Plugin Name:       Garrison Brewing Company
 * Plugin URI:        #
 * Description:       Using API you can able to display beer info and beer and review in the page.
 * Version:           1.0.0
 * Author:            Maulik Paddharia
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       garrison_brewing
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
define( 'GARRISON_BREWING_VERSION', '1.0.0' );

/**
 * Define custom const.
 */
define( 'API_ENDPOINT', 'https://api.untappd.com/v4' );
define( 'CLIENT_ID', '3B699F2A6042F01F5F198865B533DAE74E4498EF' );
define( 'CLIENT_SECRET', '6A750CCE8AC023F996133E376E3B58EC5478BCD5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-garrison_brewing-activator.php
 */
function activate_garrison_brewing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-garrison_brewing-activator.php';
	Garrison_brewing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-garrison_brewing-deactivator.php
 */
function deactivate_garrison_brewing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-garrison_brewing-deactivator.php';
	Garrison_brewing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_garrison_brewing' );
register_deactivation_hook( __FILE__, 'deactivate_garrison_brewing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-garrison_brewing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_garrison_brewing() {

	$plugin = new Garrison_brewing();
	$plugin->run();

}
run_garrison_brewing();
