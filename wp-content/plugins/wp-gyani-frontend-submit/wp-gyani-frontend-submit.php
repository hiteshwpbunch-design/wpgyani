<?php
/**
 * Plugin Name: WP Gyani Frontend Submit
 * Description: Provides frontend login, registration, and blog submission for WP Gyani contributors.
 * Version: 1.0.0
 * Author: WP Gyani
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle form submissions
 */
function wpgfs_handle_form_submissions() {
    // Handle Registration
    if (isset($_POST['wpgfs_register_submit']) && wp_verify_nonce($_POST['wpgfs_register_nonce'], 'wpgfs_register_action')) {
        $username = sanitize_user($_POST['wpgfs_username']);
        $email = sanitize_email($_POST['wpgfs_email']);
        $password = $_POST['wpgfs_password'];
        
        if (username_exists($username) || email_exists($email)) {
            wp_redirect(add_query_arg('wpgfs_error', 'exists'));
            exit;
        }

        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            // Assign Contributor role
            $user = new WP_User($user_id);
            $user->set_role('contributor');
            
            // Auto login
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_redirect(home_url('/submit-blog/'));
            exit;
        }
    }

    // Handle Login
    if (isset($_POST['wpgfs_login_submit']) && wp_verify_nonce($_POST['wpgfs_login_nonce'], 'wpgfs_login_action')) {
        $creds = array(
            'user_login'    => sanitize_user($_POST['wpgfs_log']),
            'user_password' => $_POST['wpgfs_pwd'],
            'remember'      => true
        );
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            wp_redirect(add_query_arg('wpgfs_error', 'login_failed'));
            exit;
        } else {
            wp_redirect(home_url('/submit-blog/'));
            exit;
        }
    }

    // Handle Post Submission
    if (isset($_POST['wpgfs_post_submit']) && wp_verify_nonce($_POST['wpgfs_post_nonce'], 'wpgfs_post_action')) {
        if (!is_user_logged_in() || !current_user_can('edit_posts')) {
            wp_die('Unauthorized');
        }

        $title = sanitize_text_field($_POST['post_title']);
        $content = wp_kses_post($_POST['post_content']);
        $category_id = isset($_POST['post_category']) ? absint($_POST['post_category']) : 0;
        $tags = isset($_POST['post_tags']) ? sanitize_text_field($_POST['post_tags']) : '';

        $post_data = array(
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'pending',
            'post_author'  => get_current_user_id(),
            'post_category'=> array($category_id),
            'tags_input'   => $tags
        );

        $post_id = wp_insert_post($post_data);

        if (!is_wp_error($post_id)) {
            // Handle Featured Image
            if (!empty($_FILES['post_image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                $attachment_id = media_handle_upload('post_image', $post_id);
                if (!is_wp_error($attachment_id)) {
                    set_post_thumbnail($post_id, $attachment_id);
                }
            }

            // Send Email Notification to Admin
            $admin_email = get_option('admin_email');
            $author = wp_get_current_user();
            $subject = 'New Blog Submitted for Review';
            $edit_link = admin_url('post.php?post=' . $post_id . '&action=edit');
            $message = sprintf(
                "A new blog post has been submitted by %s and is awaiting review.\n\nTitle: %s\n\nReview and publish it here:\n%s",
                $author->display_name,
                $title,
                $edit_link
            );
            wp_mail($admin_email, $subject, $message);

            wp_redirect(add_query_arg('wpgfs_success', '1'));
            exit;
        } else {
            wp_redirect(add_query_arg('wpgfs_error', 'submission_failed'));
            exit;
        }
    }
}
add_action('init', 'wpgfs_handle_form_submissions');

/**
 * Registration Shortcode
 */
function wpgfs_register_shortcode() {
    if (is_user_logged_in()) {
        return '<p class="text-teal font-medium">You are already logged in. <a href="'.home_url('/submit-blog/').'" class="underline">Submit a blog post</a></p>';
    }

    ob_start();
    ?>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-soft border border-bordercolor dark:border-gray-700">
        <h2 class="text-2xl font-manrope font-extrabold text-charcoal dark:text-white mb-6">Become a Contributor</h2>
        <?php if (isset($_GET['wpgfs_error']) && $_GET['wpgfs_error'] == 'exists'): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium">Username or email already exists.</div>
        <?php endif; ?>
        <form method="post" action="">
            <?php wp_nonce_field('wpgfs_register_action', 'wpgfs_register_nonce'); ?>
            <div class="mb-4">
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Username</label>
                <input type="text" name="wpgfs_username" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="wpgfs_email" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Password</label>
                <input type="password" name="wpgfs_password" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>
            <button type="submit" name="wpgfs_register_submit" class="w-full py-3 rounded-xl bg-teal text-white font-manrope font-bold hover:bg-teal-dark transition-colors">Register</button>
        </form>
        <div class="mt-6 text-center text-sm font-medium text-charcoal dark:text-gray-300">
            Already registered? <a href="<?php echo esc_url(home_url('/login/')); ?>" class="text-teal hover:underline font-bold">Login here</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpgfs_register', 'wpgfs_register_shortcode');

/**
 * Login Shortcode
 */
function wpgfs_login_shortcode() {
    if (is_user_logged_in()) {
        return '<p class="text-teal font-medium">You are already logged in. <a href="'.home_url('/submit-blog/').'" class="underline">Submit a blog post</a></p>';
    }

    ob_start();
    ?>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-soft border border-bordercolor dark:border-gray-700">
        <h2 class="text-2xl font-manrope font-extrabold text-charcoal dark:text-white mb-6">Login</h2>
        <?php if (isset($_GET['wpgfs_error']) && $_GET['wpgfs_error'] == 'login_failed'): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium">Invalid credentials.</div>
        <?php endif; ?>
        <form method="post" action="">
            <?php wp_nonce_field('wpgfs_login_action', 'wpgfs_login_nonce'); ?>
            <div class="mb-4">
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Username or Email</label>
                <input type="text" name="wpgfs_log" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Password</label>
                <input type="password" name="wpgfs_pwd" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>
            <button type="submit" name="wpgfs_login_submit" class="w-full py-3 rounded-xl bg-teal text-white font-manrope font-bold hover:bg-teal-dark transition-colors">Login</button>
        </form>
        <div class="mt-6 text-center text-sm font-medium text-charcoal dark:text-gray-300">
            Need an account? <a href="<?php echo esc_url(home_url('/register/')); ?>" class="text-teal hover:underline font-bold">Register here</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpgfs_login', 'wpgfs_login_shortcode');

/**
 * Submit Blog Shortcode
 */
function wpgfs_submit_blog_shortcode() {
    if (!is_user_logged_in() || !current_user_can('edit_posts')) {
        return '<div class="max-w-2xl mx-auto text-center"><p class="text-lg mb-4 text-charcoal dark:text-white">You must be logged in as a contributor to submit a blog post.</p><a href="'.home_url('/login/').'" class="inline-block bg-teal text-white px-6 py-2 rounded-xl font-bold">Login</a> or <a href="'.home_url('/register/').'" class="inline-block border border-teal text-teal px-6 py-2 rounded-xl font-bold ml-2">Register</a></div>';
    }

    ob_start();
    ?>
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 md:p-10 rounded-[2rem] shadow-soft border border-bordercolor dark:border-gray-700">
        <h2 class="text-3xl font-manrope font-extrabold text-charcoal dark:text-white mb-2">Submit New Blog Post</h2>
        <p class="text-textmuted dark:text-gray-400 mb-8">Your post will be saved as a draft and sent to the editor for review.</p>
        
        <?php if (isset($_GET['wpgfs_success']) && $_GET['wpgfs_success'] == '1'): ?>
            <div class="bg-teal-light/30 border border-teal text-teal-dark dark:text-teal-light p-4 rounded-xl mb-8 font-medium flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Success! Your blog post has been submitted for review. You will be notified once it is published.
            </div>
        <?php endif; ?>

        <form method="post" action="" enctype="multipart/form-data" class="space-y-6">
            <?php wp_nonce_field('wpgfs_post_action', 'wpgfs_post_nonce'); ?>
            
            <div>
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Post Title</label>
                <input type="text" name="post_title" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
            </div>

            <div>
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Content</label>
                <?php 
                $settings = array(
                    'media_buttons' => false,
                    'textarea_rows' => 15,
                    'editor_class'  => 'w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal',
                    'quicktags'     => false
                );
                wp_editor('', 'post_content', $settings); 
                ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Featured Image</label>
                <input type="file" name="post_image" accept="image/jpeg,image/png,image/webp" class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-light file:text-teal-dark hover:file:bg-teal hover:file:text-white transition-colors cursor-pointer text-charcoal dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-xl p-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Category</label>
                    <?php 
                    wp_dropdown_categories(array(
                        'name' => 'post_category',
                        'hide_empty' => 0,
                        'class' => 'w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal'
                    )); 
                    ?>
                </div>
                <div>
                    <label class="block text-sm font-bold text-charcoal dark:text-gray-300 mb-2">Tags (comma separated)</label>
                    <input type="text" name="post_tags" placeholder="e.g. WordPress, SEO, Design" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent text-charcoal dark:text-white focus:outline-none focus:border-teal">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" name="wpgfs_post_submit" class="w-full md:w-auto px-8 py-3 rounded-xl bg-teal text-white font-manrope font-bold text-lg hover:bg-teal-dark transition-colors shadow-sm">Submit for Review</button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpgfs_submit_blog', 'wpgfs_submit_blog_shortcode');

/**
 * Auto-create pages on plugin activation
 */
register_activation_hook(__FILE__, 'wpgfs_plugin_activate');
function wpgfs_plugin_activate() {
    $pages = array(
        'Submit Blog' => '[wpgfs_submit_blog]',
        'Login' => '[wpgfs_login]',
        'Register' => '[wpgfs_register]'
    );

    foreach ($pages as $title => $content) {
        $page_check = get_page_by_title($title);
        if (!isset($page_check->ID)) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1
            ));
        }
    }
}

/**
 * Restrict Admin Access and Hide Admin Bar for non-admins
 */
add_action('admin_init', 'wpgfs_restrict_admin_access');
function wpgfs_restrict_admin_access() {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }
    if (!current_user_can('manage_options')) {
        wp_redirect(home_url('/submit-blog/'));
        exit;
    }
}

