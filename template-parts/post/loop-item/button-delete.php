<?php

$postService = (new \_ThemeName\PostService);
if (current_user_can('delete_post', get_the_ID())) {
?>

    <a href="<?php echo  $postService->deleteUrl(); ?>" class="btn btn-danger btn-sm">
        <span class="btn-label">
            <i class="fa fa-trash"></i>
        </span>&nbsp;<?php echo esc_html__("Delete Post", "_themename") ?>
    </a>
<?php
}
