<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна</title>
    <?php wp_head(); ?>
</head>
<body>
<?php get_header();?>
<section class="section">
    <div class="container col big_gap">
        <h1>Всі товари</h1>  
        <?php
            // Define args for product query
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
            );

            // Get products
            $products = new WP_Query($args);

            // Loop through products
            if ($products->have_posts()) :
                while ($products->have_posts()) :
                    $products->the_post();
                    
                    // Output product information
                    the_title(); // product title
                    the_content(); // product description
                    the_excerpt(); // product short description
                    the_post_thumbnail(); // product image
                    
                endwhile;
            endif;

            // Reset post data
            wp_reset_postdata();
            ?>

    </div>
</section>    
<?php  get_footer();?>
</body>
</html>


