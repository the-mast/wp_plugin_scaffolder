<?php
namespace {plugin_name}_plugin;
use PHPUnit\Framework\TestCase;
require_once plugin_dir_path( dirname( __FILE__ ) ) . "i18n.php";

class test_i18n extends TestCase {
    function test_Shouldcallload_plugin_textdomain() {
        $i18n = new i18n("{plugin_name}");
        $i18n->load_plugin_textdomain();
        $this->assertTrue(expect("load_plugin_textdomain")->to_have_been_called_with("{plugin_name}", false, plugin_dir_path() . "languages/")->to_be_truthy() );
    }
}
