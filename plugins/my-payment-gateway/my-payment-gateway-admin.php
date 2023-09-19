<?php
// my-payment-gateway-admin.php

// Добавление полей настроек в административную часть
function my_payment_gateway_admin_fields() {
    $settings = array(
        'section_title' => array(
            'name'     => 'Название и описание метода оплаты',
            'type'     => 'title',
            'desc'     => 'Настройки для "Мой Метод Оплаты"',
        ),
        'title' => array(
            'name' => 'Название метода оплаты',
            'type' => 'text',
            'desc' => 'Название, которое будет отображаться на сайте при выборе метода оплаты',
            'id'   => 'my_payment_gateway_title',
        ),
        'description' => array(
            'name' => 'Короткое описание метода оплаты',
            'type' => 'textarea',
            'desc' => 'Короткое описание метода оплаты',
            'id'   => 'my_payment_gateway_description',
        ),
        'requisites' => array(
            'name' => 'Реквизиты',
            'type' => 'textarea',
            'desc' => 'Текст с реквизитами для метода оплаты',
            'id'   => 'my_payment_gateway_requisites',
        ),
        'section_end' => array(
            'type' => 'sectionend',
        ),
    );

    return apply_filters( 'woocommerce_my_payment_gateway_settings', $settings );
}

// Добавление настроек в административную панель WooCommerce
function my_payment_gateway_admin_init() {
    add_settings_section(
        'my_payment_gateway',
        'Настройки "Мой Метод Оплаты"',
        'my_payment_gateway_admin_section_description',
        'woocommerce'
    );

    $settings = my_payment_gateway_admin_fields();

    foreach ( $settings as $field ) {
        add_settings_field(
            $field['id'],
            $field['name'],
            'my_payment_gateway_admin_field_callback',
            'woocommerce',
            'my_payment_gateway',
            $field
        );

        register_setting( 'woocommerce', $field['id'] );
    }
}

// Описание секции в административной панели
function my_payment_gateway_admin_section_description() {
    echo '<p>Настройки для "Мой Метод Оплаты".</p>';
}

// Отображение полей настроек
function my_payment_gateway_admin_field_callback( $args ) {
    $value = get_option( $args['id'] );

    switch ( $args['type'] ) {
        case 'textarea':
            echo '<textarea id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['id'] ) . '" rows="5" cols="40">' . esc_textarea( $value ) . '</textarea>';
            break;
        default:
            echo '<input type="' . esc_attr( $args['type'] ) . '" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" />';
    }

    if ( isset( $args['desc'] ) && ! empty( $args['desc'] ) ) {
        echo '<p class="description">' . wp_kses_post( $args['desc'] ) . '</p>';
    }
}

// Добавление ссылки на настройки метода оплаты
function my_payment_gateway_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=wc-settings&tab=checkout&section=my_payment_gateway">Настройки</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'my_payment_gateway_add_settings_link' );

// Инициализация административной части
add_action( 'admin_init', 'my_payment_gateway_admin_init' );

// Отображение текста с реквизитами на странице оформления заказа
function my_payment_gateway_display_requisites() {
    $requisites = get_option( 'my_payment_gateway_requisites' );
    if ( ! empty( $requisites ) ) {
        echo '<p class="my-payment-gateway-requisites">' . wp_kses_post( $requisites ) . '</p>';
    }
}
add_action( 'woocommerce_review_order_before_payment', 'my_payment_gateway_display_requisites' );
