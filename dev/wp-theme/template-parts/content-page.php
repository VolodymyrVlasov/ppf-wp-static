<?php
/**
 * Template part for displaying page content in page.php
 */

?>

<article id="post-<?php the_ID(); ?>" class="container col gap">
	<header class="entry-header">
		<?php the_title( '<h1 class="text_32">', '</h1>' ); ?>
	</header>

	<div class="col small_gap">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'  => '</nav>',
				'next_or_number' => 'next_and_number',
				'separator' => ' ',
				'nextpagelink'     => esc_html__( 'Next', 'twentytwentyone' ),
				'previouspagelink' => esc_html__( 'Previous', 'twentytwentyone' ),
				'pagelink'         => '%',
				'echo'             => 1,
			)
		);
		?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
