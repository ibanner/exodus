<?php
$creator = get_field( 'creator' );
$background = get_field( 'background' );
$commentary = get_field( 'commentary' );
$the_text = get_field( 'the_text' );
?>

<div class="article article--text">
    <h1 class="article-title"><?php the_title(); ?></h1>
    <!--<p class="article-meta"><?php /*/*the_date(); */ /* esc_html_e( 'Posted by', 'exodus'); */?> <a href="#author-info"><?php /*the_author(); */?></a></p>-->

    <div class="cpt-meta">
        <span class="caption"><?php exodus_cpt_label(); ?> | <?php esc_html_e( 'Categories:', 'exodus'); ?></span>
        <ul class="the-categories">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) { ?>
            <ul class="the-categories">
                <?php
                $cat_count = count($categories);
                $i = 1;
                foreach($categories as $category) {
                    echo '<li class="category caption"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( get_cat_name( $category->term_id ) ) . '</a></li>';
                    if ($i == 6 && $i < $cat_count) {
                        echo '<li class="category caption more"> [...]</li>';
                        break;
                    }
                    $i++;
                }
                }
            ?>
        </ul>
    </div><!-- /.cpt-meta -->

    <div class="content-wrapper row">

        <div class="content text inlet col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'The Text', 'exodus'); ?></h2>

            <?php echo $the_text; ?>

            <div class="text-info">
                <h4 class="caption"><?php esc_html_e( 'Text Source', 'exodus'); ?></h4>
                <p><?php echo $creator; ?></p>
            </div>
        </div><!-- /.content text inlet -->

        <div class="text-commentary col-xs-12 col-md-6">
            <h2><?php esc_html_e( 'Commentary', 'exodus'); ?></h2>
            <?php echo $commentary; ?>
        </div><!-- /.text-commentary -->

        <div class="text-background col-sm-12">
            <h2><?php esc_html_e( 'Text Background', 'exodus'); ?></h2>
            <?php echo $background; ?>
        </div><!-- /.text-background -->

    </div><!-- /.content-wrapper -->

    <div id="author-info" class="author-info">
        <?php exodus_author_info(); ?>
    </div><!-- /.author-info -->

</div><!-- /.article -->