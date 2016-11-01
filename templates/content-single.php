<?php
$fvid = get_field('featured_video');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php esc_html_e( 'Posted by', 'exodus' ); ?> <a href="#"><?php the_author(); ?></a> || <?php the_date(); ?></p>
    <?php if ( !empty($fvid) ) {
        the_field('featured_video');
    } elseif ( has_post_thumbnail() ) {?>
        <div class="grid-thumbnail">
            <?php the_post_thumbnail('large' , ['class' => 'img-responsive responsive--full']) ?>
        </div>
    <?php } ?>
    <div class="article-content">
        <?php the_content(); ?>
    </div>
    <div class="author-info">
        <?php exodus_author_info(); ?>
    </div>
</article><!-- /.article -->