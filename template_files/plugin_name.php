<?php

/**
 * @link              {link}
 * @since             {version}
 * @package           {package_name}
 *
 * @wordpress-plugin
 * Plugin Name:       {plugin_name}
 * Plugin URI:        {plugin_uri}
 * Description: {description} 
 * Version:    {version}
 * Author:  {author}
 * Author URI:  {author_uri}
 */

namespace {plugin_name}_plugin;

$plugin_name = "{plugin_name}";
$version = "{version}";
$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $plugin_name . '.php' );

function activate_plugin() {
}

function deactivate_plugin() {
}

function start_plugin() {
    global $plugin_name, $version, $plugin_basename;
    if ( !defined( "WPINC" ) )
        return;

    register_activation_hook( __FILE__, "{plugin_name}_plugin\activate_plugin" );
    register_deactivation_hook( __FILE__, "{plugin_name}_plugin\deactivate_plugin" );

    require_once plugin_dir_path( __FILE__ ) . "i18n.php";
    $i18n = new \i18n($plugin_name);
    add_action( "plugins_loaded", array( $i18n, "load_plugin_textdomain" ), 10, 1);

    //admin actions and filters
    require_once plugin_dir_path( __FILE__ ) . "class-{plugin_name}-admin.php";
    $admin = new {plugin_name}_Admin($plugin_name, $version);
    add_action( "admin_menu", array($admin, "add_plugin_admin_menu"), 10, 1 );
    add_action( "admin_init", array($admin, "options_update"), 10, 1 );
    add_action( 'admin_enqueue_scripts', array($admin, 'load_styles'), 10, 1 );
    add_action( 'admin_enqueue_scripts', array($admin, 'load_scripts'), 10, 1 );
    add_filter( "plugin_action_links_" . $plugin_basename, array($admin, "add_action_links"), 10, 1 );

    //public actions and filters
    require_once plugin_dir_path( __FILE__ ) . "class-{plugin_name}-public.php";
    $public = new {plugin_name}_Public($plugin_name, $version, get_option($plugin_name) );
    add_action( "wp_head", array($public, "{plugin_name}_action"), 10, 1 );
    add_filter( "wp_head", array($public, "{plugin_name}_filter"), 10, 1 );
    add_action( 'wp_enqueue_scripts', array($public, 'load_styles'), 10, 1 );
    add_action( 'wp_enqueue_scripts', array($public, 'load_scripts'), 10, 1 );
}

start_plugin();
