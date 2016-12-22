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
    $type = (isset($_GET['type'])) ? $_GET['type'] : ''; // Get type filter param
    $format = (isset($_GET['format'])) ? $_GET['format'] : ''; // Get format filter param
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
                <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
                <div class="filter-ui row">
                    <?php exodus_post_types_tax_droplist_ui($type); ?>
                    <?php exodus_post_format_droplist_ui($format); ?>
                </div>

                <div id="masonry-grid">

                    <?php
                    $button_label = __('Older Items' , 'exodus');
                    echo do_shortcode('[ajax_load_more post_type="post" images_loaded="true" category="'. $category->slug .'" post_format="'. $format .'" taxonomy="post_types_tax" taxonomy_terms="'. $type .'" taxonomy_operator="IN" button_label="'. $button_label .'"]');
                    ?>

                </div>
            </div><!-- /.category -->
        </div><!-- /.blog-main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>