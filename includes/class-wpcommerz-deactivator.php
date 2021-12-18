<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://wpcommerz.com/
 * @since      1.0.0
 *
 * @package    Wpcommerz
 * @subpackage Wpcommerz/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wpcommerz
 * @subpackage Wpcommerz/includes
 * @author     WPCommerz <https://wpcommerz.com/contact/>
 */
class Wpcommerz_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

        global $wpdb;
        $table_name = $wpdb->prefix . 'task';

        $wpdb->query( "DROP TABLE IF EXISTS $table_name" );

        delete_option("task_db_version");

	}

}
