<?php
/*
Plugin Name: Нова Пошта
Description: Реалізація API Нової Пошти для сайту поліграфії PaperFox
Version: 1.0
Author: Володимир Власов
License: GPLv2 or later
Text Domain: nova-post-paperfox
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once plugin_dir_path(__FILE__) . 'nova-post-paperfox-user-endpoints.php';

function nova_posta_paperfox_register_settings()
{
    register_setting('nova_posta_paperfox_settings_group', 'nova_posta_paperfox_api_key');
    register_setting('nova_posta_paperfox_settings_group', 'nova_posta_paperfox_api_url');

    add_settings_section('nova_posta_paperfox_settings_section', 'Налаштування Нової Пошти', null, 'nova_posta_paperfox_settings');
}
add_action('admin_init', 'nova_posta_paperfox_register_settings');




function nova_posta_paperfox_add_settings_fields()
{
    add_settings_field('nova_posta_paperfox_api_key', 'API KEY', 'nova_posta_paperfox_api_key_field_callback', 'nova_posta_paperfox_settings', 'nova_posta_paperfox_settings_section');
    add_settings_field('nova_posta_paperfox_api_url', 'API URL', 'nova_posta_paperfox_api_url_field_callback', 'nova_posta_paperfox_settings', 'nova_posta_paperfox_settings_section');
}
add_action('admin_init', 'nova_posta_paperfox_add_settings_fields');



function nova_posta_paperfox_api_key_field_callback()
{
    $api_key = get_option('nova_posta_paperfox_api_key', '');
    echo '<input type="text" id="nova_posta_paperfox_api_key" name="nova_posta_paperfox_api_key" value="' . esc_attr($api_key) . '">';
}

function nova_posta_paperfox_api_url_field_callback()
{
    $api_url = get_option('nova_posta_paperfox_api_url', '');
    echo '<input type="text" id="nova_posta_paperfox_api_url" name="nova_posta_paperfox_api_url" value="' . esc_attr($api_url) . '">';
}


function nova_posta_paperfox_add_settings_page()
{
    add_options_page('Налаштування Нової Пошти', 'Нова Пошта', 'manage_options', 'nova_posta_paperfox_settings', 'nova_posta_paperfox_settings_page_callback');
}
add_action('admin_menu', 'nova_posta_paperfox_add_settings_page');



function nova_posta_paperfox_settings_page_callback()
{
    echo '<h1>Налаштування Нової Пошти</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('nova_posta_paperfox_settings_group');
    do_settings_sections('nova_posta_paperfox_settings');
    submit_button();
    echo '</form>';
}