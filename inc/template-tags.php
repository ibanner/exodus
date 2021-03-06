<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kol_Ehad
 */

/******************************************************/

if ( ! function_exists( 'exodus_the_default_logo' ) ) :

    /**
     * Prints the default logo image
     */

    function exodus_the_default_logo($variant) {

        $logo_class = 'site-logo';
        $logo_class.= (!empty($variant)) ? '--' . $variant : '';

        $logo_url = get_stylesheet_directory_uri() . '/images/vectors/logo.svg';
        echo '<img src="' . $logo_url . '" alt="' . get_bloginfo( 'name' ) . '" class="' . $logo_class . '">';

    }

endif;

/**
 * Displays the session info, per context.
 *
 * @Since:   2.0.0
 *
 * @param int $avatar_size  Optional. Size in px of the avatar for display. defaults to 32.
 *
 */

if ( ! function_exists( 'exodus_session_info' ) ):

    function exodus_session_info($avatar_size, $class = '') {

        echo '<div class="session-info  ' . $class . '">';

            if ( ! is_user_logged_in() ) {

                $login_url = wp_login_url();
                $signup_url = $login_url . '?action=register';
                $login_link = '<a href="'. esc_url($login_url) . '" role="link">' . __('Log In', 'exodus') . '</a>';
                $signup_link = '<a href="'. esc_url($signup_url) . '" role="link">' . __('Sign Up', 'exodus') . '</a>';

                echo '<p class="anon">' . sprintf('%1$s / %2$s', $login_link, $signup_link) . exodus_default_user_avatar($avatar_size) . '</p>';

            } else {

                $target = get_page_by_path('my-account');
                $current_user = wp_get_current_user();
                $account_link = '<a href="' . get_page_link($target->ID) . '" role="link">' . ucwords($current_user->display_name) .'</a>';

                echo '<p class="logged-in">' . $account_link . exodus_current_user_avatar($avatar_size) . '</p>';
            }

        echo '</div><!-- .session-info-->';

    }

endif;

/**
 * Echoes a link to "my-account" page
 *
 * @Since:   2.0.0
 *
 */

if ( ! function_exists( 'exodus_my_account_link' ) ):

    function exodus_my_account_link($text = 'name') {

        if ( is_user_logged_in() ) {

            $target = get_page_by_path('my-account');

            switch ($text) {
                case 'name':
                    $current_user = wp_get_current_user();
                    $link = ucwords($current_user->display_name);
                    break;
                default:
                    $link = __('My Account', 'exodus');
            }

            echo '<a href="' . get_page_link($target->ID) . '" role="link">' . $link .'</a>';

        }
    }

endif;

/**
 * Echoes the current user's avatar.
 *
 * @Since:   2.0.0
 *
 * @param   int $size   Sets the dimensions for the avatar in px. defaults to '32'.
 */

if ( ! function_exists( 'exodus_current_user_avatar' ) ):

    function exodus_current_user_avatar($size = 32) {

        if ( is_user_logged_in() ) {

            // if a user is logged-in, show their avatar. if no avatar is available, show the generic avatar
            $default = get_template_directory_uri() . '/images/vectors/menu-profile.svg';
            $args = array( 'class' => 'current-user__avatar  img-round', );
            $avatar = get_avatar( get_current_user_id(), $size , esc_url( $default ), esc_attr( get_current_user() ) , $args );
            echo $avatar;

        }
    }

endif;

/**
 * Echoes the default user avatar.
 *
 * @Since:   2.0.0
 *
 * @param   int $size   Sets the dimensions for the avatar in px. defaults to '32'.
 */

if ( ! function_exists( 'exodus_default_user_avatar' ) ):

    function exodus_default_user_avatar($size = 32) {

        $default = get_template_directory_uri() . '/images/vectors/menu-profile.svg';
        echo '<img src="' . $default . '" height="' . $size . '" alt="' . __( "Default User Avatar" , "exodus" ) . '" class="current-user__avatar  current-user__avatar--default  img-round" role="img">';

    }

