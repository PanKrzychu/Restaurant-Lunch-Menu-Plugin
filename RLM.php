<?php

/**
 * @package  Restaurant Lunch Menu
 */
/*
Plugin Name: Restaurant Lunch Menu
Plugin URI: http://markofani.com.pl
Description: This plugin generates shortcode with customisable restaurant menu.
Version: 1.0.0
Author: Krzysztof Czachor
Author URI: https://markofani.com.pl/
Text Domain: restaurant-lunch-menu
*/

if (!defined('ABSPATH')) {
    die('You can not access this file!');
}

require_once plugin_dir_path(__FILE__) . 'RLMApi.php';

$plugin = plugin_basename(__FILE__);

session_start();

function rlm_activation_function()
{
    // Kod do wykonania podczas aktywacji wtyczki
    rlm_create_db_table();
}

function rlm_deactivation_function()
{
    // Kod do wykonania podczas dezaktywacji wtyczki
    // Pamiętaj, żeby w odpowiedniej funkcji obsłużyć odrejestrowanie zaplanowanych zadań lub eventów
    wp_clear_scheduled_hook('removeLunches');
}

function rlm_uninstall_function()
{
    // Kod do wykonania podczas deinstalacji wtyczki
    // Pamiętaj, żeby w odpowiedniej funkcji obsłużyć deinstalację i czyszczenie danych
}

register_activation_hook(__FILE__, 'rlm_activation_function');
register_deactivation_hook(__FILE__, 'rlm_deactivation_function');
register_uninstall_hook(__FILE__, 'rlm_uninstall_function');

add_action('admin_menu', 'rlm_add_admin_menu');
add_filter("plugin_action_links_$plugin", 'rlm_settings_link');


add_shortcode('rlm', 'getShortcode');
add_action('rest_api_init', 'RLMApi::registerRoutes');
wp_schedule_event(time(), 'hourly', 'removeLunches');
wp_enqueue_style('rlm_settings', plugins_url('Restaurant Lunch Menu/templates/styles/settings.css'));
wp_enqueue_style('rlm_shortcode', plugins_url('Restaurant Lunch Menu/templates/styles/shortcode.css'));



function rlm_add_admin_menu(  ) { 

	add_menu_page( 'Restaurant Lunch Menu settings', 'RLM', 'manage_options', 'rlm', 'rlm_options_page', 'dashicons-editor-ol', 3 );

}

function rlm_settings_link($links)
{
	$settings_link = '<a href="admin.php?page=rlm">Strona wtyczki</a>';
	array_push($links, $settings_link);
	return $links;
}



function rlm_options_page( $msg ) { 

	require_once plugin_dir_path(__FILE__) . 'templates/settings.php';

}

function getShortcode() {

    require_once plugin_dir_path(__FILE__) . 'templates/shortcode.php';

    return $content;

}

function rlm_create_db_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "rlm";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_dish tinytext NOT NULL,
        main_course tinytext NOT NULL,
        drink tinytext NOT NULL,
        dessert tinytext NOT NULL,
        date date DEFAULT '2021-06-01 09:00:00' NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// function removeLunches() {
//     global $wpdb;

//     $before = date_sub(new DateTime(), date_interval_create_from_date_string("7 days"));
//     $before = date_format($before, 'Y-m-d');
            
//     $table_name = $wpdb->prefix . 'menu';

//     if($wpdb->delete($table_name, array( 'date' <= $before ))) return TRUE;

//     return FALSE;
    
// }

