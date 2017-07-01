<?php get_header(); ?>

            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

                get_template_part( 'templates/content', 'single' );
                // get_template_part( 'templates/content-single', get_post_type() );

                if ( comments_open() || get_comments_number() ) : comments_template();
                endif;

            endwhile; endif;
            ?>


<?php get_footer(); ?>