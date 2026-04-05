<?php defined('ABSPATH') || exit;
/**
 * Template Name: PPF-StaticPage
 */
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">

    <title><?php the_title(); ?> | PaperFox</title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <section id="primary" class="section">
            <?php
            while (have_posts()):
                the_post();
                get_template_part('template-parts/ppf-content', 'page');
            endwhile;
            ?>
        </section>
        <?php get_template_part('map', 'widget'); ?>
    </main>
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>

</html>