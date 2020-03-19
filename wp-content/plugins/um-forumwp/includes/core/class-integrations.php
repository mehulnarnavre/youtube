<?php
namespace um_ext\um_forumwp\core;


if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class Integrations
 *
 * @package um_ext\um_forumwp\core
 */
class Integrations {


	/**
	 * Integrations constructor.
	 */
	function __construct() {
		add_filter( 'um_activity_global_actions', array( &$this, 'social_activity_action' ) );
	}


	/**
	 * Add new activity action
	 *
	 * @param $actions
	 *
	 * @return mixed
	 */
	function social_activity_action( $actions ) {
		$actions['new-forumwp-topic'] = __( 'New forum topic', 'um-forumwp' );
		$actions['new-forumwp-reply'] = __( 'New topic reply', 'um-forumwp' );
		return $actions;
	}

}