<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Font-Awesome-Easy-Way
 * @author    Łukasz Jasiński <studio@ljasinski.pl>
 * @license   GPL-2.0+
 * @link      http://www.ljasinski.pl/category/komputery/wordpress-komputery/pluginy/font-awesome-easy-way/
 * @copyright 2013 Studio Multimedialne ljasinski.pl
 * @todo	  licencing shit http://fontawesome.io/license/
 * @todo      other css classes
 * @todo	  editor plugin
 * @todo      additional icons
 *
 * @wordpress-plugin
 * Plugin Name:       Font Awsome the easy way
 * Plugin URI:        http://www.ljasinski.pl/category/komputery/wordpress-komputery/pluginy/font-awesome-easy-way/
 * Description:       @TODO
 * Version:           0.1.0
 * Author:            Łukasz Jasiński
 * Author URI:        <studio@ljasinski.pl>
 * Text Domain:       font-awesome-easy-way
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die ;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once (plugin_dir_path(__FILE__) . 'public/class-font-awesome.php');

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */

register_activation_hook(__FILE__, array('LJPL_FontAwesome', 'activate'));
register_deactivation_hook(__FILE__, array('LJPL_FontAwesome', 'deactivate'));

add_action('plugins_loaded', array('LJPL_FontAwesome', 'get_instance'));

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-admin.php` with the name of the plugin's admin file
 * - replace Plugin_Name_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 
if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {

	require_once (plugin_dir_path(__FILE__) . 'admin/class-font-awesome-admin.php');
	add_action('plugins_loaded', array('Plugin_Name_Admin', 'get_instance'));
}
*/