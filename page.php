<?php get_header(); ?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div class="page <?php echo post_class(); ?>">
            <h1 class="page-title row"><?php the_title(); ?></h1>

        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();

            echo get_post_type();
            get_template_part( 'templates/content', get_post_type() );

        endwhile; endif;
        ?>
        </div> <!-- /.page -->
    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>