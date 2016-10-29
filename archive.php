<?php get_header(); ?>

    <div class="row">

        <?php $post_type = get_post_type(); ?>
        <div class="col-sm-12 blog-main">
            <div class="archive archive--<?php echo $post_type; ?>">
                <h1 class="archive-title"><?php the_archive_title(); ?></h1>

            <?php
            if ( have_posts() ) : ?>
                <div class="grid">
                    <div class="grid-sizer col-xs-12 col-sm-6 col-md-3"></div>
                    <?php while ( have_posts() ) : the_post();

                        get_template_part( 'templates/list' , $post_type );

                    endwhile; ?>
                </div><!-- /.grid -->

                <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>
            </div><!-- /.archive -->

            <?php endif;
            ?>

        </div> <!-- /.blog-main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>