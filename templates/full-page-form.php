<?php
/* Template Name: Full Page Form */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$template_part = get_post_type();
$post_name = get_post_field('post_name', get_the_ID() );
if ( ( 'my-account' === $post_name ) || ( 'share' === $post_name ) ):
    acf_form_head();
    $template_part = $post_name;
endif;

    get_header();

?>

    <div class="row">
        <div class="col-sm-12">
            <article id="<?php esc_attr_e( $post_name ); ?>" <?php post_class("wrapper--page"); ?> role="article">

                <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post();

                    get_template_part( 'templates/content', $template_part );

                endwhile; endif;
                ?>
            </article> <!-- /.page -->
        </div> <!-- /.col-sm-12 -->
    </div> <!-- /.row -->

<?php get_footer(); ?>