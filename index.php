<?php
get_header();
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$ids = exodus_alm_query_ids('index');
$alert = exodus_siddur_action_handler();
?>

<section id="masonry-grid" class="wrapper--grid">
    <?php exodus_alm_shortcode($ids,$type); ?>
</section>

<?php get_footer(); ?>