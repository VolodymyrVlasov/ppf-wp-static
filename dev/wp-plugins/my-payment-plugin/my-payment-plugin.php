<?php
/*
Plugin Name: Мой Плагин Оплаты
Description: Добавляет новый метод оплаты для WooCommerce.
Version: 1.0
Author: Ваше Имя
*/

// Проверка наличия класса WC_Payment_Gateway
if (class_exists('WC_Payment_Gateway')) {

    // Проверка наличия класса My_Payment_Method
    if (!class_exists('My_Payment_Method')) {

        // Создание класса для метода оплаты
        class My_Payment_Method extends WC_Payment_Gateway {
            public function __construct() {
                $this->id                 = 'my_payment';
                $this->method_title       = __('Мой Метод Оплаты', 'my-payment-plugin');
                $this->title              = $this->method_title;
                $this->has_fields         = false;
                $this->init_form_fields();
                $this->init_settings();
                $this->enabled            = $this->get_option('enabled');
                $this->title              = $this->get_option('title');
                $this->description        = $this->get_option('description');
                $this->supports           = array('products');
                $this->init();
            }

            public function init_form_fields() {
                $this->form_fields = array(
                    'enabled' => array(
                        'title'   => __('Включить/Выключить', 'my-payment-plugin'),
                        'type'    => 'checkbox',
                        'label'   => __('Включить Мой Метод Оплаты', 'my-payment-plugin'),
                        'default' => 'yes',
                    ),
                    'title' => array(
                        'title'       => __('Заголовок', 'my-payment-plugin'),
                        'type'        => 'text',
                        'description' => __('Заголовок, который видят пользователи во время оформления заказа.', 'my-payment-plugin'),
                        'default'     => __('Мой Метод Оплаты', 'my-payment-plugin'),
                        'desc_tip'    => true,
                    ),
                    'description' => array(
                        'title'       => __('Описание', 'my-payment-plugin'),
                        'type'        => 'textarea',
                        'description' => __('Описание метода оплаты, видимое клиентам.', 'my-payment-plugin'),
                        'default'     => __('Оплатите ваш заказ с помощью Моего Метода Оплаты.', 'my-payment-plugin'),
                    ),
                );
            }

            public function process_payment($order_id) {
                // Обработка платежа и возврат результата
                return array(
                    'result'   => 'success',
                    'redirect' => $this->get_return_url($order_id),
                );
            }
        }

        // Регистрация класса метода оплаты в WooCommerce
        function add_my_payment_gateway_class($methods) {
            $methods[] = 'My_Payment_Method';
            return $methods;
        }

        add_filter('woocommerce_payment_gateways', 'add_my_payment_gateway_class');
    }
}
