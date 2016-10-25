<?php get_header(); ?>

    <div class="row">

        <?php $post_type = get_post_type(); ?>
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="archive archive--<?php echo $post_type; ?>">
                <h1 class="archive-title"><?php the_archive_title(); ?></h1>

            <?php
            if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part( 'templates/list', $post_type );

                endwhile;

                the_posts_navigation();

            else :

                get_template_part( 'templates/content', 'none' );

            endif; ?>
            </div><!-- /.archive -->

        </div> <!-- /.blog-main -->

    </div> <!-- /.row -->

<?php get_footer(); ?>