<?php
$more_info = get_field( 'more_info' );
$fvid = get_field('featured_video');
$alert = exodus_siddur_action_handler();
$post_types = get_the_terms( get_the_ID() , 'post_types_tax');
$post_type_label = $post_types[0]->name;
$social_option = get_option('social-single');

if ( has_shortcode( $social_option , 'sgmb') ) {
    $social = do_shortcode( $social_option );
} else {
    $social = __('Not Set' , 'exodus'); //TODO Probably some extra guidance is required
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="article-meta row">
        <h1 class="article-title"><?php the_title(); ?></h1>
        <div class="siddur-button">
            <?php exodus_siddur_button(); ?>
        </div><!-- /.siddur-button-->
    </div><!-- /.article-meta -->

    <div class="content-wrapper row section">

        <div class="content inlet">

            <?php if ( !empty($fvid) ) {
                the_field('featured_video');
            } elseif ( has_post_thumbnail() ) {?>
                <div class="grid-thumbnail">
                    <?php the_post_thumbnail('full' , ['class' => 'img-responsive responsive--full']) ?>
                </div>
            <?php } ?>

            <?php the_content(); ?>

        </div><!-- /.content inlet -->
        <h4 class="meta-title"><?php esc_html_e( 'More about this...', 'exodus'); ?></h4>
        <div class="more-info inlet">
            <?php the_field( 'more_info' ); ?>
        </div><!-- /.more-info -->
        <div class="article-cats inlet caption">
            <?php esc_html_e( 'Categories:', 'exodus'); ?> <?php echo get_the_category_list(', '); ?> | <?php printf( esc_html__( 'This %1$s article was posted on ', 'exodus' ) , $post_type_label ); // WPCS: XSS OK. ?> <?php echo get_the_date(); ?>
        </div><!-- /.article-cats -->
        <div class="article-cats inlet caption">
            <?php exodus_social_links('social-single'); ?>
        </div><!-- /.article-cats -->

    </div><!-- /.content-wrapper -->

    <div id="author-info" class="author-info row section">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</article><!-- /.article -->