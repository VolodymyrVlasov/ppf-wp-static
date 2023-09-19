<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


require_once WP_PLUGIN_DIR . '/woocommerce/includes/abstracts/abstract-wc-settings-api.php';
require_once WP_PLUGIN_DIR . '/woocommerce/includes/abstracts/abstract-wc-payment-gateway.php';

class My_Payment_Gateway extends WC_Payment_Gateway {

    public function __construct() {
        $this->id                 = 'my_payment_gateway'; // Уникальный идентификатор вашего метода оплаты
        $this->icon               = ''; // URL изображения, которое будет отображаться рядом с методом оплаты
        $this->has_fields         = false; // Указывает, имеет ли метод оплаты поля для заполнения на странице оформления заказа

        $this->method_title       = 'Мой Метод Оплаты'; // Название метода оплаты, отображаемое в административной панели
        $this->method_description = 'Описание вашего метода оплаты'; // Описание метода оплаты

        // Регистрация настроек метода оплаты
        $this->init_form_fields();
        $this->init_settings();

        // Назначение обработчиков событий
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
    }

    // Инициализация полей для настроек метода оплаты
    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => 'Включить/Отключить',
                'type'    => 'checkbox',
                'label'   => 'Включить Мой Метод Оплаты',
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => 'Заголовок',
                'type'        => 'text',
                'description' => 'Заголовок, отображаемый при выборе метода оплаты',
                'default'     => 'Мой Метод Оплаты',
            ),
        );
    }

    // Отображение описания метода оплаты на странице оформления заказа
    public function payment_fields() {
        if ( $this->description ) {
            echo wpautop( wp_kses_post( $this->description ) );
        }
    }

    // Обработка платежа при оформлении заказа
    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );

        // Ваша логика обработки платежа здесь

        // После успешной обработки платежа, перенаправьте пользователя на страницу "Спасибо"
        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url( $order ),
        );
    }
}
