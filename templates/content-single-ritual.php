<div id="main" class="article">
    <?php exodus_cpt_label(); ?>
    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    } ?>
    <?php the_content(); ?>
    <div class="author-info">
        <?php exodus_author_info(); ?>
    </div>

</div><!-- /.article -->