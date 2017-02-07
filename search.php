<?php
get_header();
// $index_object = get_queried_object();
$term = (isset($_GET['s'])) ? $_GET['s'] : ''; // Get 's' querystring param
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$format = (isset($_GET['format'])) ? $_GET['format'] : '';
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main search">
        <div id="search">
            <h1 class="search-title row"><?php the_title(__( "Search Results for:" , 'exodus' ).' '); ?></h1>

                <?php include( locate_template( 'sections/filter-row.php', false, false ) ); ?>

            <div id="masonry-grid">
                <?php exodus_alm_shortcode('',$type,$format) ?>
            </div>
        </div>

    </div> <!-- /.blog-main -->

</div> <!-- /.row -->


<?php get_footer(); ?>