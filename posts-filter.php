<?php 

$categories = get_categories(); ?>

<div class="container my-3">
    <div class="row justify-content-end ">
        <form onsubmit="submitForm()">
            <div class="col d-flex d-grid gap-2">

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Title" name="title_search"
                        aria-label="Search by Title" aria-describedby="basic-addon2"
                        value="<?php echo esc_attr(  $_GET['title_search']  ); ?>">
                    <button class="btn btn-secondary clear" type="button" id="button-addon2"
                        onclick="clear()">X</button>
                </div>

                <input type="hidden" name="orderby"
                    value="<?php echo esc_attr( isset( $_GET['orderby'] ) ? $_GET['orderby'] : '' ); ?>">
                <input type="hidden" name="order"
                    value="<?php echo esc_attr( isset( $_GET['order'] ) ? $_GET['order'] : '' ); ?>">
                <div class="input-group-append">
                    <button class="btn btn-secondary" onclick="submitForm()">Search</button>
                </div>

                <div>
                    <select onchange="submitForm()" class="form-select " name="category_name" id="category-filter"
                        aria-label="Default select example">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo esc_attr($category->slug); ?>"
                            <?php selected($category->slug, get_query_var('category_name')); ?>>
                            <?php echo esc_html($category->name); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <select onchange="submitForm()" class="form-select " name="order_filter"
                        aria-label="Default select example">
                        <option value="">Sort</option>
                        <option value='&orderby=date&order=asc'>Date ASC</option>
                        <option value='&orderby=date&order=desc'>Date DESC</option>
                        <option value='&orderby=title&order=asc'>Title ASC</option>
                        <option value='&orderby=title&order=desc'>Title DESC</option>
                    </select>
                </div>







            </div>
        </form>


    </div>
</div>

<script>
(function($) {
    "use strict";
    $(function() {
        $("button.clear").click(function() {
            window.location.replace("<?php bloginfo('url') ?>");
        });
    });
}(jQuery));





function submitForm() {
    (function($) {
        "use strict";
        $(function() {
            var title = 'title_search=' + $("input[name=title_search]").val();
            var category = '&category_name=' + $('select[name=category_name]').find("option:selected")
                .val();
            var order = $('select[name=order_filter]').find("option:selected").val();

            var queryString = title + category + order;
            window.location.href = "<?php bloginfo('url') ?>" + '?' + queryString;
        });
    }(jQuery));
}
</script>