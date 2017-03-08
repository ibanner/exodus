<div class="article">
    <h2 class="article-title"><?php the_title(); ?></h2>
    <p class="article-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    } ?>
    <?php the_content(); ?>

</div><!-- /.article -->