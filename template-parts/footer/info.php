<?php
$footer_bg = _themename_sanitize_footer_bg(get_theme_mod('_themename_footer_bg', 'dark'));
$site_info = get_theme_mod('_themename_site_info', '');
?>
<?php if ($site_info) { ?>
    <div class="c-site-info c-site-info--<?php echo $footer_bg; ?> bg-primary p-3">
        <div class="container text-center " style="color:white">

            <div class="row">
                <div class="col c-site-info__text">
                    <?php
                    $allowed = array('a' => array(
                        'href' => array(),
                        'title' => array()
                    ));
                    echo wp_kses($site_info, $allowed); ?>
                </div>
            </div>
        </div>


    </div>
    <?php do_action('_themename_after_footer_info') ?>
<?php } ?>