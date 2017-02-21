<?php
namespace {plugin_name}_plugin;
require_once "mocks.php";

use PHPUnit\Framework\TestCase;
set_plugin_basename("{plugin_name}");
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'uninstall.php';

class test_uninstall extends TestCase {
    function test_ShouldgetTrueFromUninstall() {
        global $defined_value;
        $defined_value = true;
        $this->assertTrue(uninstall_{plugin_name}() );
    }

    function test_ShouldReturnFalseFromUninstall() {
        global $defined_value;
        $defined_value = false;
        $this->assertFalse(uninstall_{plugin_name}() );
    }
}
