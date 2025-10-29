<?php
get_header();
?>

<main id="primary" class="site-main">
    <div class="container col big_gap">
        <header class="page-header">
            <h1 class="text_32__bold"><?php the_archive_title(); ?></h1>
            <p class="text_16"><?php the_archive_description(); ?></p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="col big_gap">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/ppf-content', 'entry');
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
