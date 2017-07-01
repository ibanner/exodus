<?php get_header(); ?>

    <div class="row">
        <div class="col-sm-12">
            <article id="<?php esc_attr_e( get_post_field('post_name', get_the_ID() ) ); ?>" <?php post_class("wrapper--page"); ?> role="article">

            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

                get_template_part( 'templates/content', get_post_type() );

            endwhile; endif;
            ?>
            </article> <!-- /.page -->
        </div> <!-- /.col-sm-12 -->
    </div> <!-- /.row -->

<?php get_footer(); ?>