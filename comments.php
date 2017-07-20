<?php if ( post_password_required() ) {
    return;
}

$comments_n = get_comments_number();

?>

<div class="row no-print">
    <div class="col-sm-12">
        <section id="comments" class="wrapper--comments">

            <div class="comments-area">

                <?php if (have_comments()) : ?>
                    <h2 class="comments-area__count">
                        <?php printf( _nx('One Comment', '%s Comments', $comments_n, 'comments title', 'exodus'), number_format_i18n( $comments_n ) ); ?>
                    </h2>
                    <div id="comments-list" class="comments-area__list">
                        <ul class="comment-list">
                            <?php
                            wp_list_comments(array(
                                'short_ping' => true,
                                'avatar_size' => 60,
                            ));
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (!comments_open() && $comments_n && post_type_supports(get_post_type(), 'comments')) : ?>
                    <p class="no-comments">
                        <?php esc_html_e('Comments are closed.', 'exodus'); ?>
                    </p>

                <?php endif; ?>
                <?php
                $comments_args = array(
                    'fields' => apply_filters(
                        'comment_form_default_fields', array(
                            'author' =>
                                '<div class="comment-meta-fields">' .
                                '<p class="comment-form-author">' .
                                '<label for="author">' . esc_html__( 'Your Name', 'exodus' ) . ( $req ? '<span class="required">*</span>' : '' )  .'</label> ' .
                                '<input id="author" placeholder="' . esc_html__( 'Your Name', 'exodus' ) . '" name="author" type="text" value="' .
                                esc_attr( $commenter['comment_author'] ) . '" size="30" ' . ( $req ? 'aria-required="true"' : '' ) . ' />'.
                                '</p>'
                        ,
                            'email'  =>
                                '<p class="comment-form-email">' .
                                '<label for="email">' . esc_html__( 'Your Email', 'exodus' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
                                '<input id="email" placeholder="your-real-email@example.com" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                '" size="30" ' . ( $req ? 'aria-required="true"' : '' ) . ' />'  .
                                '</p>',
                            'url'    =>
                                '<p class="comment-form-url">' .
                                '<label for="url">' . esc_html__( 'Website', 'exodus' ) . '</label>' .
                                '<input id="url" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
                                '</p>' .
                                '</div><!-- /.comment-meta-fields -->'
                        )
                    ),
                    'title_reply'          => esc_html__( 'Leave a Comment', 'exodus' ),
                    'cancel_reply_before'  => ' <small class="cancel-reply-link">',
                    'cancel_reply_link'    => esc_html__( 'Cancel Comment', 'exodus' ),
                    'label_submit'         => esc_html__( 'Post Comment', 'exodus' ),
                    'title_reply_before' => '<h2 id="reply-title" class="meta-title secondary">',
                    'title_reply_after' => '</h2>
                        <div id="comments-form" class="comments-area__form">',
                    'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account" class="log-out">Not You?</a>', 'exodus'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
                );
                comment_form($comments_args);
                ?>

            </div><!-- /.container -->

        </section>
    </div>
</div>