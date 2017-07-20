<?php $comments_n = get_comments_number(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="article-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a>
    <a class="comments-link" href="<?php comments_link(); ?>">
        <?php
        printf( _nx( 'One Comment', '%1$s Comments', $comments_n, 'comments title in article', 'exodus' ), number_format_i18n(  $comments_n ) ); ?>
    </a></p>

    <?php if ( has_post_thumbnail() ) {?>
        <div class="row">
            <div class="col-md-4">
                <?php	the_post_thumbnail('thumbnail'); ?>
            </div>
            <div class="col-md-6">
                <?php the_excerpt(); ?>
            </div>
        </div>
    <?php } else { ?>
        <?php the_excerpt(); ?>
    <?php } ?>

</article><!-- /.article -->