<?php get_header(); ?>

    <div class="row">

        <div class="col-sm-8 blog-main">

            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

                echo get_post_type();
                get_template_part( 'content-single', get_post_type() );

                if ( comments_open() || get_comments_number() ) : comments_template();
                endif;

            endwhile; endif;
            ?>

        </div> <!-- /.blog-main -->

        <?php get_sidebar(); ?>

    </div> <!-- /.row -->

<?php get_footer(); ?>