<?php if ( post_password_required() ) {
    return;
} ?>

<div class="row">
    <div class="col-sm-12">
        <section id="comments" class="wrapper--comments">

            <div class="<!--container-->">

                <h4 class="meta-title primary"><?php esc_html_e('Discuss this', 'exodus'); ?></h4>
                <?php if (have_comments()) : ?>
                    <h4 class="meta-title secondary">
                        <small><?php printf(_nx('One comment on “%2$s”', '%1$s comments on “%2$s”', get_comments_number(), 'comments title'),
                                number_format_i18n(get_comments_number()), get_the_title()); ?></small>
                    </h4>
                    <div id="comments-list" class="comments-area inlet caption">
                        <ul class="comment-list">
                            <?php
                            wp_list_comments(array(
                                'short_ping' => true,
                                'avatar_size' => 50,
                            ));
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
                    <p class="no-comments">
                        <?php _e('Comments are closed.'); ?>
                    </p>

                <?php endif; ?>
                <?php
                $comments_args = array(
                    'title_reply_before' => '<h4 id="reply-title" class="meta-title secondary">',
                    'title_reply_after' => '</h4>
                        <div id="comments-form" class="comments-area inlet caption">',
                    'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account" class="log-out">Not You?</a>', 'exodus'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                );
                comment_form($comments_args);
                ?>

            </div><!-- /.container -->

        </section>
    </div>
</div>