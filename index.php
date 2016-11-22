<?php
get_header();
$index_object = get_queried_object();
$alert = exodus_siddur_action_handler();
?>

    <div class="row">

        <div id="main" class="col-sm-12 blog-main">

            <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
            <div class="isotope-ui row">
                <?php exodus_post_types_tax_filter_ui(); ?>
                <?php exodus_post_format_filter_ui(); ?>
            </div>

            <?php
            if ( have_posts() ) : ?>
                <div class="grid row section">
                    <div class="grid-sizer col-xs-12 col-sm-6 col-md-3"></div>
                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'templates/list' );

                    endwhile; ?>
                </div><!-- /.grid -->

                <!--<div class="posts-nav col-sm-12"><?php /*// exodus_posts_navigation(); */?></div>-->

            <?php endif;
            ?>

        </div> <!-- /.blog-main -->

    </div> <!-- /.row -->


<?php get_footer(); ?>