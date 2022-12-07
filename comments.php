<?php
/**
 * The template file for displaying the comments and comment form
 *
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


<div id="comments" class="leave-comment comments-area">

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Комментарии закрыты.', 'wescle' ); ?></p>
	<?php
	endif;


	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = true;

	$required_text = sprintf(
		' ' . __( 'Обязательные поля помечены %s', 'wescle' ),
		'<span class="required">*</span>'
	);

	$comment_form_args = array(
		'class_form'           => 'comment-form form-leave-comment',
		'class_submit'         => 'form-leave-comment__btn btn btn-main',
		'comment_notes_before' => sprintf(
			'<div class="comment-notes leave-comment__info">%s%s</div>',
			sprintf(
				'<span id="email-notes">%s</span>',
				__( 'Ваш электронный адрес не будет опубликован.', 'wescle' )
			),
			( $req ? $required_text : '' )
		),
		'title_reply_before'   => '<div id="reply-title" class="comment-reply-title leave-comment__title title title_content">',
		'title_reply_after'    => '</div>',

		'comment_field' => '<fieldset class="form-group"><label class="screen-reader-text" for="comment">' . __( 'Комментарий', 'wescle' ) . '</label><textarea class="form-input form-leave-comment__text" id="comment" name="comment" placeholder="' . __( 'Комментарий', 'wescle' ) . ( $req ? '*' : '' ) . '" required></textarea></fieldset>',
		'fields'        => array(
			'author' => '<fieldset class="form-group form-group_double-input"><label class="screen-reader-text" for="author">' . __( 'Имя', 'wescle' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="author" class="form-input form-leave-comment__name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" ' . $html_req . ' placeholder="' . __( 'Имя', 'wescle' ) . ( $req ? '*' : '' ) . '" />',
			'email'  => '<label class="screen-reader-text" for="email">' . __( 'Email', 'wescle' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="email" class="form-input form-leave-comment__email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" ' . $html_req . ' placeholder="' . __( 'Email', 'wescle' ) . ( $req ? '*' : '' ) . '" /></fieldset>',
			'url'    => '<fieldset class="form-group comment-form-url" style="display: none;"><label class="screen-reader-text" for="url">' . __( 'Интернет сайт', 'wescle' ) . '</label> ' .
			            '<input id="url" class="form-input form-leave-comment__website" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" placeholder="' . __( 'Интернет сайт', 'wescle' ) . '" /></fieldset>',
		),
	);

	if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
		$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$comment_form_args['fields']['cookies'] = sprintf(
			'<fieldset class="form-group comment-form-cookies-consent">%s %s</fieldset>',
			sprintf(
				'<input class="form-checkbox" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
				$consent
			),
			sprintf(
				'<label class="form-label checkbox-label" for="wp-comment-cookies-consent">%s<span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="#08c"><path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093l3.473-4.425a.236.236 0 0 1 .02-.022z"></path></g></svg></span></label>',
				__( 'Сохранить моё имя, email и адрес сайта в этом браузере для последующих моих комментариев.' )
			)
		);
	}

	/*
	$title_single_comments = get_post_meta( $post->ID, 'comments_title', true );

	if ( is_single() && ! empty( $title_single_comments ) ) {
		$title_comments = $title_single_comments;
	}

	if ( ! empty( $title_comments ) ) {
		$comment_form_args['title_reply'] = $title_comments;
	}*/

	// текст перед кнопкой Отправить
	$comments_text_before_submit = '';
	if ( ! empty( $comments_text_before_submit ) ) {
		$comment_form_args['comment_notes_after'] = '<div class="comment-notes-after">' . $comments_text_before_submit . '</div>';
	}

	$comment_form_args = apply_filters( THEME_SLUG . '_comment_form_args', $comment_form_args );
	comment_form( $comment_form_args );


	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="comment-navigation">
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Предыдущие комментарии', 'wescle' ) ); ?>&nbsp;</div>
                    <div class="nav-next">&nbsp;<?php next_comments_link( esc_html__( 'Следующие комментарии', 'wescle' ) ); ?></div>
                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				'type'     => 'comment',
				'style'    => 'ol',
				'callback' => 'wescle_comments',
			) );
			?>
        </ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="comment-navigation">
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Предыдущие комментарии', 'wescle' ) ); ?>&nbsp;</div>
                    <div class="nav-next">&nbsp;<?php next_comments_link( esc_html__( 'Следующие комментарии', 'wescle' ) ); ?></div>
                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	?>

</div><!-- #comments -->