<?php
get_header();
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$ids = exodus_alm_query_ids('index');
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div id="archive">
            <h1 class="archive-title row"><?php the_archive_title(); ?></h1>
                <?php include( locate_template( 'sections/filter-row.php', false, false ) ); ?>
            <div id="masonry-grid">
                <?php exodus_alm_shortcode($ids,$type) ?>
            </div>
        </div><!-- /.category -->
    </div><!-- /.blog-main -->
</div> <!-- /.row -->

<?php get_footer(); ?>