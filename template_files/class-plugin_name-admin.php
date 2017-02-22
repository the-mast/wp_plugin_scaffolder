<?php

namespace {plugin_name}_plugin;
class {plugin_name}_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function add_plugin_admin_menu() {
        add_options_page( '{plugin_name} Base Options Functions Setup', '{plugin_name}', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page') );
    }

    public function add_action_links( $links ) {
        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );
    }

    public function display_plugin_setup_page() {
        return include_once( 'partials/{plugin_name}-admin-display.php' );
    }

    public function validate($input) {
        $valid = array();
        $valid['{plugin_name}_action'] = (isset($input['{plugin_name}_action']) && !empty($input['{plugin_name}_action'])) ? 1 : 0;
        $valid['{plugin_name}_filter'] = (isset($input['{plugin_name}_filter']) && !empty($input['{plugin_name}_filter'])) ? 1: 0;

        return $valid;
    }

    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

	public function load_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_path( __FILE__ ) . 'css/{plugin_name}-admin.css', array(), $this->version, 'all' );
	}

	public function load_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_path( __FILE__ ) . 'js/{plugin_name}-admin.js', array( 'jquery' ), $this->version, false );
	}
}
