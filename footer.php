<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Titiksha
 */

?>

<!-- ==================== footer-section Start ==================== -->
<footer id="footer-section" class="footer-section w100dt">
	<div class="container">


		<?php

		if ( get_theme_mod( 'titiksha_footer_copyright' ) ) :
			printf( '<p class="copyright center-align">%s</p>', wp_kses_post( get_theme_mod( 'titiksha_footer_copyright' ) ) );
		else :

			?>

		<p class="copyright center-align">

			<?php $titiksha_blogname = get_bloginfo( 'name' ); ?>

			<?php if ( ! empty( $titiksha_blogname ) ) : ?>
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name', 'display' ); ?></a>,
			<?php endif; ?>

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'titiksha' ) ); ?>" class="imprint">
				<?php
				/* translators: %s: WordPress. */
				printf( esc_html__( 'Proudly powered by %s.', 'titiksha' ), esc_html__( 'WordPress', 'titiksha' ) );
				?>
			</a>

		</p><!-- .site-info -->

			<?php
		endif;
		?>

	</div>
	<!-- container -->
</footer>
<!-- /#footer-section -->
<!-- ==================== footer-section End ==================== -->


<?php wp_footer(); ?>

</body>
</html>
