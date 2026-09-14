<?php
/**
 * The template for displaying comments
 *
 * Styled to match the WP Gyani design system (used via comments_template()
 * in single.php / page.php). Handles: password-protected posts, the
 * comment count heading, a card-style threaded comment list, and a
 * restyled comment form. Closed-comments and no-comments states are
 * handled by comment_form() itself via its args below.
 *
 * @package WP_Gyani
 */

if (post_password_required()) {
    ?>
    <div class="p-6 rounded-2xl bg-offwhite dark:bg-gray-800 border border-bordercolor dark:border-gray-700 text-center">
        <p class="font-inter text-textmuted dark:text-gray-400 text-sm">This post is password protected. Enter the password to view comments.</p>
    </div>
    <?php
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()): ?>
        <h2 class="font-manrope font-extrabold text-2xl text-charcoal dark:text-white mb-6">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    /* translators: %s: post title */
                    esc_html__('One Response to %s', 'wp-gyani'),
                    '<span class="text-teal">&ldquo;' . esc_html(get_the_title()) . '&rdquo;</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count, 2: post title */
                    esc_html(_nx('%1$s Response to %2$s', '%1$s Responses to %2$s', $comment_count, 'comments title', 'wp-gyani')),
                    esc_html(number_format_i18n($comment_count)),
                    '<span class="text-teal">&ldquo;' . esc_html(get_the_title()) . '&rdquo;</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list space-y-4">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 44,
                'callback'    => 'wp_gyani_comment_callback',
            ));
            ?>
        </ol>

        <?php
        $cpage = get_query_var('cpage', 1);
        the_comments_pagination(array(
            'prev_text' => '&larr; Newer',
            'next_text' => 'Older &rarr;',
            'screen_reader_text' => '',
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="font-inter text-textmuted dark:text-gray-400 text-sm mt-8 py-4 border-t border-bordercolor dark:border-gray-700">Comments are closed.</p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => __('Leave a Reply', 'wp-gyani'),
        'title_reply_to'       => __('Leave a Reply to %s', 'wp-gyani'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title font-manrope font-extrabold text-xl text-charcoal dark:text-white mb-1">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_link'    => __('Cancel Reply', 'wp-gyani'),
        'cancel_reply_before'  => '<span class="ml-2 text-xs font-bold text-teal hover:text-teal-dark cursor-pointer">',
        'cancel_reply_after'   => '</span>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'class_form'           => 'comment-form mt-10 pt-8 border-t border-bordercolor dark:border-gray-700 space-y-4',
        'class_submit'         => 'submit',
        'label_submit'         => __('Post Comment', 'wp-gyani'),
        'comment_field'        => '
            <p class="comment-form-comment">
                <label for="comment" class="block font-manrope font-bold text-xs uppercase tracking-wider text-charcoal dark:text-white mb-2">Comment <span class="text-teal">*</span></label>
                <textarea id="comment" name="comment" rows="6" required
                    class="w-full px-4 py-3 rounded-xl border border-bordercolor dark:border-gray-600 bg-offwhite dark:bg-gray-700 text-charcoal dark:text-white font-inter text-sm focus:outline-none focus:border-teal focus:bg-white dark:focus:bg-gray-800 transition-colors resize-y"></textarea>
            </p>',
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '
                <p class="comment-form-author">
                    <label for="author" class="block font-manrope font-bold text-xs uppercase tracking-wider text-charcoal dark:text-white mb-2">Name <span class="text-teal">*</span></label>
                    <input id="author" name="author" type="text" value="' . esc_attr(isset($commenter['comment_author']) ? $commenter['comment_author'] : '') . '" required
                        class="w-full px-4 py-2.5 rounded-xl border border-bordercolor dark:border-gray-600 bg-offwhite dark:bg-gray-700 text-charcoal dark:text-white font-inter text-sm focus:outline-none focus:border-teal focus:bg-white dark:focus:bg-gray-800 transition-colors">
                </p>',
            'email' => '
                <p class="comment-form-email">
                    <label for="email" class="block font-manrope font-bold text-xs uppercase tracking-wider text-charcoal dark:text-white mb-2">Email <span class="text-teal">*</span></label>
                    <input id="email" name="email" type="email" value="' . esc_attr(isset($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '') . '" required
                        class="w-full px-4 py-2.5 rounded-xl border border-bordercolor dark:border-gray-600 bg-offwhite dark:bg-gray-700 text-charcoal dark:text-white font-inter text-sm focus:outline-none focus:border-teal focus:bg-white dark:focus:bg-gray-800 transition-colors">
                </p>',
            'url' => '
                <p class="comment-form-url">
                    <label for="url" class="block font-manrope font-bold text-xs uppercase tracking-wider text-charcoal dark:text-white mb-2">Website</label>
                    <input id="url" name="url" type="url" value="' . esc_attr(isset($commenter['comment_author_url']) ? $commenter['comment_author_url'] : '') . '"
                        class="w-full px-4 py-2.5 rounded-xl border border-bordercolor dark:border-gray-600 bg-offwhite dark:bg-gray-700 text-charcoal dark:text-white font-inter text-sm focus:outline-none focus:border-teal focus:bg-white dark:focus:bg-gray-800 transition-colors">
                </p>',
        )),
        'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s px-6 py-3 rounded-xl bg-teal text-white font-manrope font-bold text-sm hover:bg-teal-dark transition-all">%4$s</button>',
        'submit_field'  => '<p class="form-submit flex items-center gap-4">%1$s %2$s</p>',
        'logged_in_as'  => sprintf(
            '<p class="logged-in-as font-inter text-sm text-textmuted dark:text-gray-400 mb-4">%s <a href="%s" class="text-teal font-semibold hover:text-teal-dark">%s</a>. %s</p>',
            sprintf(esc_html__('Logged in as %s.', 'wp-gyani'), '<span class="text-charcoal dark:text-white font-semibold">' . esc_html(wp_get_current_user()->display_name) . '</span>'),
            esc_url(get_edit_user_link()),
            esc_html__('Edit your profile', 'wp-gyani'),
            sprintf(
                '<a href="%s" class="text-teal font-semibold hover:text-teal-dark">%s</a>',
                esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink()))),
                esc_html__('Log out?', 'wp-gyani')
            )
        ),
    ));
    ?>
</div>

<style>
    /* Nested-reply spacing for the custom comment callback in functions.php */
    .comment-list .children { list-style: none; margin: 0; padding: 0; }
    .comment-text p { margin-bottom: 0.75em; }
    .comment-text p:last-child { margin-bottom: 0; }
</style>
