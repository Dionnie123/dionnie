<?php

function after_footer_info()
{
?>
    <div class="bg-dark text-center p-2">
        <span class="text-light"><small>Made with ❤️ by Mark Dionnie</small></span>
    </div>
<?php
}
add_action('_themename_after_footer_info', 'after_footer_info');
