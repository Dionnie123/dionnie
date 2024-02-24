<?php

namespace _ThemeName;

class Book
{

    protected $bookDetailMetaBox;

    public function __construct()
    {
        add_action('init', array($this, 'register'));
        $this->bookDetailMetaBox = new BookDetailMetaBox();
    }

    public function register()
    {
        $labels = array(
            'name'               => __('Books', '_themename'),
            'menu_name'          => __('Books', '_themename'),
            'singular_name'      => __('Book', '_themename'),
        );
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
        );
        register_post_type('book', $args);
    }
}



class BookDetailMetaBox
{

    protected  $author = "_themename_book_author";
    protected  $published_date = "_themename_book_published_date";

    public function __construct()
    {
        add_action('add_meta_boxes_book', array($this, '_themename_book_detail_metabox'));
        add_action('save_post', array($this, '_themename_book_detail_metabox_update'), 10, 2);
    }

    public function _themename_book_detail_metabox()
    {
        add_meta_box(
            '_themename_book_detail_metabox', // Unique ID
            'Book Details',           // Box title
            array($this, '_render_meta_box_book_details'), // Callback function to render the content
            'book', // Post type
            'normal', // Context (normal, advanced, side)
            'high' // Priority (high, core, default, low)
        );
    }

    function _render_meta_box_book_details($post)
    {
        /* echo "<pre>";
        var_dump(get_post_type_object($post->post_type));
        echo "</pre>"; */
        // Retrieve existing meta values for the book
        $author = get_post_meta($post->ID, $this->author, true);
        $published_date = get_post_meta($post->ID, $this->published_date, true);

        // Output the HTML for the meta box

        wp_nonce_field('_themename_book_detail_metabox_update', '_themename_book_detail_metabox_nonce');
?>
<label for="<?php echo $this->author; ?>">Author:</label>
<input class="widefat" type="text" id="<?php echo $this->author; ?>" name="<?php echo $this->author; ?>"
    value="<?php echo esc_attr($author); ?>" />

<br />

<label for="<?php echo $this->published_date; ?>">Published Date:</label>
<input class="widefat" type="text" id="<?php echo $this->published_date; ?>" name="<?php echo $this->published_date; ?>"
    value="<?php echo esc_attr($published_date); ?>" />
<?php
    }

    public function _themename_book_detail_metabox_update($post_id, $post)
    {
        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

          if (!isset($_POST['_themename_book_detail_metabox_nonce']) || !wp_verify_nonce($_POST['_themename_book_detail_metabox_nonce'], '_themename_book_detail_metabox_update')) {
            return;
        } 

      /*   if (!isset($_POST['_themename_book_detail_metabox_nonce']) || !check_admin_referer('_themename_book_detail_metabox_update', '_themename_book_detail_metabox_nonce')) {
            return;
        }
 */

        $edit_cap = get_post_type_object($post->post_type)->cap->edit_post;
        if (!current_user_can($edit_cap, $post_id)) {
            return;
        }

        // Save or update the meta values for the book
        $author = isset($_POST[$this->author]) ? sanitize_text_field($_POST[$this->author]) : '';
        $published_date = isset($_POST[$this->published_date]) ? sanitize_text_field($_POST[$this->published_date]) : '';

        update_post_meta($post_id, $this->author, $author);
        update_post_meta($post_id, $this->published_date, $published_date);
    }
}