endif;

/******************************************************/

if ( ! function_exists( 'exodus_author_byline' ) ) :

    /**
     * Prints HTML with author avatar and name (clickable).
     */

function exodus_author_byline() {
    $author_id = get_the_author_meta( 'ID' );
    $args = array( 'class' => 'author-byline__avatar  img-round', );
    $avatar = get_avatar( $author_id, 24 , '' , esc_attr( get_the_author() ) , $args );
    echo '<div class="author-byline">';
        echo $avatar;
        echo '<a class="author-byline__name url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'; // WPCS: XSS OK.
    echo '</div>';
}

endif;

/******************************************************/

if ( ! function_exists( 'exodus_author_info' ) ) :

    /**
     * Prints HTML with meta information on the current author.
     */

function exodus_author_info($size = '60') {
    $author_id = get_the_author_meta( 'ID' );
    $author_desc = get_the_author_meta( 'description', $author_id);
    $args = array( 'class' => 'author-info__avatar  img-round', );
    $avatar = get_avatar( $author_id, $size , '' , esc_attr( get_the_author() ) , $args );

    if (empty($author_desc)) {
        $udata = get_userdata($author_id);
        $author_registered = date('F Y', strtotime($udata->user_registered));
        $default_desc = __('This author joined KEM on %1$s, and shared %2$d articles with the community. WTG!', 'exodus');
        $author_post_count = count_user_posts( $author_id );
        $author_desc = sprintf($default_desc, $author_registered, $author_post_count);
    }

    echo '<div id="author-info" class="article__part article__part--author-info">';
        echo $avatar;
        echo '<div class="author-info__details">';
            echo '<div class="author-info__name author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></div>'; // WPCS: XSS OK.
            echo '<div class="author-info__description">' . $author_desc . '</div>';
        echo '</div><!-- /.author-info__details -->';
    echo '</div><!-- /.author-info -->';

}

endif;

/******************************************************/

