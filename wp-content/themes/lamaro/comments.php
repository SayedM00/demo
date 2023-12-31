<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/**
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {

	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h2 class="comments-title ltx-theme-header">
		<?php

		if ( get_comments_number() ) {

			echo esc_html( get_comments_number() .' '. _n( 'Comment', 'Comments', get_comments_number(), 'lamaro' ) );
		}
		?>
	</h2>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'lamaro' ); ?></h3>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'lamaro' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'lamaro' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<div class="comments-ol">
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'lamaro_single_comment',
				) );
			?>
		</ol>
	</div>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php echo esc_html__( 'Comment navigation', 'lamaro' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'lamaro' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'lamaro' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'lamaro' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>
	<?php
	if ( comments_open() ) :
	?>
		<div class="comments-form-wrap">
			<a class="anchor" id="comments-form"></a>
			<div class="comments-form anchor">
				<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? ' aria-required="true"' : '' );

				$comments_args = array(
					'id_submit' => 'send_comment',
					'label_submit' => esc_html__( 'Leave Comment', 'lamaro' ),
					'title_reply' => esc_html__( 'Add Comment', 'lamaro' ),
					'logged_in_as' => '',
					'comment_notes_before' => '<p class="comments_notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'lamaro' ) . '</p>',
					'comment_notes_after' => '',
					'comment_field' => '<div class="comments-field comments_message">'
						. '<label for="comment" class="required">' . esc_html__( 'Your Message', 'lamaro' ) . '</label>'
						. '<textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'lamaro' ) . '" aria-required="true"></textarea>'
						. '</div>',
					'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' => '<div class="row"><div class="comments-field comments_author col-sm-6">'
						. '<label for="author"' . ( $req ? ' class="required"' : '' ) . '>' . esc_html__( 'Name', 'lamaro' ) . '</label>'
						. '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'lamaro' ) . ( $req ? ' *' : '') . '" value="' . esc_attr( isset( $commenter['comment_author'] ) ? $commenter['comment_author'] : '' ) . '" size="30"' . ($aria_req) . ' />'
						. '</div>',
						'email' => '<div class="comments-field comments_email col-sm-6">'
						. '<label for="email"' . ( $req ? ' class="required"' : '' ) . '>' . esc_html__( 'Email', 'lamaro' ) . '</label>'
						. '<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Email', 'lamaro' ) . ( $req ? ' *' : '') . '" value="' . esc_attr( isset( $commenter['comment_author_email'] ) ? $commenter['comment_author_email'] : '' ) . '" size="30"' . ($aria_req) . ' />'
						. '</div></div>',
					) ),
				);

				comment_form( $comments_args );
				?>
			</div>
		</div>
	<?php
	endif;
	?>

</div>
