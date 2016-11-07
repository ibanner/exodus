<?php
$fvid = get_field('featured_video');
$social_option = get_option('social-loop');

if ( has_shortcode( $social_option , 'sgmb') ) {
    $social = do_shortcode( $social_option );
} else {
    $social = __('Not Set' , 'exodus'); //TODO Probably some extra guidance is required
}
?>

<div <?php post_class('grid-item element-item col-xs-12 col-sm-6 col-md-3'); ?>>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <span class="type caption"><?php exodus_cpt_label(); ?></span>
        <i id="siddur-toggle" class="fa fa-bookmark-o" aria-hidden="true"></i>
        <?php if ( !empty($fvid) ) {
            the_field('featured_video');
        } elseif ( has_post_thumbnail() ) {?>
            <div class="grid-thumbnail">
                <?php the_post_thumbnail('full' , ['class' => 'img-responsive responsive--full']) ?>
            </div>
        <?php } ?>
        <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="grid-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <div class="article-meta caption">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) { ?>
            <span class="caption-label"><?php esc_html_e( 'Categories:', 'exodus'); ?></span>
            <ul class="the-categories">
                <?php
                $cat_count = count($categories);
                $i = 1;
                foreach($categories as $category) {
                    echo '<li class="category caption"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( get_cat_name( $category->term_id ) ) . '</a></li>';
                    if ($i == 3 && $i < $cat_count) {
                        echo '<li class="category caption more"> [...]</li>';
                        break;
                    }
                    $i++;
                }
            }
                ?>
            </ul>
        </div><!-- /.article-meta -->
        <div class="social-meta caption">
            <ul>
                <li><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></li>
                <li><?php echo $social; ?></li>
            </ul>
        </div>
    </article><!-- /.article -->
</div><!-- /.grid-item -->