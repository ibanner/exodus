<?php
/**
 * Search results are contained within a div.searchwp-live-search-results
 * which you can style accordingly as you would any other element on your site
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'searchwp_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'searchwp-live-search' );
 *
 * You can use ~/searchwp-live-search/assets/styles/style.css as a guide to customize
 */
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();
		$post_type_term = get_the_terms( get_the_ID() ,'post_types_tax');
		$byline = '<span class=" vcard byline caption">' . esc_html_x( 'by' , 'exodus' ) . ' <span class="author">' . esc_html( get_the_author() ) . '</span></span>';
		?>
		<div class="searchwp-live-search-result">
			<p><a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo get_the_title(); ?>
			</a> &raquo; <?php echo $post_type_term[0]->name; ?>
			<em>
				<?php echo $byline; ?>
			</em></p>
		</div>
	<?php endwhile; ?>
<?php else : ?>
	<p class="searchwp-live-search-no-results">
		<em><?php _ex( 'No results found.', 'exodus' ); ?></em>
	</p>
<?php endif; ?>
