<?php
    get_header();
    $term = get_queried_object();
    $sub_cats = get_categories( array(
        'orderby' => 'id',
        'parent'  => $term->term_id,
        'hide_empty' => false,
    ) );
    $alert = exodus_siddur_action_handler();
?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="category category--<?php echo single_cat_title(); ?>">
                <h1 class="category-title row"><?php single_cat_title(); ?></h1>
                <h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
                <div class="isotope-ui row">
                    <?php exodus_post_types_tax_filter_ui(); ?>
                    <?php exodus_post_format_filter_ui(); ?>
                </div>

                <?php

                if ( have_posts() ) : ?>
                    <div class="grid row section">

                        <?php /* Start the Loop */




                        while ( have_posts() ) : the_post();

                            get_template_part( 'templates/list' );

                        endwhile; ?>
                    </div><!-- /.grid -->
                    <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>
                <?php else :

                    echo wpautop( __( "There's Nothing Here yet" , 'exodus' ) );
                    // get_template_part( 'templates/content', 'none' );

                endif; ?>
            </div><!-- /.category -->
        </div><!-- /.blog-main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>