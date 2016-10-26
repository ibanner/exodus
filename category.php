<?php get_header(); ?>

    <div class="row">

        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="category category--<?php echo single_cat_title(); ?>">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>

                <div class="grid data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'">

            <?php
            if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part( 'templates/list', 'category' );

                endwhile;

                the_posts_navigation();

            else :

                echo wpautop( 'Sorry, no posts were found' );
                // get_template_part( 'templates/content', 'none' );

            endif; ?>
                </div><!-- /.grid -->
            </div><!-- /.category -->

        </div> <!-- /.blog-main -->

    </div> <!-- /.row -->

<?php get_footer(); ?>