<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpcommerz.com/
 * @since      1.0.0
 *
 * @package    Wpcommerz
 * @subpackage Wpcommerz/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpcommerz
 * @subpackage Wpcommerz/admin
 * @author     WPCommerz <https://wpcommerz.com/contact/>
 */
class Wpcommerz_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        add_action( 'admin_menu', [ $this, 'register_task_menu_page'] );
        add_action( 'wp_ajax_add_task', [ $this, 'add_task'] );

	}

    public function register_task_menu_page() {
        add_menu_page( 'Task', 'Task', 'manage_options', 'task', [ $this, 'task_menu_page'], 'dashicons-welcome-widgets-menus', 3 );
    }

     public function task_menu_page(){
        if (file_exists( dirname(__FILE__) . '/partials/wpcommerz-admin-display.php')) {
            require dirname(__FILE__) .'/partials/wpcommerz-admin-display.php';
        }
     }

     public function add_task(){

        check_admin_referer('task_nonce', 'security');

        if (isset($_REQUEST['action'])) {

            $employees = isset( $_POST['employees'] ) ? (array) $_POST['employees'] : array();
            $employees = array_map( 'esc_attr', $employees );

            global $wpdb;

            $prevemployees = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}task", ARRAY_A );
            $employeelist = [];
            foreach ($prevemployees as $prevemployee) {
                array_push( $employeelist, $prevemployee['name'] );
            }
        
            $table_name = $wpdb->prefix . 'task';
            
            foreach ( $employees as $employee ) {
                if ( in_array( $employee, $employeelist )) {
                    continue;
                }
                $wpdb->insert( 
                    $table_name, 
                    array( 
                        'time' => current_time( 'mysql' ), 
                        'name' => $employee,
                    ) 
                );
            }


        }

        wp_send_json_success($employees);
        wp_die();

     }


     private function get_scripts_data()
     {
         return array(
             'task_nonce' => wp_create_nonce('task_nonce'),
             'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
         );
     }
 
     private function get_backend_scripts_data()
     {
         return $this->get_scripts_data();
     }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpcommerz_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpcommerz_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpcommerz-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpcommerz_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpcommerz_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpcommerz-admin.js', array( 'jquery' ), $this->version, false );

        wp_localize_script( $this->plugin_name, 'TaskLocalize', $this->get_backend_scripts_data());

	}

}
