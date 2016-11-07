<?php
$curuser = get_current_user_id();
$siddur = 'siddur_' . $curuser . '_1';
get_header();
$alert = exodus_siddur_action_handler();
?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div id="my-siddur <?php echo post_class('page my-siddur'); ?>>
                <h1 class="page-title row"><?php the_title(); ?></h1>

                    <?php

                        $args = array(
                            'post_type' => array( 'post' , 'text' , 'ritual' ),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'siddurim',
                                    'field'    => 'slug',
                                    'terms'    =>  $siddur ,
                                ),
                            ),
                        );
                        $query = new WP_Query( $args );

                        if (!is_user_logged_in()) {

                            echo '<div class="jumbotron">';
                            echo '<div class="alert alert-warning text-center" role="alert">';
                            echo '<p class="lead h1">' . __("Are you lost, dear friend?", 'exodus') . '</p>';
                            echo ' <a href="/wp-login.php" class="alert-link">' . __("You need to log in", 'exodus') . '</a> ' . __( 'or' , 'exodus') . ' <a href="/wp-login.php?action=register" class="alert-link">' . __("sign up", 'exodus') . '</a>' . __( ' to see this page.' , 'exodus');
                            echo '</div></div>';

                        } elseif ( empty($query) ) {

                            echo '<div class="jumbotron">';
                            echo '<div class="alert alert-warning text-center" role="alert">';
                            echo '<p class="lead h1">' . __("Your Siddur is still empty!", 'exodus') . '</p>';
                            echo ' <a href="/wp-login.php" class="alert-link">' . __("Add your favorite rituals and texts to your Siddur, for quick access.", 'exodus') . '</a>';
                            echo '</div></div>';

                        } elseif ( $query ) { ?>

                            <!--<div class="page-content">
                                <?php /*the_content(); */?>
                            </div>-->

                            <?php

                            if ( $query->have_posts() ) :

                                /* Set empty var to collect all post categories */
                                $categories = '';

                                /* Start first Loop */
                                while ( $query->have_posts() ) : $query->the_post();

                                    /* Get all catogories for each post */
                                    $post_cats = wp_get_post_categories(get_the_ID());

                                    /* arrays are converted to strings */
                                    if (is_array($post_cats)) {
                                        $post_cats = implode(', ' , $post_cats);
                                    }
                                    /* add current post categories to $categories */
                                    if ( empty($categories) ) {
                                        $categories .= $post_cats; // No delimiter needed for the first insertion
                                    } else {
                                        $categories .= ', ' . $post_cats;
                                    }

                                endwhile;
                                /* Convert back to array, and filter duplicates */
                                $categories_unique = array_unique(explode(', ' , $categories));

                            endif;

                            if ( $categories_unique ) : ?>
                                <h2 class="screen-reader-text"><?php esc_html_e( "Categories" , 'exodus' ); ?></h2>
                            <div class="categories isotope-ui row">
                                <div class="button-group filter-button-group category col-md-6 col-sm-12" data-filter-group="category">
                                    <button class="button btn btn-info btn-isotope cat active" aria-pressed="true" data-filter="*"><?php esc_html_e( "Show All" , 'exodus' ); ?></button>
                                    <?php
                                    foreach ( $categories_unique as $category_id ) {
                                        // Get the category object from the ID
                                        $category = get_category($category_id);
                                        echo '<button class="button btn btn-info btn-isotope cat" aria-pressed="false" data-filter=".category-' . esc_html( $category->slug ) . '">' . esc_html( $category->name ) . '</button>
                                        ';
                                    }

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

                            if ( $query->have_posts() ) : ?>
                                <div class="grid">

                                    <?php /* Start the Loop */
                                    while ( $query->have_posts() ) : $query->the_post();

                                        get_template_part( 'templates/list' );

                                    endwhile; ?>
                                </div><!-- /.grid -->
                                <div class="posts-nav col-sm-12"><?php the_posts_navigation(); ?></div>
                            <?php endif;
                        } ?>

            </div> <!-- /.page -->
        </div> <!-- /.main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>