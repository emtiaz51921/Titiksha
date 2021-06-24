<?php
/**
 * Template part for displaying slider
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
	'posts_per_page'      => get_theme_mod( 'post_slide_number' ),
	'orderby'             => get_theme_mod( 'post_slider_orderby' ),
	'order'               => get_theme_mod( 'post_slider_order' ),
	'post__not_in'        => get_option( 'sticky_posts' ),
	'category_name'       => get_theme_mod( 'post_slider_category' ),
	'ignore_sticky_posts' => true,
);
$titiksha_loop = new WP_Query( $titiksha_args );

?>

<!-- ==================== blog-slider-section start ==================== -->
<section id="blog-slider-section" class="blog-slider-section mb-50 nomargin-top <?php echo esc_attr( get_theme_mod( 'post_slider_category' ) ); ?>">
	<div class="container">

		<div class="slider home-top-slider">
			<ul class="slides">

				<?php

				while ( $titiksha_loop->have_posts() ) :
					$titiksha_loop->the_post();

					$titiksha_slider_image = get_the_post_thumbnail_url( '', 'full' );
					if ( empty( $titiksha_slider_image ) ) {
						$titiksha_slider_image = get_template_directory_uri() . '/images/placeholder.jpg';
					}

					?>

					<li class="slider-item">

						<?php
						printf(
							'<img src="%1$s" alt="%2$s" />',
							esc_url( $titiksha_slider_image ),
							esc_attr( get_the_title() )
						);
						?>

						<div class="caption center-align">

							<div class="category_list">
								<?php
								titiksha_entry_category();
								?>
							</div>

							<?php
							printf( '<h1 class="card-title mb-10">%1$s</h1>', esc_html( get_the_title() ) );
							the_excerpt();

							printf( '<a href="%1$s" class="custom-btn waves-effect waves-light">%2$s</a>', esc_url( get_the_permalink() ), esc_html__( 'READ MORE', 'titiksha' ) );
							?>
						</div>
					</li>

					<?php

				endwhile;
				wp_reset_postdata();

				?>


			</ul>
		</div>

	</div>
	<!-- container -->
</section>
<!-- /#blog-slider-section -->
<!-- ==================== blog-slider-section end ==================== -->

