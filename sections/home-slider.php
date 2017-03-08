<?php
/**
 * Created by PhpStorm.
 * User: Itay
 * Date: 07/02/2017
 * Time: 18:09
 */
if ( is_front_page() && is_home() ) : ?>

    <div id="hero" class="container-fluid clearfix hero"><?php exodus_flexslider(); ?></div>

<?php endif; ?>