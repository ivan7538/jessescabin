<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aquentro
 */

if ( ! function_exists( 'aquentro_get_posted_on_by' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function aquentro_get_posted_on_by() {
		global $post;
		$string      = '';
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if(is_single()){
            $posted_on = $time_string;
        }else{
            $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
        }


		$byline = sprintf(
			'<span class="by">' . esc_html_x( 'by %s', 'post author', 'aquentro' ),
			'</span><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$string = '<span class="posted-on">' . $posted_on . '<span class="delimiter"></span></span><span class="byline">' . $byline . '<span class="delimiter"></span></span>'; // WPCS: XSS OK.
		return $string;
	}
endif;
if ( ! function_exists( 'aquentro_posted_on_by_filter' ) ) :
	function aquentro_posted_on_by_filter( $result ) {
		if ( 'mphb_room_type' === get_post_type() ) :
			return '';
		endif;

		return $result;
	}

	add_filter( 'aquentro_get_posted_on_by', 'aquentro_posted_on_by_filter' );
endif;

if ( ! function_exists( 'aquentro_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time, author, categories.
	 */
	function aquentro_posted_on() {
		$posted_on_by = apply_filters( 'aquentro_get_posted_on_by', aquentro_get_posted_on_by() );
        //escaped in aquentro_get_posted_on_by()

		if ( is_sticky() ) : ?>
            <span class="sticky-post"><?php esc_html_e( 'Featured', 'aquentro' ); ?><span class="delimiter"></span></span>
		<?php endif;
		if ( $posted_on_by != '' ) {
			echo $posted_on_by;
		}
		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses(__( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'aquentro' ), array( 'span' => array( 'class' => array() ) )), get_the_title() ) );
			echo '</span>';
		}

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( '<span class="category-delimiter">,</span> ' );
		if ( $categories_list && aquentro_categorized_blog() ) {
			printf( '<span class="cat-links"> %2$s<span class="cat-text">'.  esc_html__( ' in ', 'aquentro' ) . '</span> %1$s </span>', $categories_list, '' ); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'aquentro_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function aquentro_entry_footer() {
		// Hide category and tag text for pages.


		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'aquentro' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'aquentro' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function aquentro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'aquentro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'aquentro_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so aquentro_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aquentro_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in aquentro_categorized_blog.
 */
function aquentro_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'aquentro_categories' );
}

add_action( 'edit_category', 'aquentro_category_transient_flusher' );
add_action( 'save_post', 'aquentro_category_transient_flusher' );


if ( ! function_exists( 'aquentro_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function aquentro_post_thumbnail() {

	    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			global $post;
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'aquentro-thumb-large' );
			?>
			<div class="post-thumbnail"
			     style="background-image: url(<?php echo esc_url( $thumb['0'] ); ?>);">
				<?php the_post_thumbnail( 'aquentro-thumb-large' );
                if(is_page_template('template-front-page.php')):
				?>

                <div class="wrapper">
                    <?php
                    get_sidebar( 'frontpage' );
                    ?>
                </div>
                <?php
                endif;
                ?>

			</div><!-- .post-thumbnail -->
		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</a>

		<?php endif; // End is_singular()
	}
endif;

if ( ! function_exists( 'aquentro_the_post_navigation' ) ) :
	/**
	 * Displays the post navigation.
	 */
	function aquentro_the_post_navigation() {

		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'aquentro' ) . '</span> ' .
			               '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'aquentro' ) . '</span> ' .
			               '<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'aquentro' ) . '</span> ' .
			               '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'aquentro' ) . '</span> ' .
			               '<span class="post-title">%title</span>'
		) );
	}
endif;

if ( ! function_exists( 'aquentro_the_posts_pagination' ) ) :
	/**
	 * Displays the post pagination.
	 */
	function aquentro_the_posts_pagination() {
		the_posts_pagination( array(
			'prev_text'          => '',
			'next_text'          => '',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'aquentro' ) . ' </span>',
			'mid_size'           => 2,
		) );
	}
endif;

