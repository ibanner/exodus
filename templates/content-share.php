<div class="page-content share">
    <h1 class="page__title"><?php the_title(); ?></h1>

    <div class="share">

        <?php
        if (!is_user_logged_in()) {
            echo '<div class="alert alert-warning text-center" role="alert">';
            echo '<p class="lead h1">' . esc_html__("Are you lost, dear friend?", 'exodus') . '</p>';
            echo ' <a href="/wp-login.php" class="alert-link">' . esc_html__("You need to log in", 'exodus') . '</a> ' . __( 'or' , 'exodus') . ' <a href="/wp-login.php?action=register" class="alert-link">' . __("sign up", 'exodus') . '</a>' . __( ' to see this page.' , 'exodus');
            echo '</div>';
        } else { ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
            <?php
            acf_form( array(
                'id' => 'share-post',
                'post_id' => 'new_post',
                'new_post' => array(
                    'post_type'     => 'post',
                    'post_status'   => 'pending'
                ),
                'post_title' => true,
                'post_content' => true,
                'submit_value' => esc_html__("Submit for review", 'exodus'),
                'updated_message' => __("<b>Success!</b> Your article was submitted successfully and will be reviewed shortly.", "exodus"),
            ));
        }
        ?>
    </div>

</div><!-- /.article -->