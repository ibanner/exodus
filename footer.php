</section><!-- /#content -->
</div><!-- /.container -->


<footer class="page-foot">
    <div class="container">
        <div class="page-foot__colophon col-md-6"><?php esc_html_e('Site by' , 'exodus' ); ?> <a href="http://ibanner.co.il" target="_blank" rel="nofollow"><?php esc_html_e('The Contechnician' , 'exodus' ); ?></a></div>
        <?php
        wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'page-foot__nav-menu secondary col-md-6 hidden-xs hidden-sm' ) );
        ?>
    </div>
</footer>


<?php wp_footer();?>
</body>
</html>