if ( ! function_exists( 'aquentro_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own aquentro_excerpt() function to override in a child theme.
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function aquentro_excerpt( $class = 'entry-summary' ) {

		if ( has_excerpt() || is_search() ) :
			$excerpt = get_the_excerpt();
			if ( ! empty( $excerpt ) ) { ?>
				<div class="<?php echo esc_attr($class); ?>">
					<?php echo wp_kses_post($excerpt) ?>
				</div><!-- .<?php echo esc_attr($class); ?> -->
			<?php }
		endif;
	}
endif;

if ( ! function_exists( 'aquentro_the_tags' ) ) :
	/**
	 * Displays post tags.
	 */
	function aquentro_the_tags() {
		if ( 'post' === get_post_type() ) {
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'Used between list items, there is a space.', 'aquentro' ) );
			if ( $tags_list ) {
				printf( '<p class="tagcloud"><span class="tags-links"><span class="tags-title">%1$s </span><span class="screen-reader-text">%2$s </span>%3$s</span></p>',
					esc_html__( 'Tagged ', 'aquentro' ),
					esc_html_x( 'Tags ', 'Used before tag names.', 'aquentro' ),
					$tags_list
				);
			}
		}
	}
endif;


if ( ! function_exists( 'aquentro_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own aquentro_excerpt_more() function to override in a child theme.
	 *
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function aquentro_excerpt_more() {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( wp_kses(__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aquentro' ) ,array( 'span' => array( 'class' => array() ) )), get_the_title( get_the_ID() ) )
		);

		return ' &hellip; ' . $link;
	}

	add_filter( 'excerpt_more', 'aquentro_excerpt_more' );
endif;


if ( ! function_exists( 'aquentro_child_pages_list' ) ) :
	/**
	 * Displays the page child pages.
	 */
	function aquentro_child_pages_list() {
		global $post;
		$args   = apply_filters( 'aquentro_child_pages_list_args', array(
				'post_type'      => 'page',
				'posts_per_page' => - 1,
				'post_parent'    => $post->ID,
				'order'          => 'ASC',
				'orderby'        => 'menu_order'
			)
		);
		$parent = new WP_Query( $args );
		if ( $parent->have_posts() ) :?>
			<div class="entry-child-pages-list">
				<div class="entry-child-pages-list-wrapper">
					<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-wrapper">
								<?php if ( ! ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) ) { ?>
									<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
										<?php the_post_thumbnail( 'aquentro-thumb-medium' ); ?>
									</a>
								<?php }
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								?>
								<?php
								the_content( esc_html__( 'Read More', 'aquentro' ) );
								?>
							</div><!-- .entry-wrapper -->
						</article><!-- #post-## -->
					<?php endwhile; ?>
				</div><!-- .entry-child-pages -->
			</div><!-- .entry-child-pages -->
		<?php endif;
		wp_reset_query();

	}

endif;


if ( ! function_exists( 'aquentro_related_posts' ) ) :
	/**
	 * Displays related posts
	 */
	function aquentro_related_posts( $post ) {
		if ( 'post' === get_post_type() ) {
			$orig_post = $post;
			global $post;
			$categories = wp_get_post_categories( $post->ID );
			if ( $categories ) {
				$args     = array(
					'category__in'        => $categories,
					'post__not_in'   => array( $post->ID ),
					'posts_per_page' => 4
				);
				$my_query = new wp_query( $args );
				if ( $my_query->have_posts() ):
					?>
					<div class="related-posts">
						<h3 class="related-posts-title"><?php esc_html_e( 'Related Posts', 'aquentro' ); ?></h3>
						<!-- .related-posts-title -->
						<ul>
							<?php
							while ( $my_query->have_posts() ) {
								$my_query->the_post();
								?>
								<li>
									<a href="<?php the_permalink() ?>" rel="bookmark"
									   title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</li>
							<?php } ?>
						</ul>
					</div><!-- .related-posts -->
					<?php
				endif;
				?>
				<?php
			}
			$post = $orig_post;
			wp_reset_query();
		}
	}

endif;