<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Garrison_brewing
 * @subpackage Garrison_brewing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Garrison_brewing
 * @subpackage Garrison_brewing/public
 * @author     Maulik Paddharia <maulikpaddhariya@gmail.com>
 */
include 'views/garrison_brewing-public-display.php';

class Garrison_brewing_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode('beer-info',array($this,'beer_info_rating'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Garrison_brewing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Garrison_brewing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/garrison_brewing-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'awasome-min', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Garrison_brewing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Garrison_brewing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/garrison_brewing-public.js', array( 'jquery' ), $this->version, false );

	}

	public function get_api_body($beer_id = '')
	{
		$request = wp_remote_get( esc_url_raw(API_ENDPOINT.'/beer/info/'.$beer_id.'?client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET) );

		if( is_wp_error( $request ) ) {
			return false;
		}

		$responseBody = wp_remote_retrieve_body( $request );

		$data = json_decode( $responseBody );

		$response_body = $data->response->beer;

		return $response_body;
	}

	public function beer_info_rating() {
		$beer_id = '110569';
		$html_response = '';

		$response_body = $this->get_api_body($beer_id);

		if($response_body){
			$class_api = new Api_views();
       		$html_response = $class_api->get_api_html($response_body);
       	}
		return $html_response;
	}
}