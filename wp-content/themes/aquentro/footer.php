<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aquentro
 */
?>



<?php
if(has_nav_menu('menu-4')):
    wp_nav_menu( array(
        'theme_location' => 'menu-4',
        'menu_id'        => 'content-left-menu',
        'menu_class'     => 'content-left-menu',
        'container_class' => 'content-left-menu-container',
        'container_id' => 'content-left-menu-container',
        'depth' => 1
    ) );
endif;
?>


</div><!-- #content -->
<footer id="colophon" class="site-footer" role="contentinfo" style="<?php echo esc_html(aquentro_generate_footer_styles())?>">
    <?php
    get_sidebar('footer');
    ?>
    <?php if ( has_nav_menu( 'menu-3' ) ) : ?>
        <div class="footer-socials wrapper">
            <?php wp_nav_menu( array(
                'theme_location' => 'menu-3',
                'menu_id'        => 'footer-socials',
                'menu_class'     => 'footer-bottom-menu theme-social-menu',
                'container_class' => 'footer-bottom-menu-container',
                'link_before'    => '<span class="menu-text">',
                'link_after'     => '</span>',
                'depth' => 1
            ) ); ?>
        </div>
    <?php endif;


    ?>
    <div class="site-info">
	    <?php
	        $image_url = aquentro_get_footer_image_url();
	        if($image_url):
	        ?>
	            <img class="footer-bg" src="<?php echo esc_url($image_url);?>" alt="footer-background">
            <?php
            endif;

        if(boolval(get_theme_mod('aquentro_show_footer_text', true))):
        ?>
            <div class="wrapper">
            <?php
                $dateObj = new DateTime;
                $year    = $dateObj->format( "Y" );
                $site_info = sprintf( esc_html__( '&copy; %1$s All Rights Reserved.', 'aquentro' ), $year );
                printf(
                    get_theme_mod( 'aquentro_footer_text',
                        apply_filters('aquentro_site_info', $site_info)
                    ),
                    $year
                );
            ?>
            </div>
        <?php
        endif;
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>