<?php

/**
 * Fired when the plugin is uninstalled.
 *
 *
 * @link       {link}
 * @since      1.0.0
 *
 * @package    {package_name}
 */

namespace {plugin_name}_plugin;
function uninstall_{plugin_name}() {
    if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	    return false;
    //Do some custom stuff here
    
    return true;
}

uninstall_{plugin_name}();
