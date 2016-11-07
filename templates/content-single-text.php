<?php
$creator = get_field( 'creator' );
$background = get_field( 'background' );
$commentary = get_field( 'commentary' );
$the_text = get_field( 'the_text' );
$alert = exodus_siddur_action_handler();
?>

<div class="article article--text">
    <h1 class="article-title"><?php the_title(); ?></h1>

    <div class="article-meta row">
        <div class="col-xs-12 col-md-8">
            <?php exodus_cpt_label(); ?> | <?php esc_html_e( 'Categories:', 'exodus'); ?> <?php echo get_the_category_list(', '); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?php exodus_siddur_button(); ?>
        </div>
    </div><!-- /.article-meta -->

    <div class="content-wrapper row">

        <div class="content text inlet col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'The Text', 'exodus'); ?></h2>

            <?php echo $the_text; ?>

            <div class="text-info">
                <h4 class="caption"><?php esc_html_e( 'Text Source', 'exodus'); ?></h4>
                <p><?php echo $creator; ?></p>
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