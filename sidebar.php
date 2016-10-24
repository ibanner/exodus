<?php
if ( ! is_active_sidebar( 'articles' ) ) {
return;
}
?>
<div class="col-sm-3 blog-sidebar">
    <?php dynamic_sidebar( 'articles' ); ?>
    <!--<div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p><?php /*echo get_bloginfo ( 'description' ); */?> </p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <?php /*wp_get_archives('type=monthly'); */?>
        </ol>

    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="<?php /*echo get_option('youtube'); */?>" target="_blank" rel="nofollow">YouTube</a></li>
            <li><a href="https://twitter.com/<?php /*echo get_option('twitter'); */?> target="_blank" rel="nofollow"">Twitter</a></li>
            <li><a href="<?php /*echo get_option('facebook'); */?> target="_blank" rel="nofollow"">Facebook</a></li>
        </ol>
    </div>-->
</div><!-- /.blog-sidebar -->