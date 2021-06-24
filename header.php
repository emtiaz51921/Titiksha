<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Titiksha
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">


<head>

	<meta charset="<?php bloginfo( 'charset', 'display' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>

<?php

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>




<div class="thetop"></div>
<!-- for back to top -->

<div class='backToTop'>
	<a href="#" class='scroll'>
		<span> <?php esc_html_e( 'T', 'titiksha' ); ?></span>
		<span> <?php esc_html_e( 'O', 'titiksha' ); ?></span>
		<span> <?php esc_html_e( 'P', 'titiksha' ); ?></span>
		<span class="go-up"><i class="icofont icofont-long-arrow-up"></i></span>
	</a>
</div>
<!-- backToTop -->




<!-- ==================== header-section Start ==================== -->
<header id="header-section" class="header-section w100dt navbar-fixed">

	<nav class="nav-extended main-nav">
		<div class="container">
			<div class="row">
				<div class="nav-wrapper w100dt">

					<div class="logo left">

						<?php

						if ( titiksha_custom_logo() ) {

							echo wp_kses_post( titiksha_custom_logo() );

						} else {

							echo wp_kses_post( titiksha_text_logo_display() );

						}

						?>

					</div>
					<!-- logo -->

					<div class="menu_holder">

						<button id="nav-toggle" class="nav-toggle"><i class="icofont icofont-navigation-menu"></i></button>
						<nav class="nav-collapse">
							<?php

							wp_nav_menu(
								array(
									'theme_location' => 'menu-main',
									'menu_id'        => 'primary-menu',
									'depth'          => 5,
									'container'      => 'ul',
									'menu_class'     => 'menu-items',
									'fallback_cb'    => 'Titiksha_Navwalker::fallback',
									'walker'         => new Titiksha_Navwalker(),
								)
							);

							?>
						</nav>

					</div>
					<!-- main-menu -->

				</div>
				<!-- /.nav-wrapper -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</nav>

</header>
<!-- /#header-section -->
<!-- ==================== header-section End ==================== -->




<!-- ==================== header-section Start ==================== -->
<section id="breadcrumb-section" class="w100dt mb-30 <?php echo ( is_home() ? 'top-space-100' : 'breadcrumb-section' ); ?>">

	<?php
	if ( ! is_home() ) {
		?>

	<div class="container">
		<nav class="breadcrumb-nav w100dt">
			<div class="page-name hide-on-small-only left">
				<h4>
				<?php

				if ( is_archive() ) {
					the_archive_title();
				} elseif ( is_search() ) {
					/* translators: %s is replaced with "string" */
					printf( esc_html__( 'Search Results for: %s', 'titiksha' ), '<span>' . get_search_query() . '</span>' );
				} elseif ( is_404() ) {

					echo esc_html_e( 'Error 404.', 'titiksha' );
				} elseif ( is_single() ) {

					if ( get_theme_mod( 'single_breadcrumb_title' ) ) {
						echo esc_html( get_theme_mod( 'single_breadcrumb_title' ) );
					} else {
						esc_html_e( 'Blog', 'titiksha' );

					}
				} else {

					the_title();
				}
				?>
				</h4>
			</div>


			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div class="nav-wrapper right breadcrumb">', '</div>' );
			}
			?>
			<!-- /.nav-wrapper -->
		</nav>
		<!-- /.breadcrumb-nav -->
	</div>
	<!-- container -->
		<?php
	}
	?>

</section>
<!-- /.breadcrumb-section -->
<!-- ==================== header-section End ==================== -->