add_action('after_setup_theme', 'wpgfs_hide_admin_bar');
function wpgfs_hide_admin_bar() {
    if (!current_user_can('manage_options') && !is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Admin Notifications Tab for Pending Blogs
 */
add_action('admin_menu', 'wpgfs_admin_notification_menu');
function wpgfs_admin_notification_menu() {
    // Count pending posts to show a notification bubble
    $pending_count = wp_count_posts('post')->pending;
    $menu_title = 'Notifications' . ($pending_count > 0 ? ' <span class="update-plugins count-' . $pending_count . '"><span class="plugin-count">' . $pending_count . '</span></span>' : '');

    add_menu_page(
        'Pending Blogs',
        $menu_title,
        'manage_options',
        'wpgfs-notifications',
        'wpgfs_notifications_page',
        'dashicons-bell', // Bell icon
        2 // High up in the menu
    );
}

function wpgfs_notifications_page() {
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Pending Blog Submissions</h1>
        <hr class="wp-header-end">
        <p>Review the blog posts submitted by your contributors below.</p>
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'pending',
            'posts_per_page' => -1
        );
        $pending_posts = new WP_Query($args);

        if ($pending_posts->have_posts()) {
            echo '<table class="wp-list-table widefat fixed striped table-view-list posts" style="margin-top: 15px;">';
            echo '<thead><tr><th>Title</th><th>Author</th><th>Email</th><th>Date Submitted</th><th>Action</th></tr></thead>';
            echo '<tbody id="the-list">';
            while ($pending_posts->have_posts()) {
                $pending_posts->the_post();
                $author_name = get_the_author();
                $author_email = get_the_author_meta('user_email');
                $edit_url = get_edit_post_link(get_the_ID());
                $preview_url = get_preview_post_link(get_the_ID());
                echo '<tr>';
                echo '<td><strong><a href="' . esc_url($edit_url) . '">' . get_the_title() . '</a></strong></td>';
                echo '<td>' . esc_html($author_name) . '</td>';
                echo '<td><a href="mailto:' . esc_attr($author_email) . '">' . esc_html($author_email) . '</a></td>';
                echo '<td>' . get_the_date() . ' at ' . get_the_time() . '</td>';
                echo '<td><a href="' . esc_url($edit_url) . '" class="button button-primary">Review & Publish</a> <a href="' . esc_url($preview_url) . '" class="button" target="_blank">Preview</a></td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
            wp_reset_postdata();
        } else {
            echo '<div class="notice notice-success inline" style="margin-top: 20px;"><p>No pending blogs to review. You are all caught up!</p></div>';
        }
        ?>
    </div>
    <?php
}

