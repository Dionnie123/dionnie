<?php

namespace _ThemeName;

class Post
{

    protected $detail;

    public function init()
    {
        $this->detail = (new PostDetailMetaBox());
    }

    public function get_layout()
    {
        return sanitize_text_field(get_post_meta(get_the_ID(), '_themename_post_layout', true));
    }

    public function get_author()
    {
        return sanitize_text_field(get_post_meta(get_the_ID(), '_themename_post_author', true));
    }

    public function get_date()
    {
        return sanitize_text_field(get_post_meta(get_the_ID(), '_themename_post_published_date', true));
    }
}



class PostDetailMetaBox
{

    protected  $author = "_themename_post_author";
    protected  $published_date = "_themename_post_published_date";
    protected  $layout = "_themename_post_layout";
    protected  $nonce_action = "_themename_post_detail_metabox_update";
    protected  $nonce_field = "_themename_post_detail_metabox_nonce";



    public function __construct()
    {
        /*
        https://www.reddit.com/r/Wordpress/comments/8hvh0y/difference_in_meta_keys_with_and_without/
        I think if you use an underscore prefix it is supposed to be used by plugins and themes 
        and don't appear in the UI below the post/page i.e. are created programatically.
        */
        $this->author = _themename_private_metakey("_themename_post_author");
        $this->published_date = _themename_private_metakey("_themename_post_published_date");
        $this->layout = _themename_private_metakey("_themename_post_layout");
        add_action('add_meta_boxes_post', array($this, '_themename_post_detail_metabox'));
        add_action('save_post', array($this, '_themename_post_detail_metabox_update'), 10, 2);
    }

    public function _themename_post_detail_metabox()
    {
        add_meta_box(
            '_themename_post_detail_metabox', // Unique ID
            'Post Details',           // Box title
            array($this, '_themename_post_detail_metabox_html'), // Callback function to render the content
            'post', // Post type
            'normal', // Context (normal, advanced, side)
            'high' // Priority (high, core, default, low)
        );
    }

    function _themename_post_detail_metabox_html($post)
    {
        /* echo "<pre>";
        var_dump(get_post_type_object($post->post_type));
        echo "</pre>"; */
        // Retrieve existing meta values for the post
        $author = get_post_meta($post->ID, $this->author, true);
        $published_date = get_post_meta($post->ID, $this->published_date, true);
        $layout = get_post_meta($post->ID, $this->layout, true);

        // Output the HTML for the meta box

        wp_nonce_field($this->nonce_action, $this->nonce_field);
?>
        <label for="<?php echo $this->author; ?>">Author:</label>
        <input class="widefat" type="text" id="<?php echo $this->author; ?>" name="<?php echo $this->author; ?>" value="<?php echo esc_attr($author); ?>" />

        <label for="<?php echo $this->published_date; ?>">Published Date:</label>
        <input class="widefat" type="text" id="<?php echo $this->published_date; ?>" name="<?php echo $this->published_date; ?>" value="<?php echo esc_attr($published_date); ?>" />

        <label for="<?php echo $this->layout; ?>">Layout:</label>
        <select class="widefat" name="<?php echo $this->layout; ?>" id="<?php echo $this->layout; ?>" value="<?php echo esc_attr($layout); ?>">
            <option value="">Select Layout</option>
            <option <?php selected($layout, "full") ?> value="full">Full Width</option>
            <option <?php selected($layout, "sidebar") ?> value="sidebar">With Sidebar</option>
        </select>

<?php
    }

    public function _themename_post_detail_metabox_update($post_id, $post)
    {
        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!isset($_POST[$this->nonce_field]) || !wp_verify_nonce($_POST[$this->nonce_field], $this->nonce_action)) {
            return;
        }

        $edit_cap = get_post_type_object($post->post_type)->cap->edit_post;
        if (!current_user_can($edit_cap, $post_id)) {
            return;
        }

        // Save or update the meta values for the post
        $author = isset($_POST[$this->author]) ? sanitize_text_field($_POST[$this->author]) : '';
        $published_date = isset($_POST[$this->published_date]) ? sanitize_text_field($_POST[$this->published_date]) : '';
        $layout = isset($_POST[$this->layout]) ? sanitize_text_field($_POST[$this->layout]) : '';

        update_post_meta($post_id, $this->author, $author);
        update_post_meta($post_id, $this->published_date, $published_date);
        update_post_meta($post_id, $this->layout, $layout);
    }
}

(new \_ThemeName\Post)->init();
