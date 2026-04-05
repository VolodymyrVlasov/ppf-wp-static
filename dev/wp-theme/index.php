<?php
get_header();
?>

<main id="primary" class="site-main">
    <div class="container col big_gap">
        <?php if (have_posts()) : ?>
            <?php if (!is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="text_32__bold"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <div class="col big_gap">
                <?php
                while (have_posts()) :
                    the_post();

                    if ('page' === get_post_type()) {
                        get_template_part('template-parts/ppf-content', 'page');
                    } else {
                        get_template_part('template-parts/ppf-content', 'entry');
                    }
                endwhile;
                ?>
            </div>

            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('template-parts/ppf-content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
