<?php get_header(); ?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="category category--<?php echo single_cat_title(); ?>">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>
                <?php
                if ( have_posts() ) : ?>
                    <div class="grid">
                        <div class="grid-sizer col-xs-12 col-sm-6 col-md-3"></div>
                        <?php /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            get_template_part( 'templates/list', 'category' );

                        endwhile; ?>
                    </div><!-- /.grid -->
                    <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>
                <?php else :

                    echo wpautop( 'Sorry, no posts were found' );
                    // get_template_part( 'templates/content', 'none' );

                endif; ?>
            </div><!-- /.category -->
        </div><!-- /.blog-main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>