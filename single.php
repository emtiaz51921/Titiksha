<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Titiksha
 */

get_header();
?>

	<main id="content" class="site-main">
		<!-- ==================== single-blog-section start ====================-->
		<section id="single-blog-section" class="single-blog-section w100dt mb-50">
			<div class="container">
				<div class="row">


					<?php
					if ( 'left_sidebar' === get_theme_mod( 'post_single_layout' ) ) :
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
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						// Previous/next post navigation.
						titiksha_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
							endif;

						endwhile; // End of the loop.
					?>

					</div>
					<!-- colm8 -->

					<?php
					if ( 'right_sidebar' === get_theme_mod( 'post_single_layout', 'right_sidebar' ) ) :
						get_sidebar();
					endif;
					?>

				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</section>
		<!-- /#single-blog-section -->

	</main><!-- #main -->

<?php
get_footer();
