<?php

namespace {plugin_name}_plugin;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       {link}
 * @since      1.0.0
 *
 * @package    {package_name}
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    {package_name}
 * @author     {author}
 */
class i18n {


    private $plugin_name;
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
    function __construct($plugin_name) {
        $this->plugin_name =  $plugin_name;
    }

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->plugin_name,
			false,
			plugin_dir_path(__FILE__) . 'languages/'
		);

	}
}
