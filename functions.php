<?php

class WSU_Web_Communication_Theme {
	/**
	 * @since 0.0.1
	 *
	 * @var string String used for busting cache on scripts.
	 */
	var $script_version = '0.0.2';

	/**
	 * @since 0.0.1
	 *
	 * @var WSU_Web_Communication_Theme
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance and initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
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
	 *
	 * @since 0.0.1
	 */
	public function setup_hooks() {
		add_filter( 'spine_child_theme_version', array( $this, 'theme_version' ) );
		add_shortcode( 'wsuwp_plugin_list', array( $this, 'display_plugin_list' ) );
		add_filter( 'allowed_html_component_url', array( $this, 'allowed_html_component_url' ), 10, 2 );
	}

	/**
	 * Provide a theme version for use in cache busting.
	 *
	 * @since 0.0.1
	 *
	 * @return string
	 */
	public function theme_version() {
		return $this->script_version;
	}

	/**
	 * Provide a shortcode to display a list of available and globally active plugins.
	 *
	 * @since 0.0.1
	 *
	 * @return string HTML content displaying the plugin list.
	 */
	public function display_plugin_list() {
		wp_enqueue_script( 'wsu-web-plugins', get_stylesheet_directory_uri() . '/js/plugin-list.js', array( 'jquery' ), spine_get_child_version(), true );

		$plugins = get_plugins();

		$plugin_list = '<div class="wsuwp-plugin-list-controls"><div class="toggle-plugin-global">Hide globally active plugins</div><div class="toggle-plugin-single">Hide non-globally active plugins</div></div>';
		$plugin_list .= '<div class="wsuwp-plugin-list">';

		foreach ( $plugins as $plugin => $properties ) {
			if ( wsuwp_is_plugin_active_for_global( $plugin ) ) {
				$container_class = 'wsuwp-plugin-global';
			} else {
				$container_class = '';
			}

			$plugin_list .= '<div class="wsuwp-plugin-single ' . $container_class . '">' . "\n";
			$plugin_list .= '<h3>' . esc_html( $properties['Name'] ) . '</h3>' . "\n";
			$plugin_list .= '<div class="wsuwp-plugin-version">Version ' . esc_html( $properties['Version'] ) . '</div>';
			$plugin_list .= '<div class="wsuwp-plugin-url"><a href="' . esc_url( $properties['PluginURI'] ) . '">' . esc_url( $properties['PluginURI'] ) . '</a></div>' . "\n";
			$plugin_list .= '<div class="wsuwp-plugin-description"><p>' . wp_kses_post( $properties['Description'] ) . '</p></div>' . "\n";
			$plugin_list .= '</div>' . "\n";
		}

		$plugin_list .= '</div>';

		return $plugin_list;
	}

	/**
	 * Determine if a URL used in the [html_component] shortcode is allowed.
	 *
	 * @param bool   $allowed
	 * @param string $url
	 *
	 * @return bool
	 */
	public function allowed_html_component_url( $allowed, $url ) {
		if ( 0 === strpos( $url,'https://raw.githubusercontent.com/washingtonstateuniversity/WSU-Web-Framework', 0 ) ) {
			return true;
		}
		return $allowed;
	}
}

add_action( 'after_setup_theme', 'WSU_Web_Communication_Theme' );
/**
 * Start things up.
 *
 * @since 0.0.1
 *
 * @return \WSU_Web_Communication_Theme
 */
function WSU_Web_Communication_Theme() {
	return WSU_Web_Communication_Theme::get_instance();
}
