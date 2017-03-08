<?php
get_header();
?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="404 page <?php echo post_class(); ?>">
                <h1 class="page-title row"><?php the_title(); ?></h1>

                <div class="jumbotron">

                    <?php
                        echo '<div class="alert alert-warning text-center" role="alert">';
                        echo '<p class="lead h1">' . __("Page not found.", 'exodus') . '</p>';
                        echo __("It's not you, it's us.", 'exodus') . ' <a href="' . site_url() . '" class="alert-link">' . __("Here, grab a link to the homepage", 'exodus') . '</a>.';
                        echo '</div>';
                    ?>
                </div>
            </div> <!-- /.page -->
        </div> <!-- /.main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>