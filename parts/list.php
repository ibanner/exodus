<!-- This should be pasted in the ALM admin settings -->

<li class="grid-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <div class="grid-item__thumbnail">
            <a href="<?php the_permalink(); ?>" role="link">

            <?php if ( get_field('featured_video') ) {

                exodus_acf_oembed_strip('featured_video');

            } elseif ( has_post_thumbnail() ) {
                the_post_thumbnail('medium' , array('title' => get_the_title(), 'alt' => get_the_title(), 'class' => 'img-responsive responsive--full'));
            } else { ?>
                <img class="grid-placeholder img-responsive responsive--full" src="<?php bloginfo('template_directory'); ?>/images/feat_placeholder.jpg">
            <?php } ?>
            </a>
        </div>

        <div class="grid-item__details">
            <?php exodus_post_type_tax_label(); ?>
            <?php exodus_siddur_toggle(); ?>
            <h2 class="article-title<?php if (is_sticky()) {
                echo ' sticky';
            } ?>"><a href="<?php the_permalink(); ?>" class="grid-item__title-link"><?php the_title(); ?></a></h2>
            <div class="grid-item__author">
                <?php exodus_author_byline(); ?>
            </div>
            <a class="no-decor" href="<?php the_permalink(); ?>">
                <div class="grid-item__excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </a>

        </div>

    </article><!-- /.article -->
</li>