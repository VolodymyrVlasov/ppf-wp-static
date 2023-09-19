<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">

    <title>single.php | PaperFox</title>
    <?php wp_head(); ?>
</head>

<body>
    <?php get_header(); ?>
    <main>
        <section class="section" id="head-section">
            <div class="container">
                <span class="template">SINGLE.PHP</span>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <?php
                $args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => 8,
                    'orderby' => 'title',
                    'order' => 'ASC',
                );
                $posts = get_posts($args);

                // Виведення списку постів
                foreach ($posts as $post) {
                    setup_postdata($post);
                    echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                    echo '<div>' . get_the_excerpt() . '</div>';
                }
                ?>
            </div>
        </section>


        <?php get_template_part('map', 'widget'); ?>
    </main>
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>

</html>