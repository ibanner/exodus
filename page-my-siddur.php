<?php
get_header();
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$format = (isset($_GET['format'])) ? $_GET['format'] : '';
$ids = exodus_alm_query_ids('my-siddur');
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div id="my-siddur">
            <h1 class="page-title row"><?php _e( 'My Siddur' , 'exodus'); ?></h1>

                <?php

                    if (!is_user_logged_in()) {

                        echo '<div class="jumbotron">';
                        echo '<div class="alert alert-warning text-center" role="alert">';
                        echo '<p class="lead h1">' . __("Are you lost, dear friend?", 'exodus') . '</p>';
                        echo ' <a href="/wp-login.php" class="alert-link">' . __("You need to log in", 'exodus') . '</a> ' . __( 'or' , 'exodus') . ' <a href="/wp-login.php?action=register" class="alert-link">' . __("sign up", 'exodus') . '</a>' . __( ' to see this page.' , 'exodus');
                        echo '</div></div>';

                    } elseif ( empty($ids) ) {

                        echo '<div class="jumbotron">';
                        echo '<div class="alert alert-warning text-center" role="alert">';
                        echo '<p class="lead h1">' . __("Your Siddur is still empty!", 'exodus') . '</p>';
                        echo ' <a href="/wp-login.php" class="alert-link">' . __("Add your favorite items to your Siddur, for quick access.", 'exodus') . '</a>';
                        echo '</div></div>';

                    } else { ?>

                        <h2 class="screen-reader-text"><?php esc_html_e( "Categories" , 'exodus' ); ?></h2>
                        <div class="filter-ui row">
                            <?php exodus_post_types_tax_droplist_ui($type); ?>
                            <?php exodus_post_format_droplist_ui($format); ?>
                        </div>

                        <div id="masonry-grid">
                            <?php exodus_alm_shortcode($ids,$type,$format) ?>
                        </div>

                        <?php
                    } ?>

        </div> <!-- /.page -->
    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>