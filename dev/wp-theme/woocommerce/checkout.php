<?php
/**
 * Template Name: Checkout Page
 */

?>

<?php defined('ABSPATH') || exit; ?>



<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="{{stylesheet_url}}/static/icons/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{stylesheet_url}}/style.css">
    <title>Оформлення замовлення | PaperFox</title>
    <?php wp_head(); ?>
</head>

<?php
$checkout = WC()->checkout(); // Определение переменной $checkout
$cart = WC()->cart;
do_action('woocommerce_before_checkout_form', $checkout);
?>
<?php get_header(); ?>
<main>
    <section class="section" id="cart-section">
        <div class="container col big_gap">
            <h1 class="text_32__bold">Оформлення замовлення</h1>
            <form class="row big_gap" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                <?php if ($checkout->get_checkout_fields()): ?>
                    <article class="col big_gap flex_4">
                        <p class="text_24">Ваші контактні дані</p>
                        <div class="col gap width_100 ">
                            <div class="row big_gap width_100">
                                <div class="checkout_input_text">
                                    <label for="shipping_first_name">Імʼя</label>
                                    <input type="text" name="shipping_first_name" id="shipping_first_name" required="true"
                                        placeholder="Тарас">
                                </div>
                                <div class="checkout_input_text">
                                    <label for="shipping_last_name">Прізвище</label>
                                    <input type="text" name="shipping_last_name" id="shipping_last_name" required="true"
                                        placeholder="Шевченко">
                                </div>
                            </div>
                            <div class="row big_gap width_100">
                                <div class="checkout_input_text">
                                    <label for="billing_phone">Мобільний телефон</label>
                                    <input type="tel" name="billing_phone" id="billing_phone" required="true"
                                        placeholder=" +38 077 777 7777">
                                </div>
                                <div class="checkout_input_text">
                                    <label for="billing_email">Електронна пошта</label>
                                    <input type="email" name="billing_email" id="billing_email" required="true"
                                        placeholder="superman@shevchenko.ua">
                                </div>
                            </div>
                        </div>

                        <span class="text_24">Доставка</span>
                        <div class="shipping_address">

                            <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

                            <div class="woocommerce-shipping-fields__field-wrapper">
                          

                                <?php
                                $fields = $checkout->get_checkout_fields('billing');

                                foreach ($fields as $key => $field) {
                                    woocommerce_form_field($key, $field, $checkout->get_value($key));
                                }
                                ?>
                            </div>

                            <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

                        </div>
                        <ul class="col gap width_100">


                            <!-- <li class="col small_gap width_100" id="billing_state_field" data-priority="10">
                                <label for="billing_state">Область/штат <abbr class="required" title="обязательное поле">*</abbr></label>
                                <input type="text" class="input-text" value="" name="billing_state" id="billing_state" placeholder="">
                            </li> -->
                            <!-- <li class="col small_gap width_100">
                                <div class="checkout_input_text width_100">
                                    <label for="shipping_city">Ваше місто</label>
                                    <select name="shipping_state" id="shipping_state" autocomplete="address-level1"
                                        required="true" placeholder="м. Київ, Київська обл." enabled="true">
                                </div>
                            </li> -->

                            <?php
                            // Получаем методы доставки из WooCommerce
                            $shipping_methods = WC()->shipping()->get_shipping_methods();
                            foreach ($shipping_methods as $method_id => $shipping_method) {

                                echo '<li class="checkout_input_radio_wrapper">';
                                echo '<div class="checkout_input_radio">';
                                echo '<input type="radio" name="shipping_method" id="' . esc_attr($method_id) . '" value="' . esc_attr($method_id) . '" required>';
                                echo '<label for="' . esc_attr($method_id) . '">' . esc_html($shipping_method->method_title) . '</label>';
                                echo '</div>';
                                echo '</li>';

                            }
                            ?>

                        </ul>
                    </article>
                    <article class="cart_summary_card flex_2">
                        <span class="text_32">Разом</span>
                        <div class="row_sp_btw">
                            <span class="text_12">
                                <?php echo WC()->cart->get_cart_contents_count(); ?> товарів на суму
                            </span>
                            <span class="text_12">
                                <?php echo WC()->cart->get_cart_subtotal(); ?>
                            </span>
                        </div>
                        <div class="cart_summary_card_price">
                            <span class="text_12">До сплати</span>
                            <span class="text_24">
                                <?php echo WC()->cart->get_cart_total(); ?>
                            </span>
                        </div>
                        <div class="col small_gap">
                            <button type="submit" class="button__primary width_100" name="woocommerce_checkout_place_order" id="place_order" value="Оформити замовлення">ОФОРМИТИ ЗАМОВЛЕННЯ</button>
                        </div>
                        <div class="row">
                            <input type="checkbox" checked class="checkout_checkbox" required
                                id="user-policy-confirmation">
                            <label for="user-policy-confirmation" class="checkout_checkbox_label">Перейшовши до
                                оформнення Ви підтверджуєте що перевірили зміст та склад створенного дизайну або
                                обраного готового виробу. Готовий виріб або створений дизайн матиме вигляд що було
                                створено у редакторі або показано на фото з можливими відхилення згідно до технічних
                                можливостей</label>
                        </div>
                    </article>
                <?php endif; ?>
            </form>
        </div>
    </section>



    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    <?php
    get_footer();
    wp_footer();
    ?>


    <!-- @@include('../../pages/checkout/index.html') -->