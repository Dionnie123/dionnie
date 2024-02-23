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
        return array(
            'post_type' => 'post',
            'posts_per_page' => 12,
            'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
            'ignore_sticky_posts' => 1,
            'orderby' => $_GET['orderby'] ?? 'date',
            'order' =>  $_GET['order'] ?? 'DESC',
            's' => $_GET['title_search'] ?? '',
            'category_name' => get_query_var('category_name') ?? null,
        );
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

    public function registerActions()
    {
        add_action('init', array($this, $this->delete));
    }

    public function _themename_delete_post()
    {
        if (allTrue([
            isset($_GET['nonce']),
            isset($_GET['action']),
            isset($_GET['post']),
            wp_verify_nonce($_GET['nonce'], $this->delete . '_' . $_GET['post']),
            $_GET['action'] === $this->delete,
            !empty(get_post((int) $_GET['post']))
        ])) {
            $post_id = $_GET['post'];
            wp_trash_post($post_id);
            wp_safe_redirect(home_url());
            die;
        }
    }
}
