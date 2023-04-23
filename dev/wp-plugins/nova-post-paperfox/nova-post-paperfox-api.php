<?php

function nova_posta_get_api_credentials()
{
    $api_key = get_option('nova_posta_paperfox_api_key');
    $api_url = get_option('nova_posta_paperfox_api_url');

    if (empty($api_key)) {
        $settings_url = admin_url('options-general.php?page=nova_posta_paperfox_settings');
        echo '<div class="error"><p>API KEY не задано. Будь ласка, <a href="' . $settings_url . '">задайте API KEY</a> на сторінці налаштувань Нової Пошти.</p></div>';
        return null;
    }

    if (empty($api_url)) {
        $settings_url = admin_url('options-general.php?page=nova_posta_paperfox_settings');
        echo '<div class="error"><p>API URL не задано. Будь ласка, <a href="' . $settings_url . '">задайте API URL</a> на сторінці налаштувань Нової Пошти.</p></div>';
        return null;
    }

    return array('api_key' => $api_key, 'api_url' => $api_url);
}


function nova_post_paperfox_find_city($city)
{
    $api_key = nova_posta_get_api_credentials()["api_key"];
    $api_url = nova_posta_get_api_credentials()["api_url"];
    // Підготуйте тіло POST-запиту
    $post_data = array(
        'apiKey' => $api_key,
        'modelName' => 'Address',
        'calledMethod' => 'searchSettlements',
        'methodProperties' => array(
            'CityName' => $city,
            'Limit' => '15',
            'Page' => '1'
        )
    );

    $args = array(
        'method' => 'POST',
        'headers' => array('Content-Type' => 'application/json'),
        'body' => json_encode($post_data)
    );

    $response = wp_remote_post($api_url, $args);

    if (is_wp_error($response)) {
        // Виведіть повідомлення про помилку
        echo "Error: " . $response->get_error_message();
        return array();
    }

    $response_data = json_decode(wp_remote_retrieve_body($response), true);

    // Поверніть масив об'єктів з відповіді
    return $response_data;
}

function nova_post_paperfox_get_warehouse_list($city_ref, $type_of_warehouse_ref)
{
    $data = array();
    return $data;
}