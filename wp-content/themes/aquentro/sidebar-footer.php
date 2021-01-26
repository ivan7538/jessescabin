<?php
if(!is_active_sidebar('sidebar-3')){
    return;
}
?>
    <div class="footer-widget-area wrapper">
        <?php
            dynamic_sidebar('sidebar-3');
        ?>
    </div>