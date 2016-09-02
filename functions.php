<?php

class WSU_Web_Communication_Theme {
	/**
	 * @var string String used for busting cache on scripts.
	 */
	var $script_version = '0.0.1';

	/**
	 * @var WSU_Web_Communication_Theme
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance and initiate hooks when
	 * called the first time.
	 *
	 * @return \WSU_Web_Communication_Theme
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSU_Web_Communication_Theme();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 */
	public function setup_hooks() {
	}

}

add_action( 'after_setup_theme', 'WSU_Web_Communication_Theme' );
/**
 * Start things up.
 *
 * @return \WSU_Web_Communication_Theme
 */
function WSU_Web_Communication_Theme() {
	return WSU_Web_Communication_Theme::get_instance();
}
