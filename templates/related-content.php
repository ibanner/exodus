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