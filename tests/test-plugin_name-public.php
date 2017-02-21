<?php
namespace {plugin_name}_plugin;
use PHPUnit\Framework\TestCase;
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-{plugin_name}-public.php';
class test_{plugin_name}_public extends TestCase {

	function test_{plugin_name}_action_shouldInclude{plugin_name}Action() {
        $options = array();
        $options["{plugin_name}_action"] = 1;
        ${plugin_name} = new {plugin_name}_public("{plugin_name}", "1.0.0", $options);
        $this->assertEquals(1, ${plugin_name}->{plugin_name}_action());
	}

	function test_{plugin_name}_action_shouldNotInclude{plugin_name}Action() {
        $options = array();
        ${plugin_name} = new {plugin_name}_public("{plugin_name}", "1.0.0", $options);
        $this->assertEquals(0,${plugin_name}->{plugin_name}_action());
	}

	function test_brett_filter_shouldInclude{plugin_name}Action() {
        $options = array();
        $options["brett_filter"] = 1;
        ${plugin_name} = new {plugin_name}_public("{plugin_name}", "1.0.0", $options);
        $this->assertEquals(1, ${plugin_name}->brett_filter());
	}

	function test_load_stylesShouldCall_wp_enqueue_style() {
        $options = array();
        ${plugin_name} = new {plugin_name}_public("{plugin_name}", "1.0.0", $options);
        ${plugin_name}->load_styles();
        $this->assertTrue(expect("wp_enqueue_style")->to_have_been_called_with("{plugin_name}", plugin_dir_path() . "css/{plugin_name}-public.css", array(), "1.0.0", "all")->to_be_truthy() );
	}

	function test_load_scriptsShouldCall_wp_enqueue_style() {
        $options = array();
        ${plugin_name} = new {plugin_name}_public("{plugin_name}", "1.0.0", $options);
        ${plugin_name}->load_scripts();
        $this->assertTrue(expect("wp_enqueue_script")->to_have_been_called_with("{plugin_name}", plugin_dir_path() . "js/{plugin_name}-public.js", array("jquery"), "1.0.0", false)->to_be_truthy() );
	}

}