if ( ! function_exists( 'exodus_post_type_tax_label' ) ) :

    /**
     * Prints a translatable Post Type Tax term label
     */

    function exodus_post_type_tax_label($case) {
        $post_type_term = get_the_terms( get_the_ID() ,'post_types_tax');
        $term_page = get_term_link( $post_type_term[0] ,'post_types_tax');
        $filtered_cat_page = "?type=" . $post_type_term[0]->slug;
        $target = ( 'category' == $case ? $filtered_cat_page : $term_page );

        if ($post_type_term) {
            echo '<a href="' . $target . '" class="type-label  type-label--' . esc_attr($post_type_term[0]->slug) . '">' . $post_type_term[0]->name . '</a>';
        } elseif (current_user_can('edit_posts')) {
            edit_post_link( __( "Type N/A" , "exodus" ), null , '</a>' , null , 'type-label  type-label--none' );
        }
    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_post_type_tax_droplist_ui' ) ) :

    /**
     * Prints a translatable Post Type Tax droplist
     */

    function exodus_post_types_tax_droplist_ui($active) {
        $active_type = '';
        $active_type_label = __( "All Types" , "exodus" );
        if ($active) {
            $active_type = get_terms( array(
                'taxonomy' => 'post_types_tax',
                'slug' => $active,
            ) );
            $active_type_label = $active_type[0]->name;
        }
        $terms = get_terms( array(
            'taxonomy' => 'post_types_tax',
            'hide_empty' => true,
        ) );
        if ($terms) {
            echo '<div class="btn-group button-group filter-group type" data-filter-group="type">';
            echo '<button type="button" class="input input--select btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="current-filter-type">' . $active_type_label . '</span>' . exodus_get_icon('select_arrow', 'down', 'icon' , esc_attr('Arrow - Down', 'exodus')) . '</button>';
            echo '<ul class="dropdown-menu post-types-tax wrapper--tooltip">';
            $url = esc_url(add_query_arg('type',false));
            echo '<li><a href="' . $url . '"';
                if (!$active) {echo 'class="active" aria-pressed="true" ';}
                else {echo 'aria-pressed="false" ';}
            echo 'title="' . esc_html__( "All Types" , "exodus" ) . '">' . esc_html__( "All Types" , "exodus" ) . '</a></li>';
            echo '<li role="separator" class="divider"></li>';
            foreach ($terms as $term) {
                $url = esc_url(add_query_arg('type',$term->slug));
                echo '<li><a href="' . $url . '"';
                    if ($active == $term->slug) {echo 'class="active" aria-pressed="true" ';}
                    else {echo 'aria-pressed="false" ';}
                    echo 'title="' . esc_html__($term->name) . '">' . esc_html__($term->name) . '</a></li>';
            }
            echo '</ul></div><!-- ul.dropdown-menu -->';
        } else {
            echo 'No Terms here!';
        }
    }
endif;

/******************************************************/

function exodus_get_active_type_slug() {

    $active_type_slug = '';
    if ( is_tax('post_types_tax') ) {
        $active_type_slug = get_queried_object()->slug;

    } elseif ( isset($_GET['type']) ) {
        $active_type_slug = $_GET['type'];

    }

    return $active_type_slug;
}

/******************************************************/

function exodus_filter_by_type($active) {

    $exclude_terms = get_field('exclude_post_types', 'option');

    $post_types = get_terms( array(
        'taxonomy' => 'post_types_tax',
        'exclude' => $exclude_terms,
        'hide_empty' => true,
    ) );

    $all_types_slug = 'all-types';
    $all_types_label = esc_html__( "All Types" , "exodus" );
    $is_all_types = true;

    $active_type_slug = $all_types_slug;
    $active_type_label = $all_types_label;

    if ( is_tax('post_types_tax') ) {

        $active_type_slug = get_queried_object()->slug;
        $active_type_label = get_queried_object()->name;
        $is_all_types = false;

    } elseif ( isset($_GET['type']) ) {

        $active_type_slug = $_GET['type'];

        $active_type = get_terms( array(
            'taxonomy' => 'post_types_tax',
            'slug' => $active,
        ) );

        $active_type_label = $active_type[0]->name;
        $is_all_types = false;

    }

    $remove_filter_url = exodus_get_remove_type_filter_url();

    echo '<div class="btn-group filter-group type">' .
        '<button type="submit" class="btn input input--split-select input--split-select-label">' . $active_type_label . '</button>' .
        '<button type="button" class="btn input input--split-select input--split-select-arrow dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            '<span class="caret"></span>' .
            '<span class="sr-only">' . esc_html__('Toggle Dropdown', 'exodus') . '</span>' .
        '</button>' .
        '<ul class="dropdown-menu post-types-tax wrapper--tooltip">';

    echo '<li class="all-types ' . ( $is_all_types ? 'active' : '' ) . '"><a href="' . $remove_filter_url . '">' . $all_types_label . '</a></li>';
    echo '<li role="separator" class="divider"></li>';

    foreach ($post_types as $post_type) {

        $target_url = exodus_get_type_filter_url($post_type);

        echo '<li class="' . $post_type->slug . '"><a href="' . $target_url . '">' . $post_type->name . '</a></li>';
    }

    echo '</ul></div>';

}

/******************************************************/

function exodus_get_type_filter_url($post_type) {

    $s = isset($_GET['s']) ? $_GET['s'] : false;

    if ( is_tax('post_types_tax') || is_home() ) {
        $target_url = get_term_link( $post_type->slug, 'post_types_tax' );
        $target_url = add_query_arg('s', $s, $target_url);
    } else {
        $target_url = add_query_arg( array( 's' => $s, 'type' => $post_type->slug, ) );
    }

    return $target_url;
}

/******************************************************/

function exodus_get_remove_type_filter_url() {

    $s = isset($_GET['s']) ? $_GET['s'] : false;

    if ( is_tax('post_types_tax') ) {
        $target_url = add_query_arg('s', $s, site_url());
    } else {
        $target_url = add_query_arg( array( 's' => $s, 'type' => false, ) );
    }

    return $target_url;
}

/******************************************************/

function exodus_maybe_search_query() {

    $query = is_search() ? get_search_query() : '';

    return $query;
}

/******************************************************/

if ( ! function_exists( 'exodus_article_count' )) :

    /**
     * Prints the number of posts found for the current query
     */

    function exodus_article_count() {
    echo '<span class="article-count caption hidden-xs">';
        $cat = is_category() ? get_queried_object_id() : '0';
        $args = array(
            'numberposts'   => '-1',
            'category'      => $cat,
        );
        $post_count = sizeof(get_posts($args));
        printf( esc_html__('Found %1$s articles', 'exodus'), $post_count );
    echo '</span>';
    }
endif;

/******************************************************/

if ( ! function_exists( 'exodus_posted_on' ) ) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */

    function exodus_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            esc_html_x( 'Posted on %s', 'post date', "exodus" ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x( 'by %s', 'post author', "exodus" ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        /* Display the author's avatar if he has Gravatar */
        $author_id = get_the_author_meta( 'ID' );
        echo '<div class="author-avatar">' . get_avatar($author_id) . '</div>';

        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
    endif;

/******************************************************/

if ( ! function_exists( 'exodus_entry_footer' ) ) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */

    function exodus_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', "exodus" ) );
            if ( $categories_list && exodus_categorized_blog() ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', "exodus" ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ', ', "exodus" ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', "exodus" ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', "exodus" ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', "exodus" ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }

endif;

/******************************************************/

if ( ! function_exists( 'exodus_categorized_blog' ) ) :

    /**
     * Returns true if a blog has more than 1 category.
     *
     * @return bool
     */

    function exodus_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'exodus_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'exodus_categories', $all_the_cool_cats );
        }

        if ( $all_the_cool_cats > 1 ) {
            // This blog has more than 1 category so exodus_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so exodus_categorized_blog should return false.
            return false;
        }
    }

endif;

/******************************************************/

if ( ! function_exists( 'exodus_category_transient_flusher' ) ) :

    /**
     * Flush out the transients used in exodus_categorized_blog.
     */

    function exodus_category_transient_flusher() {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Like, beat it. Dig?
        delete_transient( 'exodus_categories' );
    }
    add_action( 'edit_category', 'exodus_category_transient_flusher' );
    add_action( 'save_post',     'exodus_category_transient_flusher' );

endif;

/******************************************************/

if ( ! function_exists( 'exodus_get_posts_navigation' ) ) :

    /**
     * Doc
     */

    function exodus_get_posts_navigation( $args = array() ) {
        $navigation = '';

        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
            $args = wp_parse_args( $args, array(
                'prev_text'          => __( 'Older' , "exodus" ),
                'next_text'          => __( 'Newer' , "exodus" ),
                'screen_reader_text' => __( 'Posts navigation' , "exodus" ),
            ) );

            $next_link = get_previous_posts_link( $args['next_text'] );
            $prev_link = get_next_posts_link( $args['prev_text'] );

            if ( $prev_link ) {
                $navigation .= '<li class="previous">' . $prev_link . '</li>';
            }

            if ( $next_link ) {
                $navigation .= '<li class="next">' . $next_link . '</li>';
            }

            $navigation = exodus_navigation_markup( $navigation, 'posts-navigation', $args['screen_reader_text'] );
        }

        return $navigation;
    }

    /**
     * Displays the navigation to next/previous set of posts, when applicable.
     *
     * @since 4.1.0
     *
     * @param array $args Optional. See get_the_posts_navigation() for available arguments.
     *                    Default empty array.
     */
    function exodus_posts_navigation( $args = array() ) {
        echo exodus_get_posts_navigation( $args );
    }

