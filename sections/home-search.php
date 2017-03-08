<?php
/**
 * Created by PhpStorm.
 * User: Itay
 * Date: 07/02/2017
 * Time: 18:13
 */
if ( is_front_page() && is_home() ) : ?>

    <div id="home-search" class="container-fluid clearfix hero">
    <?php get_search_form(); ?>
    </div>

<?php endif; ?>