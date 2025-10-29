<?php
get_header();
?>

<main id="primary" class="site-main">
    <div class="container col big_gap">
        <header class="page-header">
            <h1 class="text_32__bold">
                <?php printf(esc_html__('Результати пошуку для: %s', 'paperfox'), '<span>' . esc_html(get_search_query()) . '</span>'); ?>
            </h1>
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

            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <?php get_template_part('template-parts/ppf-content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
