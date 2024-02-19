<?php

namespace _ThemeName;

class PostService
{

    public function __construct()
    {
    }


    public function registerActions()
    {
        add_action('init', array($this, '_themename_delete_post'));
    }

    public function _themename_delete_post()
    {

        if (isset($_GET['action']) && $_GET['action'] === '_themename_delete_post') {

            $nonce = !isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], '_themename_delete_post_' . $_GET['post']);

            if ($nonce) {

                return;
            }

            $post_id = isset($_GET['post']) ? $_GET['post'] : null;
            $post = get_post((int) $post_id);
            if (empty($post)) {
                return;
            }
            wp_trash_post($post_id);
            wp_safe_redirect(home_url());

            die;
        }
    }

    public function _themename_delete_post_btn()
    {
        $url = add_query_arg([
            'action' => '_themename_delete_post',
            'post' => get_the_ID(),
            'nonce' => wp_create_nonce('_themename_delete_post_' . get_the_ID())
        ], home_url());
        if (current_user_can('delete_post', get_the_ID())) {


            return   ?>

            <a href="<?php esc_url($url) ?>" class='btn btn-danger btn-sm'>
                <span class='btn-label'><i class='fa fa-trash'></i></span>&nbsp;<?php esc_html__('Delete Post', '_themename') ?>\
            </a>;
<?php
        }
    }
}
