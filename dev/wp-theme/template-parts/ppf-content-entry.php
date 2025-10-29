<?php
defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ppf-entry'); ?>>
    <header class="entry-header">
        <?php if (is_singular()) : ?>
            <h1 class="text_32__bold"><?php the_title(); ?></h1>
        <?php else : ?>
            <h2 class="text_24__bold"><a class="text_link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php endif; ?>

        <div class="entry-meta text_14">
            <time datetime="<?php echo esc_attr(get_the_date(DATE_ATOM)); ?>"><?php echo esc_html(get_the_date()); ?></time>
            <?php if (has_category()) : ?>
                <span class="entry-categories"><?php the_category(', '); ?></span>
            <?php endif; ?>
        </div>
    </header>

    <div class="entry-content col small_gap">
        <?php
        if (is_singular()) {
            the_content();
        } else {
            the_excerpt();
        }

        wp_link_pages(
            array(
                'before' => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'paperfox') . '">',
                'after'  => '</nav>',
            )
        );
        ?>
    </div>

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <?php the_tags('<span class="entry-tags">', ', ', '</span>'); ?>
        </footer>
    <?php endif; ?>
</article>
