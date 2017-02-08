<form role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="<?php echo ( is_front_page() && is_home() ) ? 'home' : 'header' ; ?>-search-wrap">
        <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'exodus' ); ?></label>
        <i id="search-icon" class="fa fa-search" aria-hidden="true"></i>
        <input type="search" placeholder="<?php echo esc_attr( 'Search…', 'exodus' ); ?>" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <input class="screen-reader-text" type="submit" id="search-submit" value="<?php echo esc_attr( 'Search', 'exodus' ); ?>" />
    </div>
</form>