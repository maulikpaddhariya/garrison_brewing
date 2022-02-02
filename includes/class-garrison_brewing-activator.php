<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Garrison_brewing
 * @subpackage Garrison_brewing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Garrison_brewing
 * @subpackage Garrison_brewing/includes
 * @author     Maulik Paddharia <maulikpaddhariya@gmail.com>
 */
class Garrison_brewing_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        global $wpdb;
  
        if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'beer-info'", 'ARRAY_A' ) )
        {
             
            $current_user = wp_get_current_user();
            
            $page = array(
              'post_title'  => __( 'Beer Info','garrison_brewing'),
              'post_status' => 'publish',
              'post_author' => $current_user->ID,
              'post_type'   => 'page',
              'post_content' => '[beer-info]'
            );
            wp_insert_post( $page );
        }
	}

}
