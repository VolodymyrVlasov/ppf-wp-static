<?php
/** Очікує $args['product'] = WC_Product */
if (empty($args['product']) || ! $args['product'] instanceof WC_Product) return;

$p     = $args['product'];
$title = $p->get_name();
$link  = get_permalink($p->get_id());
$image = $p->get_image('woocommerce_thumbnail', ['alt'=>esc_attr($title)]);

if (empty($image)) {
  $image = sprintf(
    '<img src="%s/static/global/ppf-image-not-found.webp" alt="%s" />',
    esc_url(get_template_directory_uri()),
    esc_attr($title)
  );
}
?>
<a href="<?php echo esc_url($link); ?>" class="related_product_card">
  <picture class="related_product_img bg_img">
    <?php echo $image; ?>
  </picture>
  <p class="related_product_title"><?php echo esc_html($title); ?></p>
</a>