endif;

/******************************************************/

if ( ! function_exists( 'exodus_navigation_markup' ) ) :

    /**
     * Wraps passed links in navigational markup.
     *
     * @since 4.1.0
     * @access private
     *
     * @param string $links              Navigational links.
     * @param string $class              Optional. Custom class for nav element. Default: 'posts-navigation'.
     * @param string $screen_reader_text Optional. Screen reader text for nav element. Default: 'Posts navigation'.
     * @return string Navigation template tag.
     */

    function exodus_navigation_markup( $links, $class = 'posts-navigation', $screen_reader_text = '' ) {
        if ( empty( $screen_reader_text ) ) {
            $screen_reader_text = __( 'Posts navigation' );
        }

        $template = '
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<ul class="pager">%3$s</ul>
	</nav>';

        /**
         * Filters the navigation markup template.
         *
         * Note: The filtered template HTML must contain specifiers for the navigation
         * class (%1$s), the screen-reader-text value (%2$s), and placement of the
         * navigation links (%3$s):
         *
         *     <nav class="navigation %1$s" role="navigation">
         *         <h2 class="screen-reader-text">%2$s</h2>
         *         <div class="nav-links">%3$s</div>
         *     </nav>
         *
         * @since 4.4.0
         *
         * @param string $template The default template.
         * @param string $class    The class passed by the calling function.
         * @return string Navigation template.
         */
        $template = apply_filters( 'navigation_markup_template', $template, $class );

        return sprintf( $template, sanitize_html_class( $class ), esc_html( $screen_reader_text ), $links );
    }

