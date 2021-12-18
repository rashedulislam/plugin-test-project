<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wpcommerz.com/
 * @since      1.0.0
 *
 * @package    Wpcommerz
 * @subpackage Wpcommerz/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wpcommerz
 * @subpackage Wpcommerz/includes
 * @author     WPCommerz <https://wpcommerz.com/contact/>
 */
class Wpcommerz_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {

        $this->create_task_db();
        $this->task_install_data();

	}

    private function create_task_db () {

        global $wpdb;
        global $task_db_version;
    
        $table_name = $wpdb->prefix . 'task';
        
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
		    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    
        add_option( 'task_db_version', $task_db_version );

    }

    public static function task_install_data() {
        global $wpdb;
        
        $employees = ['Habib Rahman', 'Manzor Ahmed'];
        
        $table_name = $wpdb->prefix . 'task';
        
        foreach ( $employees as $employee ) {
            $wpdb->insert( 
                $table_name, 
                array( 
                    'time' => current_time( 'mysql' ), 
                    'name' => $employee,
                ) 
            );
        }
        
    }

}
