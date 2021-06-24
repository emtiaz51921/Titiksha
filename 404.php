<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
						<div class="card blogs mb-30">

							<section class="card-content error-404 not-found">
								<header class="page-header center">
									<h1 class="page-title-main"><?php esc_html_e( '404!', 'titiksha' ); ?></h1>
									<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'titiksha' ); ?></h2>
								</header><!-- .page-header -->

								<div class="page-content center max-width">
									<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'titiksha' ); ?></p>

									<?php
									get_search_form();
									?>
								</div><!-- .page-content -->
							</section><!-- .error-404 -->


						</div>
					</div>
					<!-- colmn 12-->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</section>
		<!-- /#single-blog-section -->

	</main><!-- #main -->

<?php
get_footer();
