<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Titiksha
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>
	<div class="blogs mb-30 white">
		<div class="card">

			<div class="card-image">
				<?php titiksha_post_thumbnail(); ?>
			</div>

			<!-- /.card-image -->
			<div class="card-content">

				<div class="left w100dt cat_list">
					<?php titiksha_entry_category(); ?>
				</div>


				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="card-title">', '</h1>' );
				else :
					the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>


				<div class="mb-30 post-content">

					<?php

					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading <span class="screen-reader-text"> "%s"</span>', 'titiksha' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);


					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'titiksha' ),
							'after'  => '</div>',
						)
					);
					?>

				</div>


				<div class="post-entry-footer">
					<?php
					if ( is_single() ) {

						titiksha_entry_tag_list();

					} else {
						/* Post author name and date display */
						titiksha_post_footer_info();
					}
					?>

					<?php
					/* Post comment info */
					titiksha_comment_meta();
					?>
				</div>


			</div>
			<!-- /.card-content -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.blogs -->
</article>
