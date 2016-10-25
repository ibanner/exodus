<?php
$text_source = get_field( 'text_source' );
$background = get_field( 'background' );
$commentary = get_field( 'commentary' );
?>

<div class="article article--text">
    <h1 class="article-title"><?php the_title(); ?></h1>
    <!--<p class="article-meta"><?php /*/*the_date(); */ /* esc_html_e( 'Posted by', 'exodus'); */?> <a href="#author-info"><?php /*the_author(); */?></a></p>-->

    <div class="cpt-meta">
        <span class="caption"><?php exodus_cpt_label(); ?> | <?php esc_html_e( 'Communities', 'exodus'); ?></span>
        <ul class="the-communities">
            <?php exodus_the_communities(); ?>
        </ul>
    </div><!-- /.cpt-meta -->

    <div class="content-wrapper row">

        <div class="content text inlet col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'The Text', 'exodus'); ?></h2>

            <?php the_content(); ?>

            <div class="text-info">
                <h4 class="caption"><?php esc_html_e( 'Text Source', 'exodus'); ?></h4>
                <p><?php echo $text_source; ?></p>
            </div>
        </div><!-- /.content text inlet -->

        <div class="text-commentary col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'Commentary', 'exodus'); ?></h2>
            <?php echo $commentary; ?>
        </div><!-- /.text-commentary -->

        <div class="text-background col-sm-12">
            <h2><?php esc_html_e( 'Text Background', 'exodus'); ?></h2>
            <?php echo $background; ?>
        </div><!-- /.text-background -->

    </div><!-- /.content-wrapper -->

    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->