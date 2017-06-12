<?php get_header(); ?>

    <!--<div class="row">-->

        <!--<div id="main" class="col-sm-12 blog-main single-column">-->

            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

                get_template_part( 'templates/content-single', get_post_type() );

                if ( comments_open() || get_comments_number() ) : comments_template();
                endif;

            endwhile; endif;
            ?>

        <!--</div>--> <!-- /#main -->

    <!--</div>--> <!-- /.row -->

<?php get_footer(); ?>