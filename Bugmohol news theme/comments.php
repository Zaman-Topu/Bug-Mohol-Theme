<?php
/**
 * The template for displaying comments
 *
 * @package Bug_Mohol
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-5 pt-5 border-top">

    <?php
    // You can start editing here -- including this checks!
    if (have_comments()):
        ?>
        <h2 class="comments-title h4 fw-bold mb-4">
            <?php
            $bug_mohol_comment_count = get_comments_number();
            if ('1' === $bug_mohol_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'bug-mohol'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $bug_mohol_comment_count, 'comments title', 'bug-mohol')),
                    number_format_i18n($bug_mohol_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list list-unstyled">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 60,
                    'callback' => null,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()):
            ?>
            <p class="no-comments alert alert-warning">
                <?php esc_html_e('Comments are closed.', 'bug-mohol'); ?>
            </p>
            <?php
        endif;

    endif; // Check for have_comments().
    
    // Comment Form with Bootstrap styling overrides
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $comments_args = array(
        'class_submit' => 'btn btn-primary mt-3',
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title h5 fw-bold mb-3">',
        'title_reply_after' => '</h3>',
        'comment_field' => '<div class="comment-form-comment mb-3"><label for="comment" class="form-label">' . _x('Comment', 'noun') . '</label><textarea id="comment" name="comment" cols="45" rows="5" class="form-control" aria-required="true"></textarea></div>',
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' =>
                '<div class="row"><div class="comment-form-author col-md-6 mb-3">' .
                '<label for="author" class="form-label">' . __('Name', 'bug-mohol') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                '" size="30"' . $aria_req . ' class="form-control" /></div>',
            'email' =>
                '<div class="comment-form-email col-md-6 mb-3"><label for="email" class="form-label">' . __('Email', 'bug-mohol') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) .
                '" size="30"' . $aria_req . ' class="form-control" /></div></div>',
            'url' =>
                '<div class="comment-form-url mb-3"><label for="url" class="form-label">' . __('Website', 'bug-mohol') . '</label>' .
                '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) .
                '" size="30" class="form-control" /></div>',
        ))
    );

    comment_form($comments_args);
    ?>

</div><!-- #comments -->

<style>
    /* Quick and dirty overrides for default comment styling */
    .comment-list .comment {
        margin-bottom: 30px;
        border: 1px solid #eee;
        padding: 20px;
        border-radius: 8px;
        background: #fff;
    }

    body.dark-mode .comment-list .comment {
        background: #1a1a1a;
        border-color: #333;
    }

    .comment-author img {
        border-radius: 50%;
        margin-right: 15px;
    }

    .comment-author .fn {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .comment-meta a {
        color: #6c757d;
        font-size: 0.85rem;
        text-decoration: none;
    }

    .reply a {
        display: inline-block;
        padding: 5px 12px;
        font-size: 0.85rem;
        color: #fff;
        background: var(--primary-color);
        border-radius: 4px;
        text-decoration: none;
    }

    .reply a:hover {
        background: #0b5ed7;
    }
</style>