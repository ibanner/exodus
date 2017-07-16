<?php
get_header();
$type = get_queried_object()->slug;

$ids = exodus_alm_query_ids('index');
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div id="archive">
            <h1 class="archive__title row"><?php exodus_grid_title(); ?></h1>
                <?php /*include( locate_template( 'sections/filter-row.php', false, false ) ); */?>
            <section id="masonry-grid">
                <?php exodus_alm_shortcode($ids,$type) ?>
            </section>
        </div><!-- /#archive -->
    </div><!-- /.blog-main -->
</div> <!-- /.row -->

<?php get_footer(); ?>