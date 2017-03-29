<?php get_header(); ?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div class="page <?php echo post_class(); ?>">

        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();

            get_template_part( 'templates/content', get_post_type() );

        endwhile; endif;
        ?>
        </div> <!-- /.page -->
    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>