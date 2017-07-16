<?php
get_header();
$term = get_queried_object();
$children = get_term_children($term->cat_ID , 'category');
$parent = wp_get_term_taxonomy_parent_id($term->cat_ID , 'category');
$cat = get_query_var('cat');
$category = get_category ($cat);
$sub_cats = get_categories( array(
    'orderby' => 'id',
    'parent'  => $term->term_id,
    'hide_empty' => false,
) );
$ids = exodus_alm_query_ids('cat');
$type = (isset($_GET['post_types_tax'])) ? $_GET['post_types_tax'] : '';
$alert = exodus_siddur_action_handler();
?>


<section class="wrapper--category">

    <?php
    /*if ($parent) {
        echo '<p id="parent-cat-label" class="category__title--parent"><span>' . get_the_category_by_ID($parent) . '</span></p>';
    }*/
    ?>

    <h1 class="category__title"><?php exodus_grid_title(); ?></h1>

    <?php
    /*if ($children) {
        echo '<nav id="sub-cats" class="navbar navbar-default">
        <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sub-cat-list" aria-expanded="false">
            <i class="fa fa-angle-double-down" aria-hidden="true"></i>
            <span class="sr-only">' . esc_html__( "View Subcategories" , "exodus" ) . '</span>
        </button>';
        echo '<div class="collapse navbar-collapse" id="sub-cat-list">';
            echo '<ul class="nav navbar-nav">';
            foreach ($children as $child) {
                echo '<li><a href="'. get_category_link($child) . '">' . get_the_category_by_ID($child) . '</a></li>';
            }
            echo '</ul>';
        echo '</div>';
    echo '</div></div></nav>';
    }*/
    ?>

</section><!-- /.wrapper--category -->

<section id="masonry-grid" class="wrapper--grid">
    <?php exodus_alm_shortcode($ids,$type) ?>
</section>


<?php get_footer(); ?>