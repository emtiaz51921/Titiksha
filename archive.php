<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Titiksha
 */

get_header();
?>
	<main id="content" class="site-main">
		<section id="cateogry-section" class="cateogry-section w100dt mb-50">
			<div class="container">
				<div class="row">

					<?php

					if ( 'left_sidebar' === get_theme_mod( 'post_archive_layout' ) ) :
						get_sidebar();
					endif;

					?>


					<div class="col s12 
					<?php
					if ( ( 'left_sidebar' === get_theme_mod( 'post_archive_layout' ) ) || ( 'right_sidebar' === get_theme_mod( 'post_archive_layout', 'right_sidebar' ) ) ) {
						echo 'm8 l8';
					} elseif ( 'full_width' === get_theme_mod( 'post_archive_layout' ) ) {
											echo 'm12 l12';
					}
					?>
					">

						<?php if ( have_posts() ) : ?>


							<?php
							if ( get_the_archive_description() ) :
								?>
								<header class="page-header card blogs">
									<div class="card-content">
										<?php
										the_archive_description( '<div class="archive-description">', '</div>' );
										?>
									</div>
								</header><!-- .page-header -->
								<?php
							endif;
							?>


							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

						endif;
							?>
					</div>  <!-- colm8 -->

					<?php
					if ( 'right_sidebar' === get_theme_mod( 'post_archive_layout', 'right_sidebar' ) ) :
						get_sidebar();
					endif;
					?>

				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</section>
		<!-- /#blog-section -->
	</main>
<?php
get_footer();
