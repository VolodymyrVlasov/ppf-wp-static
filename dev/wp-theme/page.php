<?php
get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            get_template_part('template-parts/ppf-content', 'page');
        }
    }

    get_template_part('template-parts/ppf-contact-section');
    get_template_part('map', 'widget');
    ?>
</main>

<?php
get_footer();
