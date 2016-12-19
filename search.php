<?php
get_header();
// $index_object = get_queried_object();
$term = (isset($_GET['s'])) ? $_GET['s'] : ''; // Get 's' querystring param
$type = (isset($_GET['type'])) ? $_GET['type'] : ''; // Get type filter param
$format = (isset($_GET['format'])) ? $_GET['format'] : ''; // Get format filter param

$alert = exodus_siddur_action_handler();
?>

    <div class="row">

        <div id="main" class="col-sm-12 blog-main search">

            <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
            <div class="filter-ui row">
                <?php exodus_post_types_tax_droplist_ui($type); ?>
                <?php exodus_post_format_droplist_ui($format); ?>
            </div>
            <div id="masonry-grid">

            <?php
            echo do_shortcode('[ajax_load_more post_type="post" images_loaded="true" search="'. $term .'" post_format="'. $format .'" taxonomy="post_types_tax" taxonomy_terms="'. $type .'" taxonomy_operator="IN"]');
            ?>

            </div>

        </div> <!-- /.blog-main -->

    </div> <!-- /.row -->


<?php get_footer(); ?>