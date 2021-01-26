<?php
/**
 * The template for displaying single post without sidebar
 *
 * Template name: Post no sidebar
 * Template Post Type: post, mphb_room_type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                    <?php get_template_part( 'template-parts/content', 'single' );

                    aquentro_the_tags();

                    aquentro_related_posts($post);

                    if ( get_the_author_meta( 'description' ) && 'post' === get_post_type() ) :
                        get_template_part( 'template-parts/biography' );
                    endif;

                    aquentro_the_post_navigation();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
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