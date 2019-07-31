<?php
/**
 * Plugin Name: ZohoCRM
 * Plugin URI:  https://zohocrm.com
 * Description: Plugin to access Zoho CRM
 * Version:     1.0.0
 * Author:      Rob Williams rwilliams@brownbagmarketing.com
 * Author URI:  https://brownbagmarketing.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wporg
 * Domain Path: /languages
 * {Plugin Name} is free software: you can redistribute it and/or modify
 *it under the terms of the GNU General Public License as published by
 *the Free Software Foundation, either version 2 of the License, or
 *any later version.
 
 *ZohoCRM is distributed in the hope that it will be useful,
 *but WITHOUT ANY WARRANTY; without even the implied warranty of
 *MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *GNU General Public License for more details.
 
 *You should have received a copy of the GNU General Public License
 *along with ZohoCRM. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */


 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zohoCRM-activator.php
 */
function activate_zohoCRM() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zohoCRM-activator.php';
	ZohoCRM_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zohoCRM-deactivator.php
 */
function deactivate_zohoCRM() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zohoCRM-deactivator.php';
	ZohoCRM_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zohoCRM' );
register_deactivation_hook( __FILE__, 'deactivate_zohoCRM' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zohoCRM.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zohoCRM() {

	$plugin = new ZohoCRM();
	$plugin->run();
}
run_zohoCRM();
