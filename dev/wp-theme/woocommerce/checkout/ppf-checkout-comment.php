<?php
/**
 * Output comment for order in checkout form
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
    <div class="form-row notes woocommerce-input-wrapper col width_100" id="order_comments_field" data-priority="">
        <textarea name="order_comments" class="col width_100 checkout_comment" id="order_comments" placeholder="Нотатки до вашого замовлення, наприклад спеціальні нотатки для доставки." rows="5" cols="5"></textarea>
    </div>