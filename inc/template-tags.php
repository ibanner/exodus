<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kol_Ehad
 */

if ( ! function_exists( 'exodus_author-info' ) ) :
/**
 * Prints HTML with meta information on the current author.
 */
function exodus_author_info() {
    $author_id = get_the_author_meta( 'ID' );
    $a = cptui_get_post_type_slugs();
    $post_type = get_post_type();
    echo '<p class="h4 meta-title">'. esc_html__('About the Author' , "exodus" ) .'</p>';
    echo '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>'; // TODO add alt value
    echo '<div class="byline author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></div>'; // WPCS: XSS OK.
    echo '<div class="author-description">' . get_the_author_meta( 'description', $author_id) . '</div>';
}

endif;

/******************************************************/
// TODO -- To Be Deprecated
if ( ! function_exists( 'exodus_cpt_label' ) ) :
    /**
     * Prints a translatable CPT label
     */
    function exodus_cpt_label() {
        $post_type = get_post_type();
        $post_format = get_post_format();
        $archive_cpt = get_post_type_archive_link( $post_type );
        $archive_format = get_post_format_link( $post_format );
        echo '<a href="' . ( $post_format ? $archive_format : $archive_cpt ) . '" class="article-label article-label--' . ( $post_format ? $post_format : $post_type ) . '">' . ( $post_format ? esc_html__('Video' , "exodus" ) : (get_option( $post_type ))) . '</a>';
    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_post_type_tax_label' ) ) :
    /**
     * Prints a translatable Post Type Tax term label
     */
    function exodus_post_type_tax_label() {
        $post_type_term = get_the_terms( get_the_ID() ,'post_types_tax');
        echo '<a href="#" class="article-label article-label">' . $post_type_term[0]->name . '</a>';
    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_post_type_tax_filter_ui' ) ) :
    /**
     * Prints a translatable Post Type Tax term label
     */
    function exodus_post_types_tax_filter_ui() {
        $terms = get_terms( array(
            'taxonomy' => 'post_types_tax',
            'hide_empty' => true,
        ) );
        if ($terms) {
            echo '<div class="btn-group button-group filter-group type" data-filter-group="type">';
            echo '<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="current-filter-type">' . esc_html__( "All Types" , "exodus" ) . '</span> <i id="#caret" class="fa fa-caret-down" aria-hidden="true"></i></button>';
            echo '<ul class="dropdown-menu ul-isotope post-types-tax">';
            echo '<li><a href="#" class="btn-isotope active" aria-pressed="true" title="' . esc_html__( "All Types" , "exodus" ) . '" data-filter="*">' . esc_html__( "All Types" , "exodus" ) . '</a></li>';
            echo '<li role="separator" class="divider"></li>';
            foreach ($terms as $term) {
                echo '<li><a href="#" class="btn-isotope" aria-pressed="false" title="' . esc_html__($term->name) . '" data-filter=".post_types_tax-' . esc_html__( $term->slug ) . '">' . esc_html__($term->name) . '</a></li>';
            }
            echo '</ul></div><!-- ul.dropdown-menu -->';
        } else {
            echo 'No Terms here!';
        }
    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_post_format_filter_ui' ) ) :
    /**
     * Prints a translatable post format label
     */
    function exodus_post_format_filter_ui() {
        $formats = get_post_format_slugs();
        if ($formats) {
            echo '<div class="btn-group button-group filter-group format" data-filter-group="format">';
                echo '<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="current-filter-format">' . esc_html__( "All Formats" , "exodus" ) . '</span> <i  id="#caret" class="fa fa-caret-down" aria-hidden="true"></i></button>';
                echo '<ul class="dropdown-menu ul-isotope format">';
                    echo '<li><a href="#" class="btn-isotope active" aria-pressed="true" title="' . esc_html__( "All Formats" , "exodus" ) . '" data-filter="*">' . esc_html__( "All Formats" , "exodus" ) . '</a></li>';
                    echo '<li role="separator" class="divider"></li>';
                foreach ($formats as $format) {
                    echo '<li><a href="#" class="btn-isotope" aria-pressed="false" title="' . get_post_format_string($format) . '" data-filter=".format-' . esc_html__( $format ) . '">' . get_post_format_string($format) . '</a></li>';
                }
                echo '</ul></div><!-- ul.dropdown-menu -->';
        } else {
            echo 'No Terms here!';
        }
    }
endif;

/******************************************************/
// TODO -- To Be Deprecated
if ( ! function_exists( 'exodus_get_article_fields' )) :
    function exodus_get_article_fields() {
        if ( 'ritual' === get_post_type() ) {
            $participants = get_field( 'participants' );
            $location = get_field( 'location' );
            $timing = get_field( 'timing' );
            echo '<ul class="article-fields ritual row">';
                echo '<li class="article-field participants col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Participants' , "exodus" ) . '</h4>' . $participants . '</li>';
                echo '<li class="article-field location col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Location' , "exodus" ) . '</h4>' . $location . '</li>';
                echo '<li class="article-field timing col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Timing' , "exodus" ) . '</h4>' . $timing . '</li>';
            echo '</ul>';
        } /*elseif ( 'text' === get_post_type() ) { //TODO saving for later, maybe

        } elseif ( 'event' === get_post_type() ) {

        }*/
    }
endif;

/******************************************************/

if ( ! function_exists( 'exodus_wpml_switch' )) :
    function exodus_wpml_switch() {
        $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

        if ( !empty( $languages ) ) {
            foreach( $languages as $l ) {
                if ( !$l['active'] ) echo '<a href="' . $l['url'] . '">';
                if ( $l['active'] ) echo '<span class="active-language">';
                echo '<img class="lang-flag" src="' . $l['country_flag_url'] . '" height="28" alt="' . $l['language_code'] . '" width="28" />';
                if ( !$l['active'] ) echo '</a> ';
                if ( $l['active'] ) echo '</span> ';
            }
        }
    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_lorem_ipsum' )) :
function exodus_lorem_ipsum() {
    if ( is_rtl() === true ) {
        echo '<p>לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית צש בליא, מנסוטו צמלח לביקו ננבי, צמוקו בלוקריה שיצמה ברורק. הועניב היושבב שערש שמחויט - שלושע ותלברו חשלו שעותלשך וחאית נובש ערששף. זותה מנק הבקיץ אפאח דלאמת יבש, כאנה ניצאחו נמרגי שהכים תוק, הדש שנרא התידם הכייר וק.
</p>';
    } else {
        echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam felis neque, posuere a rhoncus eget, vulputate mattis lectus. Donec lobortis urna id tincidunt blandit. Pellentesque fermentum a neque sit amet rutrum. Duis elementum arcu ac porttitor convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut sed neque id dolor hendrerit auctor quis nec lorem. Donec eu eleifend orci, ac vulputate nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mi magna, auctor sed aliquet scelerisque, dapibus at lacus. Duis aliquet diam sit amet lorem auctor porta. Cras lacinia vestibulum sem, et efficitur leo pharetra a.</p>';
    }
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

/******************************************************/

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

/*******************************************************/

function exodus_social_links($location) {
    $social_option = get_option($location);

    if ( strpos( $social_option , 'sgmb') === 1 ) {
        $social = do_shortcode( $social_option );
    } else {
        $social = __('Not Set' , "exodus"); //TODO Probably some extra guidance is required
    }
    echo $social;
}