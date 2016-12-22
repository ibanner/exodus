<?php
get_header();
$index_object = get_queried_object();
$type = (isset($_GET['type'])) ? $_GET['type'] : ''; // Get type filter param
$format = (isset($_GET['format'])) ? $_GET['format'] : ''; // Get format filter param

$alert = exodus_siddur_action_handler();
?>

    <div class="row">

        <div id="main" class="col-sm-12 blog-main">

            <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
            <div class="filter-ui row">
                <?php exodus_post_types_tax_droplist_ui($type); ?>
                <?php exodus_post_format_droplist_ui($format); ?>
            </div>
            <div id="masonry-grid">

            <?php
            $button_label = __('Older Items' , 'exodus');
            echo do_shortcode('[ajax_load_more post_type="post" images_loaded="true" button_label="'. $button_label .'"]');
            ?>

            </div>

        </div> <!-- /.blog-main -->

    </div> <!-- /.row -->


<?php get_footer(); ?>