<?php
/**
 * Template Name: PaperFox Cart Page
 * Template Post Type: page
 *
 * Custom layout for WooCommerce cart page aligned with PaperFox design.
 *
 * @package PaperFox\WooCommerce
 */

defined('ABSPATH') || exit;

get_header();

?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) {
        the_post();

        $raw_content = get_the_content();
        if (! empty($raw_content)) {
            $content_without_shortcode = preg_replace(
                '/\[(?:woocommerce_cart)(?:\s+[^\]]*)?\](?:.*?\[\/woocommerce_cart\])?/is',
                '',
                $raw_content
            );

            $content_without_shortcode = apply_filters('the_content', $content_without_shortcode);

            if (trim(wp_strip_all_tags($content_without_shortcode)) !== '') {
                echo '<div class="page_intro">';
                echo $content_without_shortcode; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</div>';
            }
        }
    }
    ?>

    <?php wc_get_template('cart/cart.php'); ?>
</main>

<?php
get_footer();
