<?php get_header(); ?>

<div class="row">

    <?php get_sidebar(); ?>

    <div class="col-sm-8 col-sm-offset-1 blog-main">

        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();

            get_template_part( 'templates/content', get_post_format() );

        endwhile; ?>

        <nav>
            <ul class="pager">
                <li><?php next_posts_link( 'Previous' ); ?></li>
                <li><?php previous_posts_link( 'Next' ); ?></li>
            </ul>
        </nav>

            <?php endif;
        ?>

    </div> <!-- /.blog-main -->

</div> <!-- /.row -->

<?php get_footer(); ?>