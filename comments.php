<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Titiksha
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<div class="peoples-comments w100dt mb-30">

		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
		<div class="sidebar-title center-align">
			<h2 class="comments-title">
				<?php
				$titiksha_comment_count = get_comments_number();
				if ( '1' === $titiksha_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'One Comment', 'titiksha' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				} else {
					printf(
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s Comment', '%1$s Comments', $titiksha_comment_count, 'comments title', 'titiksha' ) ),
						number_format_i18n( $titiksha_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				}
				?>
			</h2><!-- .comments-title -->
		</div>

			<?php the_comments_navigation(); ?>

		<ul class="comment-list comment-area w100dt">
			<?php

			wp_list_comments(
				array(
					'walker'      => new Titiksha_Comment(),
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 75,
					'format'      => 'html5',
				)
			);

			?>
		</ul><!-- .comment-list -->

	</div>


	<div class="leave-comment">
			<?php
			the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'titiksha' ); ?></p>
				<?php
		endif;

		endif; // Check for have_comments().


		$titiksha_args = array(
			'format'               => 'html5',
			'title_reply'          => '<div class="sidebar-title center-align"><h2>' . esc_html__( 'Leave A Reply', 'titiksha' ) . '</h2></div>',
			'comment_notes_before' => '',
			'comment_field'        => '<div class="col s12"><div class="form-item"> <textarea id="comment" name="comment" class="materialize-textarea" rows="5" aria-required="true"></textarea> <label for="textarea1">Textarea</label> </div></div>',
			'class_submit'         => 'comment-submit-btn',
			'class_form'           => 'comment-area w100dt',
			'fields'               => apply_filters(
				'titiksha_form_default_fields',
				array(
					'author'  =>
						'     <div class="col m6 s12"><div class="form-item">' .
						'<input id="author" name="author" type="text" class="validate" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30" /><label for="icon_prefix">"' . esc_html__( 'First Name', 'titiksha' ) . '"</label> </div></div>',
					'email'   =>
						'<div class="col m6 s12"><div class="form-item">' .
						'<input id="email" name="email" type="text" class="validate" value="' . esc_attr( $commenter['comment_author_email'] ) .
						'" size="30" /><label for="email" data-error="wrong" data-success="right">"' . esc_html__( 'Email', 'titiksha' ) . '"</label> </div></div>',
					'url'     =>
						'<div class="col m12 s12"><div class="form-item">' .
						'<input id="url" name="url" class="validate" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30" /> <label for="icon_prefix">"' . esc_html__( 'Website', 'titiksha' ) . '"</label> </div></div>',
					'cookies' => '',
				)
			),
		);

		comment_form( $titiksha_args );


		?>
	</div>



</div><!-- #comments -->
