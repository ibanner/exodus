<?php
$text_source = get_field( 'text_source' );
$background = get_field( 'background' );
$commentary = get_field( 'commentary' );
?>

<div id="main" class="article">
    <?php exodus_cpt_label(); ?>
    <h1 class="article-title"><?php the_title(); ?></h1>
    <p class="article-meta"><?php the_date(); ?> by <a href="#author-info"><?php the_author(); ?></a></p>
    <div class="text-desc content row">
        <div class="the-text col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'The Text', 'exodus'); ?></h2>
            <?php the_content(); ?>
            <div class="text-source">
                <h4 class="caption"><?php esc_html_e( 'Text Source', 'exodus'); ?></h4>
                <p><?php echo $text_source; ?></p>
            </div>
        </div><!-- /.the-text .content -->
        <div class="text-background col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'Text Background', 'exodus'); ?></h2>
            <?php echo $background; ?>
        </div><!-- /.text-background -->
    </div><!-- /.the-text -->
    <div class="text-commentary">
        <h2><?php esc_html_e( 'Commentary', 'exodus'); ?></h2>
        <?php echo $commentary; ?>
    </div><!-- /.text-commentary -->
    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->