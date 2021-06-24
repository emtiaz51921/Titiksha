<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

							endwhile;

							titiksha_number_paging_nav();

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
