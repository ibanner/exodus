<div id="main" class="article">
<?php exodus_cpt_label(); ?>
    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php the_date(); ?> by <a href="#author-info"><?php the_author(); ?></a></p>
<?php if ( has_post_thumbnail() ) { ?>
    <figure class="featured-image">
        <?php the_post_thumbnail( 'full' ); ?>
    </figure>
<?php
    }

    exodus_get_article_fields();

?>
    <div class="content">
        <?php the_content(); ?>
    </div><!-- /.the-content -->
    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->