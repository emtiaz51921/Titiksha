<?php
/**
 * Template part for displaying carousel
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Titiksha
 */

?>


<?php
/**
 * Setup query to show the ‘post’ post type with given number of posts.
 * Output is title without excerpt.
 */


$titiksha_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => get_theme_mod( 'post_carousel_number' ),
	'orderby'             => get_theme_mod( 'post_carousel_orderby' ),
	'order'               => get_theme_mod( 'post_carousel_order' ),
	'post__not_in'        => get_option( 'sticky_posts' ),
	'category_name'       => get_theme_mod( 'post_carousel_category' ),
	'ignore_sticky_posts' => true,
);
$titiksha_loop = new WP_Query( $titiksha_args );

?>
<!-- ==================== daily-lifestyle-section Start ==================== -->
<section id="daily-lifestyle-section" class="daily-lifestyle-section mb-50">
	<div class="container">
		<div class="owl-carousel small-carousel owl-theme">

			<?php

			while ( $titiksha_loop->have_posts() ) :
				$titiksha_loop->the_post();

				$titiksha_slider_image = get_the_post_thumbnail_url( '', 'titiksha_carousel' );
				if ( empty( $titiksha_slider_image ) ) {
					$titiksha_slider_image = get_template_directory_uri() . '/images/placeholder-carousel.jpg';
				}

				?>

				<div class="item">
					<div class="card horizontal">
						<div class="card-image">
							<?php
							printf(
								'<img src="%1$s" alt="%2$s" />',
								esc_url( $titiksha_slider_image ),
								esc_attr( get_the_title() )
							);
							?>
							<span class="effect"></span>
						</div>
						<!-- /.card-image -->
						<div class="card-stacked">
							<div class="card-content">
								<div class="category_list">
									<?php
									titiksha_entry_category();
									?>
								</div>

								<?php

								printf( '<a href="%1$s" class="sm-name">%2$s</a>', esc_url( get_the_permalink() ), esc_html( get_the_title() ) );
								?>

							</div>
							<!-- /.card-content -->
							<div class="card-action">

								<?php titiksha_post_author_info(); ?>

								<?php titiksha_comment_meta_small(); ?>

								<!-- /.post-mate -->
							</div>
							<!-- /.card-action -->
						</div>
						<!-- /.card-stacked -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.item -->

				<?php

			endwhile;
			wp_reset_postdata();
			?>

		</div>
		<!-- /.small-carousel -->
	</div>
	<!-- container -->
</section>
<!-- /#daily-lifestyle-section -->
<!-- ==================== daily-lifestyle-section End ==================== -->
