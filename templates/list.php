<div class="grid-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="grid-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if ( has_post_thumbnail() ) {?>
            <div class="grid-thumbnail">
                <?php the_post_thumbnail('small'); ?>
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