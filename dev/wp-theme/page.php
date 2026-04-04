<?php the_post();

ppf_add_head_tag(
    '<link rel="shortcut icon" href="' . esc_url(get_stylesheet_directory_uri() . '/static/icons/favicon.png') . '" type="image/x-icon">'
);

wp_head();
do_action('woocommerce_before_single_product');
global $product;
$product_id = $product ? $product->get_id() : get_the_ID();
?>


<body>
    <?php get_header(); ?>
    <main>
        <section id="primary" class="section  col big_gap">
            <?php
            while (have_posts()):
                the_post();
                get_template_part('template-parts/content', 'page');
            endwhile;
            ?>
        </section>
        <?php get_template_part('map', 'widget'); ?>
    </main>
    <?php get_footer(); ?>
</body>
<?php wp_footer(); ?>