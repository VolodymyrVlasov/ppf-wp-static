<?php
get_header();
?>

<main id="primary" class="site-main">
    <div class="container col big_gap">
        <?php
        while (have_posts()) :
            the_post();

            if ('page' === get_post_type()) {
                get_template_part('template-parts/ppf-content', 'page');
            } else {
                get_template_part('template-parts/ppf-content', 'entry');
            }

            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
