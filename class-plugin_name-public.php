<?php

namespace {plugin_name}_plugin;

class {plugin_name}_Public {

    private $plugin_name;

    private $version;
    private ${plugin_name}_options;

    public function __construct( $plugin_name, $version, $options ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->{plugin_name}_options = $options;

    }

    public function {plugin_name}_action() {
        if(!empty($this->{plugin_name}_options["{plugin_name}_action"])){
            return include_once("partials/{plugin_name}-action.php") ;
        }

        return 0;
    }

    public function {plugin_name}_filter() {
        if(!empty($this->{plugin_name}_options["{plugin_name}_filter"])){
            return include_once("partials/{plugin_name}-filter.php");
        }

        return 0;
    }

	public function load_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_path( __FILE__ ) . "css/{plugin_name}-public.css", array(), $this->version, "all" );
	}

	public function load_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_path( __FILE__ ) . "js/{plugin_name}-public.js", array( "jquery" ), $this->version, false );
	}
}
