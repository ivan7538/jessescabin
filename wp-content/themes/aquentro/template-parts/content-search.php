<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aquentro
 */

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php aquentro_post_thumbnail(); ?>
		<div class="entry-wrapper">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->
			<?php aquentro_excerpt(); ?>
		</div><!-- .entry-wrapper -->
		<footer class="entry-footer">
			<div class="entry-meta">
				<?php aquentro_posted_on(); ?>
			</div><!-- .entry-meta-->
		</footer><!-- .entry-footer -->
		<div class="clear"></div>
	</article><!-- #post-## -->