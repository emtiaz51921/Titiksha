<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap Media object in WordPress comment list.
 *
 * @package Titiksha
 */

class Titiksha_Comment extends Walker_Comment {

	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment the comments list.
	 * @param int    $depth   Depth of comments.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo wp_kses_post( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children mb-30' : ' mb-30' ); ?>>


	<div class="media-body mt-3 " id="div-comment-<?php comment_ID(); ?>">

		<?php if ( 0 !== $args['avatar_size'] ) : ?>
			<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="ppic left">
				<?php echo wp_kses_post( get_avatar( $comment, $args['avatar_size'], 'mm', '', array( 'class' => 'comment_avatar rounded-circle' ) ) ); ?>
			</a>
		<?php endif; ?>




		<div class="pname">

		<h4 class="mb-10 comment_author_title">
			<?php
			$arr = array(
				'a' => array(
					'href'  => array(),
					'rel'   => array(),
					'class' => array(),
				),
			);
			echo wp_kses( get_comment_author_link(), $arr );
			?>
		</h4>

		<div class="comment-text mb-10">
			<?php comment_text(); ?>
		</div>



		<ul class="post-mate-time left">

			<li>
				<i class="icofont icofont-ui-calendar"></i>
				<a class="hidden-xs-down" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php comment_date(); ?>
					</time>
				</a>
			</li>

			<li class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
			</li>

			<li class="like">
				<?php edit_comment_link( __( 'Edit', 'titiksha' ), '<li class="edit-link">', '</li>' ); ?>
			</li>

		</ul>





		<?php if ( '0' === $comment->comment_approved ) : ?>
			<p class="card-text comment-awaiting-moderation label label-info text-muted small"><?php esc_html_e( 'Your comment is awaiting moderation.', 'titiksha' ); ?></p>
		<?php endif; ?>

		<!-- .comment-content -->



		<?php
	}

}
