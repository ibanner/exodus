<?php
get_header();
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$ids = exodus_alm_query_ids('my-siddur');
$alert = exodus_siddur_action_handler();
?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div id="my-siddur">
            <section class="wrapper--siddur">
                <h1 class="my-siddur__title row"><em><?php _e( 'My Siddur' , 'exodus'); ?></em></h1>
            </section>

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

                    } else {

                        /*include( locate_template( 'sections/filter-row.php', false, false ) );*/ ?>

                <section id="masonry-grid" class="wrapper--grid">
                    <?php exodus_alm_shortcode($ids,$type) ?>
                </section>

                        <?php
                    } ?>

        </div> <!-- /#my-siddur -->
    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>