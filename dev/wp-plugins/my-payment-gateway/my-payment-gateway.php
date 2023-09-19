<?php
/*
Plugin Name: My Payment Gateway
Description: Добавляет метод оплаты "Мой Метод Оплаты" в WooCommerce.
Version: 1.0
Author: Ваше Имя
*/

// Подключение класса метода оплаты из директории includes
require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-payment-gateway.php';

// Регистрация вашего метода оплаты
function add_my_payment_gateway( $methods ) {
    $methods[] = 'My_Payment_Gateway';
    return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'add_my_payment_gateway' );
