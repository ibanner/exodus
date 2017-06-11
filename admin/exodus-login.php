<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 05/06/2017
 * Time: 12:33
 */

/*-------------------------------------------------------------------------------
	CUSTOM LOGIN PAGE
-------------------------------------------------------------------------------*/

function exodus_login_styles() { ?>
    <style type="text/css"> #login h1 a, .login h1 a { background-image: none; width: 100%; padding-bottom: 30px; font-size: 3rem; text-indent: 0; } body.login { background: #c8ddf0; } .login label { color: #fff  !important; } .login form { background: #03A9F4 !important; } </style>
<?php }
add_action( 'login_enqueue_scripts', 'exodus_login_styles' );