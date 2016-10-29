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
    echo '<p class="h4">'. esc_html__('About the Author' , 'exodus' ) .'</p>';
    echo  '<div class="author-avatar">' . get_avatar( $author_id ) . '</div>'; // TODO add alt value
    echo '<div class="byline author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></div>'; // WPCS: XSS OK.
    echo '<div class="author-description">' . get_the_author_meta( 'description', $author_id) . '</div>';
}

endif;

/******************************************************/

if ( ! function_exists( 'exodus_cpt_label' ) ) :
    /**
     * Prints a translatable CPT label
     */
    function exodus_cpt_label() {
        $post_type = get_post_type();
        $archive = get_post_type_archive_link( $post_type );
        echo '<a href="' . $archive . '" class="article-label article-label--' . $post_type . '">' . get_option( $post_type ) . '</a>';
    }
endif;

/******************************************************/

if ( ! function_exists( 'exodus_the_communities' ) ) :
    /**
     * Prints HTML with the list of communities this post is related to.
     */
    function exodus_the_communities() {
        $post = get_the_ID();
        if ( is_singular() ) {
            echo the_terms(
                $post ,
                'community' ,
                '<li class="community"><button class="btn btn-info btn-xs">' ,
                '</a></button></li><li class="community"><button class="btn btn-info btn-xs">' ,
                '</a></button></li>'
            );
        } else {
            echo the_terms(
                $post ,
                'community' ,
                '<span class="community caption">' ,
                ', </a></span><span class="community caption">' ,
                '</a></span>'
            );
        }

    }
endif;

/******************************************************/
if ( ! function_exists( 'exodus_get_article_fields' )) :
    function exodus_get_article_fields() {
        if ( 'ritual' === get_post_type() ) {
            $participants = get_field( 'participants' );
            $location = get_field( 'location' );
            $timing = get_field( 'timing' );
            echo '<ul class="article-fields ritual row">';
                echo '<li class="article-field participants col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Participants' , 'exodus' ) . '</h4>' . $participants . '</li>';
                echo '<li class="article-field location col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Location' , 'exodus' ) . '</h4>' . $location . '</li>';
                echo '<li class="article-field timing col-xs-12 col-sm-4"><h4 class="article-field-title caption">' . esc_html__('Timing' , 'exodus' ) . '</h4>' . $timing . '</li>';
            echo '</ul>';
        } /*elseif ( 'text' === get_post_type() ) { //TODO saving for later, maybe

        } elseif ( 'event' === get_post_type() ) {

        }*/
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
		esc_html_x( 'Posted on %s', 'post date', 'exodus' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'exodus' ),
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
		$categories_list = get_the_category_list( esc_html__( ', ', 'exodus' ) );
		if ( $categories_list && exodus_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'exodus' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'exodus' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'exodus' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'exodus' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'exodus' ),
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
