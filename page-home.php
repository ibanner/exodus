<?php get_header(); ?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div class="grid home row">
            <div class="grid-item col-md-6"><a href="<?php echo get_category_link('4');?>"><h1><?php echo get_the_category_by_ID('4'); ?></h1></a></div>
            <div class="grid-item col-md-6"><a href="<?php echo get_category_link('5');?>"><h1><?php echo get_the_category_by_ID('5'); ?></h1></div>
            <div class="grid-item col-md-6"><a href="<?php echo get_category_link('7');?>"><h1><?php echo get_the_category_by_ID('7'); ?></h1></div>
            <div class="grid-item col-md-6"><a href="<?php echo get_category_link('6');?>"><h1><?php echo get_the_category_by_ID('6'); ?></h1></div>
        </div>

    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>