<?php
/**
 * The template part for displaying an Author biography
 *
 * @package aquentro
 */

if (function_exists('jetpack_author_bio')) :
    jetpack_author_bio();
else:
    ?>
    <div class="entry-author">
        <h2 class="name"><?php echo  esc_html__('Author: ', 'aquentro').get_the_author_meta('display_name');?></h2>
        <div class="author-avatar">
            <?php echo get_avatar(get_the_author_meta('ID'), 80) ?>
        </div>
        <div class="author">
            <p class="description"><?php the_author_meta('description');?></p>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html__('All posts by author','aquentro');?></a>
        </div>
    </div>
<?php endif;