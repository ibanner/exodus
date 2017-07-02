<?php
get_header();
$term = (isset($_GET['s'])) ? $_GET['s'] : ''; // Get 's' querystring param
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$alert = exodus_siddur_action_handler();
?>


<section class="wrapper--search-results">
    <h1 class="search__title"><?php exodus_grid_title(); ?></h1>
</section>

<section id="masonry-grid" class="wrapper--grid">
    <?php exodus_alm_shortcode('',$type) ?>
</section>


<?php get_footer(); ?>