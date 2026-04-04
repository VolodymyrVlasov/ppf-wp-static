<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization");


require_once plugin_dir_path(__FILE__) . 'nova-post-paperfox-api.php';

function my_custom_plugin_register_query_var($vars)
{
    $vars[] = 'np';
    return $vars;
}

add_filter('query_vars', 'my_custom_plugin_register_query_var');

function my_custom_plugin_parse_request($wp)
{
    if (array_key_exists('np', $wp->query_vars)) {
        my_custom_plugin_handle_get_request($wp->query_vars['np']);
    }
}
add_action('parse_request', 'my_custom_plugin_parse_request');


function my_custom_plugin_handle_get_request($action)
{
    switch ($action) {
        case "city":
            $city_name = isset($_GET['CityName']) ? $_GET['CityName'] : null;

            if ($city_name) {
                $data = nova_post_paperfox_find_city($city_name);
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo "Missing CityRef or TypeOfWarehouseRef parameters.";
            }
            die(); // Завершити обробку запиту тут
            break;
        case "warehouse":
            echo "You chose a warehouse list";
            break;
        default:
            echo "You did not choose a fruit from the list.";
    }
    exit();
}