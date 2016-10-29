<?php get_header(); ?>

<div class="row">

    <div class="col-sm-12 blog-main">

        <?php
        if ( have_posts() ) : ?>
        <div class="grid">
            <div class="grid-sizer col-xs-12 col-sm-6 col-md-3"></div>
            <?php while ( have_posts() ) : the_post();

            get_template_part( 'templates/list' );

        endwhile; ?>
        </div><!-- /.grid -->

            <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>

            <?php endif;
        ?>

    </div> <!-- /.blog-main -->

</div> <!-- /.row -->

<?php get_footer(); ?>