endif;

/**
 * Renders the search field markup for the given format
 *
 * @since 2.0.0
 *
 * @param $format    string                 the format to render ('full'|'mini')
 * @param $type      string (optional)      slug of the active type to filter by
 *
 * @return string   The search field HTML markup
 */


if ( ! function_exists( 'exodus_render_search_form' ) ) :

    function exodus_render_search_form($format,$type) {

        $home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
        $value = exodus_maybe_search_query();
        $placeholder = esc_attr__( 'Pick a Jewish Brain' , 'exodus' );
        $icon = exodus_get_icon('search', 'large', 'img' , esc_attr('Search Icon', 'exodus'));

        switch ($format) {
            case 'full':
                $tag = 'section';
                $tag_class = 'search';
                $form_class = 'header';
                break;
            default:
                $tag = 'div';
                $tag_class = 'mini-search';
                $form_class = 'mini-header';
        }

        echo '<' . $tag .' class="page-head__' . $tag_class .'" role="search">' .
        '<form id="header-search" class="search-form search-form--' . $form_class .'" action="' . $home_url .'" method="get" _lpchecked="1">'.
            '<div class="wrapper--' . $tag_class .'">' .
                '<input type="text" class="input input--search" id="s" name="s" data-swplive="true" data-swpengine="live_search" placeholder="' . $placeholder .'" value="' . $value .'">' .
                '<div class="btn btn-link input__search-icon">' . $icon .'</div>';
                if ('' !== $type ) :
                echo '<input type="hidden" id="type-listener" class="type-listener hidden" name="type" value="' . $type .'">';
                endif;
            echo '</div>';
            exodus_filter_by_type($type);
        echo '</form>' .
    '</' . $tag .'>';
    }

endif;


/**
 * Prints the social sharing buttons, meant to share the current page.
 * Currently includes Facebook, Twitter, Pinterest and sharing via e-mail.
 *
 * @since 2.0.0
 *
 * @return string               The social buttons markup, in <li> elements.
 */



