<?php
$columns  = explode(',', get_theme_mod('_themename_footer_layout'));
$footer_bg =  get_theme_mod('_themename_footer_bg', 'dark');
$widgets_active = false;

foreach ($columns as $i => $column) {
    if (is_active_sidebar('footer-sidebar-' . ($i + 1))) {
        $widgets_active = true;
    }
}

?>
<?php if ($widgets_active) { ?>
<div class="p-5">
    <div class="container">
        <div class="row gx-5 gy-5">
            <?php
                foreach ($columns as $i => $column) {
                    if (is_active_sidebar('footer-sidebar-' . ($i + 1))) {
                ?>
            <div class="col col-<?php echo $column; ?>">

                <?php dynamic_sidebar('footer-sidebar-' . ($i + 1)); ?>
            </div>
            <?php
                    }
                }

                ?>

        </div>
    </div>
</div>


<?php } ?>