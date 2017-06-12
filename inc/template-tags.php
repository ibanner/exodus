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

function exodus_author_info() {
    $author_id = get_the_author_meta( 'ID' );
    echo '<p class="h4 meta-title">'. esc_html__('About the Author' , "exodus" ) .'</p>';
    echo '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>'; // TODO add alt value
    echo '<div class="byline author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></div>'; // WPCS: XSS OK.
    echo '<div class="author-description">' . get_the_author_meta( 'description', $author_id) . '</div>';
}

endif;

/******************************************************/

if ( ! function_exists( 'exodus_post_type_tax_label' ) ) :

    /**
     * Prints a translatable Post Type Tax term label
     */

    function exodus_post_type_tax_label() {
        $post_type_term = get_the_terms( get_the_ID() ,'post_types_tax');
        $term_page = get_term_link( $post_type_term[0] ,'post_types_tax');
        if ($post_type_term) {
            echo '<a href="' . $term_page . '" class="article-label">' . $post_type_term[0]->name . '</a>';
        } elseif (current_user_can('edit_posts')) {
            edit_post_link( __( "Type N/A" , "exodus" ), null , '</a>' , null , 'article-label color-red' );
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
            echo '<button type="button" class="input input--select btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="current-filter-type">' . $active_type_label . '</span> <i id="#caret" class="fa fa-caret-down" aria-hidden="true"></i></button>';
            echo '<ul class="dropdown-menu post-types-tax">';
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

/******************************************************/

if ( ! function_exists( 'exodus_search_form' ) ) :

    /**
     * Prints HTML for the default search form
     */

    function exodus_search_form() {
        echo '<form role="search" method="get" class="search-form" action="' . home_url( "/" ) . '">';
        echo '<div class="form-group">';
        echo '<label>';
        echo '<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) .'</span>';
        echo '<input type="search" class="search-field form-control input-lg" placeholder="' . /*esc_attr_x( 'Search …', 'placeholder' ) . */'" value="' . get_search_query() .'" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />';
        echo '</label>';
        echo '<input type="submit" class="search-submit btn btn-info btn-lg" value="' . esc_attr_x( 'Search', 'submit button' ) . '" />';
        echo '</div>';
        echo '</form>';
    }

endif;


/*******************************************************/

if ( ! function_exists( 'exodus_social_tooltip' ) ) :

    function exodus_social_tooltip() {
        $platforms = array(
            array(
                'slug'  => 'facebook',
                'url'   => 'https://facebook.com/sharer/sharer.php?u='
            ),
            array(
                'slug'  => 'twitter',
                'url'   => 'https://twitter.com/share?url='
            ),
            array(
                'slug'  => 'pinterest',
                'url'   => 'https://pinterest.com/pin/create/bookmarklet/?url='
            ),
            array(
                'slug'  => 'google-plus',
                'url'   => 'https://plus.google.com/share?url='
            ),
        );

        foreach ($platforms as $platform) {
            $url = $platform['url'];
            echo '<a class="jssocials-share-link" href="'. $url . esc_url(get_the_permalink()) . '" target="_blank"><i class="fa fa-lg fa-'. $platform['slug'] .'-square" aria-hidden="true"></i></a>';
        }
    }

endif;