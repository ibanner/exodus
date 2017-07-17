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

<div class="row">
    <div class="col-sm-12">
        <article id="post-<?php the_ID(); ?>" <?php post_class("wrapper--article"); ?> role="article">

            <h1 class="article__title"><?php the_title(); ?></h1>

            <button class="article-button article-button--fav"><i class="svg-bg svg-post_meta svg-post_meta-fav-notselected"></i><span class="sr-only">Button 1</span>
            </button>

            <div class="article__featured-image">
                <?php if ( !empty($fvid) ) {
                    exodus_acf_oembed_strip('featured_video');
                } elseif ( has_post_thumbnail() ) {
                    the_post_thumbnail('post-thumbnail' , ['class' => 'img-responsive responsive--full']);
                } ?>
            </div>

            <div class="article__content">

                <?php the_content(); ?>

            </div><!-- /.content  -->

            <?php if ( !empty($more_info) ) { ?>

                <div class="article__part article__part--more-info">
                    <h4 class="meta-title"><?php esc_html_e( 'More about this...', 'exodus'); ?></h4>
                    <?php the_field( 'more_info' ); ?>
                </div><!-- /.article__more-info -->

            <?php } ?>

            <div class="article__part article__part--meta">
                <p class="article-cats">
                    <?php esc_html_e( 'Categories:', 'exodus'); ?> <?php echo get_the_category_list(', '); ?>
                </p>
                <p class="article-timestamp">
                    <?php printf( esc_html__( 'This %1$s article was posted on ', 'exodus' ) , '<em>' . $post_type_label . '</em>' ); // WPCS: XSS OK. ?> <?php echo get_the_date(); ?>
                </p>
            </div><!-- /.article__part--meta -->

            <div class="article__part article__part--socials print-remove">
                <?php exodus_social_links('social-single'); ?>
            </div><!-- /.article__socials -->

            <div class="article__part article__part--meta-icons print-remove">

                <?php
                get_template_part('parts/article' , 'buttons');
                ?>

            </div><!-- /.article-meta -->

            <?php exodus_author_info(); ?>

        </article><!-- /.article -->
    </div>
</div><!-- /.container -->