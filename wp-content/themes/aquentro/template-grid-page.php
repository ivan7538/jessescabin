<?php
/**
 * The template for displaying the page.
 *
 * This page template will display any functions hooked into the `full width page` action.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * Template name: Grid page with sidebar
 *
 * @package Aquentro
 */

get_header(); ?>
<?php if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		aquentro_post_thumbnail(); ?>
		<div class="wrapper main-wrapper clear"><?php
            $classes = apply_filters('aquentro_content_area_classes', array());
            ?>
            <div id="primary" class="content-area <?php echo esc_attr(implode(' ', $classes));?>">
				<main id="main" class="site-main" role="main">
					<?php get_template_part( 'template-parts/content', 'page' );
					aquentro_child_pages_list();
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; ?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div><!-- .wrapper -->
		<?php
	endwhile; // End of the loop.
else:?>
	<div class="wrapper main-wrapper clear">
		<div id="primary" class="content-area ">
			<main id="main" class="site-main" role="main">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper -->
<?php endif;
get_footer();

