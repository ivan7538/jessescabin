<?php
add_shortcode('icon_text', 'aquentro_icon_text_callback');
function aquentro_icon_text_callback($atts, $content=null){
    $atts = shortcode_atts(array(
        'class' => '',
    ), $atts, 'icon_text');

    $html = '';
    ob_start();
    ?>
    <div class="icon-text">
        <i class="<?php echo esc_attr($atts['class']);?>"></i>
        <div class="text">
            <?php echo wp_kses_post($content);?>
        </div>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}