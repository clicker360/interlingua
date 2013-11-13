<?php
/**
 * @package Mapped-contact-form
 * @version 1.3
 */
/*
Plugin Name: Mapped contact form
Plugin URI: http://autobahn81.com/
Description: A ajax contact form inside a google maps marker info window. Works for one or multiple locations. A different email address for every location can be configured. If only on location is on the map, the info window with the contact form opens when the map is loaded.
Author: Autobahn 81
Version: 1.0.0
Author URI: http://autobahn81.com/
*/

require('mcfplib/mcfp.php');
class MCF_Shortcode 
{
	static $add_mcfp_scripts;
	
	function init()
	{
		add_shortcode('mcf', array(__CLASS__, 'handle_shortcode'));
		add_filter('the_posts', array(__CLASS__, 'conditionally_add_scripts_and_styles'));
	}
	
	function handle_shortcode($atts)
	{
    self::remove_filters();
		self::$add_mcfp_scripts = true;
		extract(shortcode_atts(array(
		        "id" => '',
		        "width" => '',
		        "height" => '',
		        "map_center" => '',
		        "map_zoom" => '',
		        "listener" => '',
				"locations" => ''
		        ), $atts));

		$mapCenterArray = explode(",", $map_center);
		$locationsArray = explode(";", str_replace(")", "", str_replace("(", "",$locations)));
		$mapConfig = array(
			'id' => $id,
			'width' => $width,
			'height' => $height,
		    'mapCenter' => $mapCenterArray,
		    'mapZoom' => $map_zoom,
			'listener' => $listener,
			'locations' => $locationsArray
		);
		return MCFP::returnMap( $mapConfig );
	}
	
	function remove_filters(){
	  remove_filter('the_content', 'wpautop');
    remove_filter('the_content', 'wptexturize');
	  remove_filter('the_content', 'my_formatter', 99);
	}

	function conditionally_add_scripts_and_styles($posts){
		if (empty($posts)) return $posts;

		$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
		foreach ($posts as $post) {
			if (preg_match('/\[mcf/', $post->post_content)) {
				$shortcode_found = true; // bingo!
				break;
			}
		}

		if ($shortcode_found) {
		  remove_filter( 'the_content', 'mysite_texturize_shortcode_before' );
  		remove_filter( 'the_content', 'mysite_formatter', 99 );
			// enqueue here
			wp_enqueue_style('mcfp-style', plugins_url('/mcfplib/css/style.css', __FILE__));
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js');
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script('googlemaps', 'http://www.google.com/jsapi');

			wp_enqueue_script('validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js', array('jquery'), '1.8.1', true);
			wp_enqueue_script('form', plugins_url('/mcfplib/dependencies/jquery.form.min.js', __FILE__), '2.8.6', true);
			wp_enqueue_script('mcfp', plugins_url('/mcfplib/js/mappedcontactformpro.min.js', __FILE__), '1.0', true);
		}

		return $posts;
	}
}

MCF_Shortcode::init();

add_action('admin_menu', 'mapped_contact_form_plugin_menu');

function mapped_contact_form_plugin_menu() {
	add_options_page('Mapped contact form Options', 'Mapped contact form', 'manage_options', 'mapped-contact-form-identifier', 'mapped_contact_form_plugin_options');
}

function mapped_contact_form_plugin_options() {

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	echo '<div class="wrap">';
	echo '<h1>Mapped contact from pro WordPress</h1>';
	echo '<img src="' . plugins_url('/mcfplib/img/preview-mapped-contact-wp.jpg', __FILE__) . '"/>';
	echo '<p>You can find the documentation <a target="_blank" href="http://autobahn81.com/static/help/mcfpwp/">here</a>.</p>';
	echo '</div>';
}
?>