<?php get_header(); ?>

    <div class="row">
        <div class="search-box">
            <?php get_search_form(); ?>
        </div>
        <div class="category-tiles row">
            <?php

            $top_cats = get_categories( array(
                'orderby' => 'id',
                'hide_empty' => false,
                'exclude'       => 1,
                'parent'        => 0
            ) );

            foreach ( $top_cats as $category ) {
                $sub_cats = get_categories( array (
                        'orderby' => 'id',
                        'hide_empty' => false,
                        'parent'        => $category->term_id
                    )
                );
                /*$cat_background_url = get_field("featured-image", "category_' . $category->term_id . '");
                $default_image = 'http://kolehad.dev/wp-content/themes/exodus/images/default_cat.jpg';
                $cat_bg_url = ($cat_background_url ? $cat_background_url : $default_image);
                var_dump($cat_background_url,$cat_bg_url);*/

                echo '<div class="category-wrapper col-xs-12 col-md-6">';
                echo '<div class="category panel panel-info">';
                echo '<div class="panel-heading"><h2><a href="' . esc_url( get_category_link($category) ) . '">' . esc_html( $category->name ) .  '</a></h2></div>';
                echo '<div class="panel-body"><ul class="sub-cat-list">';
                foreach ( $sub_cats as $sub_cat ) {
                    echo '<li class="sub-cat-link"><a href="' . esc_url( get_category_link($sub_cat) ) . '">' . esc_html( $sub_cat->name ) .  '</a></li>';
                }
                echo '</ul></div>';
                echo '</div></div>';
            }
            ?>
        </div><!-- /.category-tiles -->
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