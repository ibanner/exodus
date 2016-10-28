<div class="grid-item col-xs-12 col-sm-6 col-md-3">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="grid-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if ( has_post_thumbnail() ) {?>
            <div class="grid-thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
            </div>
            <div class="article-meta">
                <span class="caption"><?php esc_html_e( 'Communities', 'exodus'); ?></span>
                <ul class="the-communities">
                    <?php exodus_the_communities(); ?>
                </ul>
            </div><!-- /.article-meta -->
        <?php } else { ?>
            <div class="article-meta">
                <span class="caption"><?php esc_html_e( 'Communities', 'exodus'); ?></span>
                <ul class="the-communities">
                    <?php exodus_the_communities(); ?>
                </ul>
            </div><!-- /.article-meta -->
        <?php } ?>

    </article><!-- /.article -->
</div><!-- /.grid-item -->