<?php

$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$order = isset($_GET['order']) ? $_GET['order'] : 'desc';
$category_name = isset($_GET['category_name']) ? sanitize_text_field($_GET['category_name']) : '';



?>

<div class="container my-3">
    <div class="row justify-content-end ">
        <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">

            <div class="row">
                <div class="col">
                    <label for="s">Search:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" value="<?php echo esc_attr($search_query); ?>" name="s" aria-label="Search" aria-describedby="basic-addon2">
                        <button class="btn btn-secondary clear" type="button" id="button-addon2" onclick="clear()">X</button>
                    </div>

                </div>
                <div class="col">
                    <label for="order">Sort Order:</label>
                    <select class="form-control" name="order" id="order">
                        <option value="asc" <?php selected('asc', $order); ?>>Ascending</option>
                        <option value="desc" <?php selected('desc', $order); ?>>Descending</option>
                    </select>
                </div>
                <div class="col">
                    <?php
                    $categories = get_categories();
                    ?>
                    <label for="category_name">Category:</label>
                    <select class="form-select" name="category_name" id="category_name">
                        <option value="" <?php selected('', $category_name); ?>>All Categories</option>
                        <?php
                        foreach ($categories as $category) {
                            echo '<option value="' . esc_attr($category->slug) . '" ' . selected($category->slug, $category_name) . '>' . esc_html($category->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="searchsubmit">&nbsp;</label>
                    <input class="btn btn-secondary d-block" type="submit" id="searchsubmit" value="Filter">
                </div>
            </div>
        </form>
    </div>
</div>