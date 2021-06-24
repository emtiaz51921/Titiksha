<?php
/**
 * Template Name: Full Width Template
 * Template Post Type: post, page
 *
 * @link https://codex.wordpress.org/Templates
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

					<div class="col m12 s12">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</div>
					<!-- colm12 -->

				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</section>
		<!-- /#single-blog-section -->

	</main><!-- #main -->

<?php
get_footer();


