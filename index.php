<?php
get_header();

$ids = exodus_alm_query_ids('index');
$alert = exodus_siddur_action_handler();
?>

<section id="masonry-grid" class="wrapper--grid">
    <?php exodus_alm_shortcode($ids,''); ?>
</section>

<?php get_footer(); ?>