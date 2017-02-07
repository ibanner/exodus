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
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$format = (isset($_GET['format'])) ? $_GET['format'] : '';
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div class="category">
            <?php

            if ($parent) {
                echo '<p id="parent-cat-label" class="caption"><span>' . get_the_category_by_ID($parent) . '</span></p>';
            }
            ?>
            <h1 class="category-title row"><?php single_cat_title(); ?></h1>
            <?php

            if ($children) {
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
            }
            ?>
                <?php include( locate_template( 'sections/filter-row.php', false, false ) ); ?>
            <div id="masonry-grid">
                <?php exodus_alm_shortcode('',$type,$format) ?>
            </div>
        </div><!-- /.category -->
    </div><!-- /.blog-main -->
</div> <!-- /.row -->

<?php get_footer(); ?>