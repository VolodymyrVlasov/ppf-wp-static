<?php
/**
 * Template wrapper helpers and global head/body injections.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

/**
 * Renders a page within the common PaperFox layout.
 *
 * @param callable|string $template Callable that outputs the content or template slug for get_template_part.
 * @param array           $args     Arguments passed to the callable or template.
 */
function paperfox_render_page($template, array $args = []): void
{
    get_header();

    if (is_callable($template)) {
        call_user_func($template, $args);
    } elseif (is_string($template) && $template !== '') {
        get_template_part($template, null, $args);
    }

    get_footer();
}

/**
 * Google Tag Manager (head).
 */
function paperfox_output_google_tag_manager_head(): void
{
    if (is_admin()) {
        return;
    }

    $gtm_id = trim(apply_filters('paperfox_gtm_container_id', 'GTM-N3K54QH'));

    if ($gtm_id === '') {
        return;
    }
    ?>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l !== 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '<?php echo esc_js($gtm_id); ?>');
    </script>
    <!-- End Google Tag Manager -->
    <?php
}
add_action('wp_head', 'paperfox_output_google_tag_manager_head', 5);

/**
 * Google Tag Manager (body noscript).
 */
function paperfox_output_google_tag_manager_body(): void
{
    if (is_admin()) {
        return;
    }

    $gtm_id = trim(apply_filters('paperfox_gtm_container_id', 'GTM-N3K54QH'));

    if ($gtm_id === '') {
        return;
    }
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action('wp_body_open', 'paperfox_output_google_tag_manager_body', 5);

/**
 * Outputs Open Graph / Facebook meta tags for single products.
 */
function paperfox_output_product_open_graph_meta(): void
{
    if (! is_product()) {
        return;
    }

    $product_id = get_the_ID();
    $product    = wc_get_product($product_id);

    if (! $product) {
        return;
    }

    $title = $product->get_name();

    $description = $product->get_short_description();
    if (! $description) {
        $description = $product->get_description();
    }
    if (! $description) {
        $description = get_bloginfo('description');
    }
    $description = wp_trim_words(wp_strip_all_tags($description), 40, '…');

    $image_id  = $product->get_image_id();
    $image_url = $image_id ? wp_get_attachment_url($image_id) : wc_placeholder_img_src('full');

    $permalink   = get_permalink($product_id);
    $price       = $product->get_price();
    $currency    = get_woocommerce_currency();
    $availability = $product->is_in_stock() ? 'in stock' : 'out of stock';

    ?>
    <meta property="og:type" content="product" />
    <meta property="og:title" content="<?php echo esc_attr($title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($description); ?>" />
    <meta property="og:url" content="<?php echo esc_url($permalink); ?>" />
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
    <?php if ($image_url) : ?>
        <meta property="og:image" content="<?php echo esc_url($image_url); ?>" />
    <?php endif; ?>
    <?php if ($price !== '') : ?>
        <meta property="product:price:amount" content="<?php echo esc_attr($price); ?>" />
        <meta property="product:price:currency" content="<?php echo esc_attr($currency); ?>" />
    <?php endif; ?>
    <meta property="product:availability" content="<?php echo esc_attr($availability); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr($title); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($description); ?>" />
    <?php if ($image_url) : ?>
        <meta name="twitter:image" content="<?php echo esc_url($image_url); ?>" />
    <?php endif; ?>
    <?php
}
add_action('wp_head', 'paperfox_output_product_open_graph_meta', 20);
