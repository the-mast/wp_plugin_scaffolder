<?php
namespace {plugin_name}_plugin;
use PHPUnit\Framework\TestCase;
require_once plugin_dir_path( dirname( __FILE__ ) ) . "class-{plugin_name}-admin.php";

class test_{plugin_name}_admin extends TestCase {

    function setUp() {
        clear_all_mocks();
    }

	function test_ShouldCallThe_add_options_page() {
        ${plugin_name} = new {plugin_name}_admin("{plugin_name}", "1.0.0");
        ${plugin_name}->add_plugin_admin_menu();
        $this->assertTrue(expect("add_options_page")->to_have_been_called_with( "{plugin_name} Base Options Functions Setup", "{plugin_name}", "manage_options", "{plugin_name}", array(${plugin_name}, "display_plugin_setup_page") )->to_be_truthy() );
	}

	function test_ShouldMergeActionLinksWithExistingLinks() {
        ${plugin_name} = new {plugin_name}_admin("{plugin_name}", "1.0.0");
        $links = array("my_link");
        $settings_link = array(
            '<a href="' . 
            admin_url( 'options-general.php?page=' . '{plugin_name}') . '">' . 
            __('Settings', '{plugin_name}') . '</a>'
        );
        $this->assertEquals( serialize(array_merge($settings_link, $links)), serialize(${plugin_name}->add_action_links($links) ) );
	}

	/*function test_{plugin_name}_filter_shouldInclude{plugin_name}Action() {
        $options = array();
        $options["{plugin_name}_filter"] = 1;
        ${plugin_name} = new {plugin_name}_admin("{plugin_name}", "1.0.0", $options);
        $this->assertEquals(1, ${plugin_name}->{plugin_name}_filter());
	}

	function test_load_stylesShouldCall_wp_enqueue_style() {
        $options = array();
        ${plugin_name} = new {plugin_name}_admin("{plugin_name}", "1.0.0", $options);
        ${plugin_name}->load_styles();
        $this->assertTrue(expect("wp_enqueue_style")->to_have_been_called_with("{plugin_name}", plugin_dir_path() . "css/{plugin_name}-public.css", array(), "1.0.0", "all")->to_be_truthy() );
	}

	function test_load_scriptsShouldCall_wp_enqueue_style() {
        $options = array();
        ${plugin_name} = new {plugin_name}_admin("{plugin_name}", "1.0.0");
        ${plugin_name}->load_scripts();
        $this->assertTrue(expect("wp_enqueue_script")->to_have_been_called_with("{plugin_name}", plugin_dir_path() . "js/{plugin_name}-public.js", array("jquery"), "1.0.0", false)->to_be_truthy() );
    }*/

}
