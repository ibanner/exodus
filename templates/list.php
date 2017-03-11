<div <?php post_class('grid-item element-item col-xs-12 col-sm-6 col-md-3'); ?>>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <span class="type caption"><?php exodus_post_type_tax_label(); ?></span>
        <?php exodus_siddur_toggle(); ?>
        <a href="<?php the_permalink(); ?>">
            <div class="grid-thumbnail">
            <?php if ( get_field('featured_video') ) {
            the_field('featured_video');
        } elseif ( has_post_thumbnail() ) {
            the_post_thumbnail('full' , ['class' => 'img-responsive responsive--full']);
        } else { ?>
            <img class="grid-placeholder" src="<?php bloginfo('template_directory'); ?>/images/feat_placeholder.jpg">
        <?php } ?>
            </div>
        </a>
        <h2 class="article-title<?php if(is_sticky()) {echo ' sticky';} ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <span class="author caption"><?php the_author_posts_link(); ?></span>
        <a class="no-decor" href="<?php the_permalink(); ?>">
            <div class="grid-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </a>
        <div class="social-meta caption">
            <ul>
                <li><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></li>
                <li><?php exodus_social_links('social-loop'); ?></li>
            </ul>
        </div>
    </article><!-- /.article -->
</div><!-- /.grid-item -->