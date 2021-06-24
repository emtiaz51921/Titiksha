<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being main.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Titiksha
 */

get_header();
?>

	<?php
	/*
	 * Post slider
	 */
	if ( ( 1 === get_theme_mod( 'titiksha_enable_slide' ) ) && is_home() ) :

		get_template_part( 'template-parts/content', 'slider' );

	endif;

	/*
	 * Post carousel
	 */
	if ( ( 1 === get_theme_mod( 'titiksha_enable_carousel' ) ) && is_home() ) :

		get_template_part( 'template-parts/content', 'carousel' );

	endif;

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
						echo 'm8 l8 sidebar-contain';
					} elseif ( 'full_width' === get_theme_mod( 'post_archive_layout' ) ) {
											echo 'm12 l12 full-width-contain';
					}
					?>
					">

						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;

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

							titiksha_number_paging_nav();

							else :

								get_template_part( 'template-parts/content', 'none' );

						endif;
							?>
					</div>
					<!-- colm8 -->

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
