<?php
namespace um_ext\um_forumwp\core;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Class ForumWP_Setup
 *
 * @package um_ext\um_forumwp\core
 */
class ForumWP_Setup {


	/**
	 * @var array
	 */
	var $settings_defaults;


	/**
	 * ForumWP_Setup constructor.
	 */
	function __construct() {
		//settings defaults
		$this->settings_defaults = array(
			'profile_tab_forumwp'           => 1,
			'profile_tab_forumwp_privacy'   => 0,
		);
	}


	/**
	 *
	 */
	function set_default_settings() {
		$options = get_option( 'um_options', array() );

		foreach ( $this->settings_defaults as $key => $value ) {
			//set new options to default
			if ( ! isset( $options[ $key ] ) ) {
				$options[ $key ] = $value;
			}

		}

		update_option( 'um_options', $options );
	}


	/**
	 *
	 */
	function run_setup() {
		$this->set_default_settings();
	}
}