<?php
    get_header();
    $term = get_queried_object();
//    $sub_cats = get_term_children( $term->term_id , 'category' );
    $sub_cats = get_categories( array(
        'orderby' => 'id',
        'parent'  => $term->term_id,
        'hide_empty' => false,
    ) );
?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="category category--<?php echo single_cat_title(); ?>">
                <h1 class="category-title row"><?php single_cat_title(); ?></h1>
                <?php if ( $sub_cats ) : ?>
                    <h2 class="screen-reader-text"><?php esc_html_e( "Sub-Categories" , 'exodus' ); ?></h2>
                    <div class="sub-cats row">
                        <div class="button-group filter-button-group category col-md-6 col-sm-12" data-filter-group="category">
                            <button class="button btn btn-info sub-cat active" aria-pressed="true" data-filter="*"><?php esc_html_e( "Show All" , 'exodus' ); ?></button>
                        <?php
                        foreach ( $sub_cats as $category ) {
                            echo '<button class="button btn btn-info sub-cat" aria-pressed="false" data-filter=".category-' . esc_html( $category->slug ) . '">' . esc_html( $category->name ) . '</button>
                            ';
                        }

                        /*foreach ( $sub_cats as $category ) {
                            printf( '<li class="sub-cat element-item ' . esc_html( $category->slug ) . '"><a href="%1$s"><button class="btn btn-info">%2$s</button></a></li>',
                                esc_url( get_category_link( $category->term_id ) ),
                                esc_html( $category->name )
                            );
                        }*/
                        ?>
                        </div>
                        <div class="button-group filter-button-group type col-md-6 col-sm-12" data-filter-group="type">
                            <button class="button btn btn-warning sub-cat active" aria-pressed="true" data-filter="*"><?php esc_html_e( "Show All" , 'exodus' ); ?></button>
                            <button class="button btn btn-warning sub-cat" aria-pressed="false" data-filter=".text"><?php esc_html_e( "Text" , 'exodus' ); ?></button>
                            <button class="button btn btn-warning sub-cat" aria-pressed="false" data-filter=".ritual"><?php esc_html_e( "Ritual" , 'exodus' ); ?></button>
                            <button class="button btn btn-warning sub-cat" aria-pressed="false" data-filter=".format-video"><?php esc_html_e( "Video" , 'exodus' ); ?></button>
                        </div>
                    </div>

                <?php endif; ?>
                <?php
                if ( have_posts() ) : ?>
                    <div class="grid">
<!--                        <div class="grid-sizer col-xs-12 col-sm-6 col-md-3"></div>-->
                        <?php /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            get_template_part( 'templates/list' );

                        endwhile; ?>
                    </div><!-- /.grid -->
                    <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>
                <?php else :

                    echo wpautop( esc_html_e( "There's Nothing Here yet" , 'exodus' ) );
                    // get_template_part( 'templates/content', 'none' );

                endif; ?>
            </div><!-- /.category -->
        </div><!-- /.blog-main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>