<div id="main" class="article">
    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    } ?>
    <p>Content-Event FTW!</p>
    <?php the_content(); ?>

</div><!-- /.article -->