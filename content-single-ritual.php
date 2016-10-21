<div class="blog-post">
    <h1 class="blog-post-title"><?php the_title(); ?></h1>
    <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    } ?>
    <p>Content-Ritual FTW!</p>
    <?php the_content(); ?>

</div><!-- /.blog-post -->