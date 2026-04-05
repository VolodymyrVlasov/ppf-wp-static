<?php
// завжди підключаємо setup.php першим
require_once get_template_directory() . '/inc/setup.php';

// решта файлів
foreach (glob(get_template_directory() . '/inc/*.php') as $file) {
  if (basename($file) === 'setup.php')
    continue;
  require_once $file;
}

// === PPF edit toolbar on product page when returning from cart ===
add_action('wp', function(){
  if ( is_product() && isset($_GET['ppf_edit']) && !empty($_GET['cart_item_key']) ) {
    add_action('woocommerce_before_single_product', function(){
      echo '<div class="ppf-edit-bar" style="margin:10px 0;padding:10px;border:1px dashed #bbb;display:flex;gap:10px;align-items:center;">';
      echo '<strong>' . esc_html__('Редагування макету', 'ppf') . '</strong>';
      echo '<span>' . esc_html__('Оновіть дизайн та натисніть «Зберегти макет» перед додаванням у кошик.', 'ppf') . '</span>';
      echo '</div>';
    });

    // Прокидуємо параметри у front-end
    add_action('wp_enqueue_scripts', function(){
      wp_register_script('ppf-fpd-edit', false, array(), null, true);
      wp_enqueue_script('ppf-fpd-edit');
      $payload = array(
        'cart_item_key' => sanitize_text_field($_GET['cart_item_key']),
        'ajax_url'      => admin_url('admin-ajax.php'),
      );
      wp_add_inline_script('ppf-fpd-edit', 'window.__PPF_FPD_EDIT__ = ' . wp_json_encode($payload) . ';', 'before');
      // Два події: ppf:loadRequested (щоб твій FPD-скрипт підхопив і завантажив потрібний стан),
      // та ppf:saveRequested (на клік "Зберегти")
      wp_add_inline_script('ppf-fpd-edit', "
        (function(){
          document.addEventListener('DOMContentLoaded', function(){
            var btn = document.getElementById('ppf-save-design');
            if(btn){
              btn.addEventListener('click', function(){
                document.dispatchEvent(new CustomEvent('ppf:saveRequested'));
              });
            }
            document.dispatchEvent(new CustomEvent('ppf:loadRequested', { detail: window.__PPF_FPD_EDIT__ }));
          });
        })();
      ");
    });
  }
});




