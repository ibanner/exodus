<div class="article">

    <?php exodus_cpt_label(); ?>

    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php the_date(); ?> by <a href="#author-info"><?php the_author(); ?></a></p>

    <div class="communities">
        <span class="caption"><?php esc_html_e( 'Communities', 'exodus'); ?></span>
        <ul class="the-communities">
            <li class="community"><a href="#">אשכנזים</a></li>
            <li class="community"><a href="#">ספרדים</a></li>
            <li class="community"><a href="#">טריפוליטאים</a></li>
            <li class="community"><a href="#">תימנים</a></li>
        </ul>
    </div><!-- /.communities -->

    <?php if ( has_post_thumbnail() ) { ?>

        <figure class="featured-image">
        <?php the_post_thumbnail( 'full' ); ?>
    </figure>

    <?php
    }

    exodus_get_article_fields(); ?>

    <div class="content">
        <?php the_content(); ?>
    </div><!-- /.the-content -->
    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->
<div class="related-content row">
    <h2 class="col-sm-12"><?php esc_html_e( 'More About This', 'exodus'); ?></h2>
    <div class="related-flex">
        <div class="related-wrapper col-xs-12 col-md-6">
            <div class="related related--texts">
                <h3><?php esc_html_e( 'Related Texts', 'exodus'); ?></h3>
                <?php
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'post_type' => 'text',
                    'posts_per_page' => 5,
                    'meta_key' => 'rel_ritual',
                    'meta_value' => get_the_ID()
                ));

                if($posts)
                {
                    echo '<ul>';

                    foreach($posts as $post)
                    {
                        echo '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
                    }

                    echo '</ul>';
                }
                ?>
                <a href="#"><p><?php esc_html_e( 'More Texts...', 'exodus'); ?></p></a>
            </div>
        </div><!-- /.related-texts -->
        <div class="col-xs-12 col-md-6">
            <div class="related related--rituals">
            <h3><?php esc_html_e( 'Related Rituals', 'exodus'); ?></h3>
            <?php
            $event = get_field( 'event' );
            $posts = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'ritual',
                'posts_per_page' => 5,
                'meta_key' => 'event',
                'meta_value' => $event
            ));

            if($posts)
            {
                echo '<ul>';

                foreach($posts as $post)
                {
                    echo '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
                }

                echo '</ul>';
            }

            ?>
            <a href="#"><p><?php esc_html_e( 'More Rituals...', 'exodus'); ?></p></a>
            </div><!-- /.related-rituals -->
        </div>
    </div><!-- /.related-flex -->
</div><!-- /.related-content -->