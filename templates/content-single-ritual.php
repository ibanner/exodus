<?php
$procedure = get_field( 'procedure' );
$background = get_field( 'background' );
$participants = get_field( 'participants' );
$location = get_field( 'location' );
$timing = get_field( 'timing' );
?>

<div class="article article--ritual">

    <h1 class="article-title"><?php the_title(); ?></h1>

    <div class="cpt-meta">
        <span class="caption"><?php exodus_cpt_label(); ?> | <?php esc_html_e( 'Communities', 'exodus'); ?></span>
        <ul class="the-communities">
            <?php exodus_the_communities(); ?>
        </ul>
    </div><!-- /.cpt-meta -->

    <div class="content-wrapper row">

        <div class="content ritual inlet col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'Scenario', 'exodus'); ?></h2>
            <?php echo $procedure; ?>
            <div class="text-info">
                <h4 class="participants"><?php esc_html_e( 'The Participants', 'exodus'); ?></h4>
                <p><?php echo $participants; ?></p>
                <h4 class="location"><?php esc_html_e( 'Location', 'exodus'); ?></h4>
                <p><?php echo $location; ?></p>
                <h4 class="timing"><?php esc_html_e( 'Timing', 'exodus'); ?></h4>
                <p><?php echo $timing; ?></p>
            </div><!-- /.ritual-info -->
        </div><!-- /.content ritual inlet -->

        <div class="ritual-background  col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'Text Background', 'exodus'); ?></h2>
            <?php echo $background; ?>
        </div><!-- /.ritual-background -->

    </div><!-- /.content-wrapper -->

    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->
<?php // get_template_part( 'templates/related-content'); ?>