<?php
//1. Access main/global query
?>
<?php if(have_posts()){ ?>
<?php  while (have_posts()){ ?>
<?php the_post(); ?>
<a href="<?php the_permalink()?>" title="<?php the_title_attribute() ?> ">
    <h5><?php the_title() ?> </h5>
</a>
<?php }}
     else { ?>
<h2>No Posts Found</h2>
<?php } ?>

<?php 
//Under the Hood 
function have_posts_under_the_hood(){
    global $wp_query;
    return $wp_query->have_posts();
}

echo '<pre>'.var_dump($wp_query).'</pre>';


?>

<?php
//2. Create custom query
$the_query = new WP_Query(array('cat'=> '1'));
if($the_query->have_posts()){
    echo '<ul>';
    while($the_query->have_posts()){
        $the_query->the_post();
       echo '<li>'.get_the_title().'</li>';
    }
    echo '</ul>';
} else{

    echo '<h2>No Posts Found</h2>';
}
wp_reset_postdata();



?>