<div class="page-content my-account">
    <h1 class="page__title"><?php the_title(); ?></h1>

    <div class="my-account">

        <?php
        if (!is_user_logged_in()) {
            echo '<div class="alert alert-warning text-center" role="alert">';
            echo '<p class="lead h1">' . __("Are you lost, dear friend?", 'exodus') . '</p>';
            echo ' <a href="/wp-login.php" class="alert-link">' . __("You need to log in", 'exodus') . '</a> ' . __( 'or' , 'exodus') . ' <a href="/wp-login.php?action=register" class="alert-link">' . __("sign up", 'exodus') . '</a>' . __( ' to see this page.' , 'exodus');
            echo '</div>';
        } else { ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
            <?php
            acf_form( array(
                'post_id' => 'user_' . get_current_user_id(),
                'field_groups' => array('exodus_user_information'),
                'submit_value' => __("Update Account", 'exodus'),
                'updated_message' => __("<b>Success!</b> Your account is now up-to-date with the new info.", 'exodus'),
            ));
        }
        ?>
    </div>

</div><!-- /.article -->