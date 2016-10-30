<?php get_header(); ?>

    <div class="row">
        <div class="search-box">
            <?php get_search_form(); ?>
        </div>
        <ul class="category-tiles">
            <?php
            $args = array(
                'orderby'    => 'count',
                'order'      => 'DESC',
                'title_li'   => '',
                'hide_empty'    => false,
                'include'       => array(14,15,16,17),
            );
            wp_list_categories($args); ?>
        </ul>
    </div>
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