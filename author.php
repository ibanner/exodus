<?php
get_header();
$qobject = get_queried_object();
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$format = (isset($_GET['format'])) ? $_GET['format'] : '';
$ids = exodus_alm_query_ids('index');
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div id="author">
            <h1 class="archive-title row"><?php echo __( 'Posts by: ' , 'exodus' ) . $qobject->display_name; ?></h1>

            <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
            <div class="filter-ui row">
                <?php exodus_post_types_tax_droplist_ui($type); ?>
                <?php exodus_post_format_droplist_ui($format); ?>
            </div>
            <div id="masonry-grid">
                <?php exodus_alm_shortcode($ids,$type,$format) ?>
            </div>
        </div><!-- /.category -->
    </div><!-- /.blog-main -->
</div> <!-- /.row -->

<?php get_footer(); ?>