if ( ! function_exists( 'exodus_sharing_buttons' ) ) :

    function exodus_sharing_buttons() {
        $email = array(
            'subject'   => esc_html__('An interesting article from Kolehad.org', 'exodus'),
            'body'      => esc_html__('Thought you might be interested in this:', 'exodus'),
        );

        $platforms = array(
            array(
                'slug'  => 'facebook',
                'label' =>  esc_html__('Share this on Facebook', 'exodus'),
                'url'   => 'https://facebook.com/sharer/sharer.php?u=',
            ),
            array(
                'slug'  => 'twitter',
                'label' =>  esc_html__('Share this on Twitter', 'exodus'),
                'url'   => 'https://twitter.com/share?url='
            ),
            array(
                'slug'  => 'pinterest',
                'label' =>  esc_html__('Share this on Pinterest', 'exodus'),
                'url'   => 'https://pinterest.com/pin/create/bookmarklet/?url='
            ),
            array(
                'slug'  => 'email',
                'label' =>  esc_html__('Share this via e-mail', 'exodus'),
                'url'   => 'mailto:?subject=' . $email['subject'] . '&body=' . $email['body'] . '%0A',
            ),
        );

        foreach ($platforms as $platform) {
            echo '<li>
                <a class="sharing-button" href="'. $platform['url'] . esc_url(get_the_permalink()) . '" target="_blank"><i class="svg-bg svg-sharing svg-sharing-' . $platform['slug'] . '"></i><span class="sr-only">' . $platform['label'] . '</a>
            </li>';
        }
    }

endif;

/**
 * Gets the SVG file contents for an icon, button or logo file.
 *
 * @since 2.0.0
 *
 * @param string $subset        Name of the group the icon belongs to (filename prefix).
 * @param string $variant       Name of specific icon for display the .SVG file to display. Sets the right path and suffix.
 * @param string $output        Optional. inject|icon|img (default):
 *                                  - "inject" for inline SVG injection.
 *                                  - "icon" for an <i> element with the icon slug in the class, and sr-only ALT text
 *                                  - "img" for an <img> element with ALT attribute.
 * @param string $alt           Optional. ALT text for <img> element.
 * @return string               The
 */

if ( ! function_exists('exodus_get_icon') ) :

    function exodus_get_icon($subset, $variant, $output = 'img', $alt) {

        $path = '/images/vectors/';
        $file_name = $subset . '-' . $variant;
        $class = 'svg-' . $subset . ' svg-' . $subset . '-' . $variant;
        $src = get_template_directory_uri() . $path . $file_name . '.svg';

        switch ($output) {
            case 'inject':
                $inject = file_get_contents($src);
                return $inject;
            case 'icon':
                $icon = '<i class="svg-bg ' . $class . '" role="img"></i><span class="sr-only">' . $alt . '</span>';
                return $icon;
            default:
                $img = '<img src="' . $src . '" class="svg  ' . $class . '" alt="' . $alt . '" role="img">';
                return $img;
        }
    }
endif;

/**
 * Displays the proper archive title by page type
 *
 * @since 2.0.0
 *
 * @return string   The page title between <em> tags, with the appropriate prefix prepended.
 */

if ( ! function_exists('exodus_grid_title') ) :

    function exodus_grid_title() {

        $prefix = '';

        if ( is_category() ) {
            $prefix = __( 'Best results for' , 'exodus' );
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $prefix = __( 'Articles tagged' , 'exodus' );
            $title = single_tag_title( '', false );
        } elseif ( is_search() ) {
            $prefix = __( 'Search Results for' , 'exodus' );
            $title = (isset($_GET['s'])) ? $_GET['s'] : ''; // Get 's' querystring param
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            $prefix = $tax->labels->singular_name;
            $title = single_term_title( '', false );
        } elseif ( is_author() ) {
            $prefix = __( 'Articles by' , 'exodus' );
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } else {
            $title = __( 'Archive for' , 'exodus' );
        }

        $markup = $prefix . ' <em>' . $title . '</em>';
        echo $markup;
    }
endif;
