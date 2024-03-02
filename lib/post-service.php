<?php

namespace _ThemeName;

use WP_Query;

class PostService
{

    protected  $delete = '_themename_delete_post';

    public function __construct()
    {
    }

    public function args()
    {

        $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';
        return array(
            'post_type'          => 'post',
            'posts_per_page'     => 12,
            'ignore_sticky_posts' => 0,
            'post_status' => 'any',
            'orderby'            => array(
                'sticky' => 'asc',
                'title'      => ($orderby === 'title') ? 'asc' : 'desc',
                'post_date'   => ($orderby === 'date') ? 'asc' : 'desc'
            ),
            'paged'              => (get_query_var('paged')) ? get_query_var('paged') : 1,
            'category_name'      => get_query_var('category_name') ?? null,
            'order'              => $_GET['order'] ?? 'DESC',
            's'                  => $_GET['s'] ?? null,

        );
    }

    public function registerActions()
    {
        add_action('init', array($this, $this->delete));
    }


    public function deleteUrl()
    {
        $url = add_query_arg([
            'action' => $this->delete,
            'post' => get_the_ID(),
            'nonce' => wp_create_nonce($this->delete . '_' . get_the_ID())
        ], home_url());
        return  esc_url($url);
    }

    public function getAll()
    {
        $query = new WP_Query($this->args());
        return $query;
    }


    public function _themename_delete_post()
    {

        if (isset($_GET['post']) && !empty(get_post((int) $_GET['post']))) {
            if ($_GET['action'] &&  $_GET['action'] === $this->delete) {
                if (isset($_GET['nonce']) && wp_verify_nonce($_GET['nonce'], $this->delete . '_' . $_GET['post'])) {
                    $post_id = $_GET['post'];
                    wp_trash_post($post_id);
                    wp_safe_redirect(home_url());
                    die;
                }
            }
        }
    }
}

(new \_ThemeName\PostService)->registerActions();
