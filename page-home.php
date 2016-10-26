<?php get_header(); ?>

<div class="row">
    <div id="main" class="col-sm-12 blog-main single-column">
        <div class="search-box">
            <?php get_search_form(); ?>
        </div>
        <div class="category tiles">
            <div class="col-md-6 col-xs-12">
                <div class="tile"><a href="<?php echo get_category_link('4');?>">
                        <h1><?php echo get_the_category_by_ID('4'); ?></h1></a></div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="tile"><a href="<?php echo get_category_link('5');?>">
                        <h1><?php echo get_the_category_by_ID('5'); ?></h1></a></div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="tile"><a href="<?php echo get_category_link('7'); ?>">
                        <h1><?php echo get_the_category_by_ID('7'); ?></h1></a></div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="tile"><a href="<?php echo get_category_link('6'); ?>">
                        <h1><?php echo get_the_category_by_ID('6'); ?></h1></a></div>
            </div>
        </div>
    </div> <!-- /.main -->
</div> <!-- /.row -->

<?php get_footer(); ?>