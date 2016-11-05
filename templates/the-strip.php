<div class="the-strip">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 breadcrumbs">
                <?php
                /*if ( function_exists('yoast_breadcrumb') ) {
                $breadcrumbs = yoast_breadcrumb('
                <p id="breadcrumb">','</p>
                ',false);
                    var_dump($breadcrumbs);
                }*/
                if ( is_category()) {
                    // $case = 'Archive'; var_dump($case);
                    echo get_category_parents($cat, true, ' &raquo; ');
                } elseif (is_page()) {
                    // $case = 'Page'; var_dump($case);
                    ?>
                    <p class="breadcrumbs"><a href="<?php echo get_home_url(); ?>"><?php _e( ' Home ' , 'exodus' ) ?></a><?php _e( ' &raquo; ' , 'exodus' ) ?><span class="you-are-here"> <?php the_title();?></span></p>
                    <?php
                } elseif (is_singular()) {
                    // $case = 'Singular'; var_dump($case);
                    $category = get_the_category($id);
                    // var_dump($category[0]);
                    $parents = get_category_parents( $category[0], true, __( ' &raquo; ' , 'exodus' ) ); ?>
                <p class="breadcrumbs"><?php echo $parents;?><span class="you-are-here"> <?php the_title();?></span></p>
                <?php } ?>
            </div>
            <div class="col-sm-4 form"><?php get_search_form() ?></div>
        </div>
    </div>
</div>