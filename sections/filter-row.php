<h2 class="screen-reader-text"><?php esc_html_e( "Article Filters" , 'exodus' ); ?></h2>
<div class="filter-ui row">
    <?php exodus_post_types_tax_droplist_ui($type); ?>
    <?php exodus_article_count(); ?>
</div>