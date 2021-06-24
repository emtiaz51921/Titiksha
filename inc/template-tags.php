<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Titiksha
 */

if ( ! function_exists( 'titiksha_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function titiksha_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'titiksha' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'titiksha_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function titiksha_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'titiksha' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'titiksha_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function titiksha_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'titiksha' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'titiksha' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'titiksha' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'titiksha' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'titiksha' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'titiksha' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'titiksha_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function titiksha_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'titiksha_post_thumb' ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'titiksha_post_thumb',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>
			<a class="btn-floating center-align cmn-bgcolor halfway-fab waves-effect waves-light" href="<?php the_permalink(); ?>">
				<i class="icofont icofont-camera-alt"></i>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;


/*
 *
 * Print category list on archive pages
 *
 */

if ( ! function_exists( 'titiksha_entry_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function titiksha_entry_category() {

		if ( ( 1 === get_theme_mod( 'archive_remove_cat', 0 ) && ( is_archive() || is_home() ) ) || ( 1 === get_theme_mod( 'single_remove_cat', 0 ) && is_single() ) ) {
			return false;
		}

		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$list_all_cats = get_the_category();
			if ( $list_all_cats ) {
				/* translators: 1: list of categories. */
				foreach ( $list_all_cats as $cats ) {

					printf( '<a class="tag l-blue mb-10" href="%1$s">%2$s</a>', esc_url( get_category_link( $cats->term_id ) ), esc_html( $cats->name ) );

				}
			}
		}

	}
endif;


/*
 * Print post author name & date on archive pages
 */


if ( ! function_exists( 'titiksha_post_footer_info' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */

	function titiksha_post_footer_info() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time> ';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = ' <time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$arr = array(
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
				'id'       => array(),
			),
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By - %s', 'post author', 'titiksha' ),
			'<a class="l-blue" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<ul class="post-mate-time left">';

		if ( 0 === get_theme_mod( 'archive_remove_author', 0 ) && ( is_archive() || is_home() ) ) {
			echo '<li><p class="hero left">' . wp_kses_post( $byline ) . '</p></li>';
		}
		if ( 0 === get_theme_mod( 'archive_remove_date', 0 ) && ( is_archive() || is_home() ) ) {
			echo '<li><i class="icofont icofont-ui-calendar"></i> <a class="post-date gray" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . wp_kses( $time_string, $arr ) . '</a></li>';
		}
		echo '</ul>';

	}

endif;


if ( ! function_exists( 'titiksha_comment_meta' ) ) :

	/**
	 * Prints HTML with meta information for the comments.
	 */
	function titiksha_comment_meta() {

		if ( 1 === get_theme_mod( 'archive_remove_comments', 0 ) && ( is_archive() || is_home() ) ) {
			return false;
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<ul class="post-mate right"><li class="comment"><span class="meta_comment"><i class="icofont icofont-comment"></i> ';
			comments_popup_link(
				__( 'Leave a comment', 'titiksha' ),
				__( '1', 'titiksha' ),
				__( '%', 'titiksha' )
			);
			echo '</span></li></ul>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'titiksha' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;


/*
 * Show tag list on single post
 */


if ( ! function_exists( 'titiksha_entry_tag_list' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function titiksha_entry_tag_list() {

		if ( 1 === get_theme_mod( 'single_remove_tags', 0 ) && is_single() ) {
			return false;
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<ul class="tag-list left"><li>', '</li><li>', '</li></ul>' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				print( $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

	}
endif;


if ( ! function_exists( 'titiksha_comment_meta_small' ) ) :

	/**
	 * Prints HTML with meta information for the comments.
	 */
	function titiksha_comment_meta_small() {

		if ( 1 === get_theme_mod( 'archive_remove_comments', 0 ) && ( is_archive() || is_home() ) ) {
			return false;
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<ul class="post-mate right"><li class="comment"><span class="meta_comment"><i class="icofont icofont-comment"></i> ';
			comments_popup_link(
				__( 'Comment', 'titiksha' ),
				__( '1', 'titiksha' ),
				__( '%', 'titiksha' )
			);
			echo '</span></li></ul>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'titiksha' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;


/**
 * Prints author info
 */
if ( ! function_exists( 'titiksha_post_author_info' ) ) :

	function titiksha_post_author_info() {

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By - %s', 'post author', 'titiksha' ),
			'<a class="l-blue" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<p class="hero left">' . wp_kses_post( $byline ) . '</p>';

	}

endif;
