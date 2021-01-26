<?php
/**
 * The template for displaying the page.
 *
 * This page template will display any functions hooked into the `full width page` action.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * Template name: Boxed grid page
 *
 * @package Aquentro
 */

get_header(); ?>
<?php if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		aquentro_post_thumbnail(); ?>
		<div class="wrapper main-wrapper clear">
			<div id="primary" class="content-area boxed">
				<main id="main" class="site-main" role="main">
					<?php get_template_part( 'template-parts/content', 'page-full-width' ); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrapper -->
		<?php
	endwhile; // End of the loop.
else:?>
	<div class="wrapper main-wrapper clear">
		<div id="primary" class="content-area boxed">
			<main id="main" class="site-main" role="main">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .wrapper -->
<?php endif;
get_footer();