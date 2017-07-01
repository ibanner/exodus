<?php
    acf_form_head();
    get_header();
?>

    <div class="row">
        <div id="main" class="col-sm-12 blog-main single-column">
            <div class="page <?php echo post_class(); ?>">
                <h1 class="page-title row"><?php the_title(); ?></h1>

                <div class="page-content">
                    <?php the_content(); ?>
                </div>

                <?php while ( have_posts() ) : the_post(); ?>

                <div class="share-form jumbotron">
                    <?php acf_form(array(

                        'id' => 'share-post',
                        'post_id' => 'new_post',
                        'new_post' => array(
                            'post_type'     => 'post',
                            'post_status'   => 'pending'
                        ),
                        'post_title' => true,
                        'post_content' => true,
                        'submit_value' => __("Submit for review", 'exodus'),
                        'updated_message' => __("<b>Success!</b> Your article was submitted successfully and will be reviewed shortly.", 'exodus'),
                        // 'honeypot' => true

                    )); ?>
                </div>

                <?php endwhile; ?>

            </div> <!-- /.page -->
        </div> <!-- /.main -->
    </div> <!-- /.row -->

<?php get_footer(); ?>