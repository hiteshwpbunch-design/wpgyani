<?php
/**
 * WP Gyani Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

function wp_gyani_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'wp-gyani'),
        'footer' => __('Footer Menu', 'wp-gyani'),
    ));
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'wp_gyani_setup');

function wp_gyani_scripts() {
    wp_enqueue_style('wp-gyani-style', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap', array(), null);
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false);
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    wp_enqueue_script('scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);
    wp_enqueue_script('wp-gyani-main', get_template_directory_uri() . '/assets/js/main.js', array('tailwindcss', 'gsap', 'scrolltrigger'), '1.0.0', true);
    
    // Pass AJAX URL to JS
    wp_localize_script('wp-gyani-main', 'wpgyani_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    
    wp_add_inline_script('tailwindcss', "
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        teal: {
                            DEFAULT: '#4EAAA7',
                            dark: '#408F8C',
                            light: 'var(--color-teal-light)',
                            subtle: 'var(--color-teal-subtle)',
                        },
                        charcoal: {
                            DEFAULT: 'var(--color-text-charcoal)',
                            heading: 'var(--color-text-heading)',
                            muted: 'var(--color-text-muted)',
                        },
                        offwhite: 'var(--color-bg-offwhite)',
                        bordercolor: 'var(--color-border)',
                        textmuted: 'var(--color-text-muted)',
                    },
                    fontFamily: {
                        manrope: ['Manrope', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px rgba(51, 51, 51, 0.04)',
                        'card-hover': '0 12px 30px rgba(78, 170, 167, 0.12)',
                        'modal': '0 20px 50px rgba(0, 0, 0, 0.15)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    ");
}
add_action('wp_enqueue_scripts', 'wp_gyani_scripts');

// AJAX Search Handler
function wpgyani_ajax_search() {
    $search_term = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    
    if (empty($search_term)) {
        wp_send_json_success(array());
    }

    $args = array(
        's' => $search_term,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 5,
    );

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $category = get_the_category();
            $cat_name = !empty($category) ? $category[0]->name : 'Tutorial';
            
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'cat' => $cat_name
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success($results);
}
add_action('wp_ajax_wpgyani_search', 'wpgyani_ajax_search');
add_action('wp_ajax_nopriv_wpgyani_search', 'wpgyani_ajax_search');

function wp_gyani_customizer_register($wp_customize) {
    $wp_customize->add_section('wp_gyani_hero', array(
        'title' => __('Hero Section', 'wp-gyani'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_eyebrow', array('default' => 'WORDPRESS KNOWLEDGE HUB'));
    $wp_customize->add_control('hero_eyebrow', array(
        'label' => __('Hero Eyebrow Text', 'wp-gyani'),
        'section' => 'wp_gyani_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_headline', array('default' => 'Learn WordPress.<br>Build Better Websites.'));
    $wp_customize->add_control('hero_headline', array(
        'label' => __('Hero Headline', 'wp-gyani'),
        'section' => 'wp_gyani_hero',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_description', array('default' => 'Practical WordPress tutorials, guides, tools and resources for beginners, creators, developers and website owners.'));
    $wp_customize->add_control('hero_description', array(
        'label' => __('Hero Description', 'wp-gyani'),
        'section' => 'wp_gyani_hero',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('newsletter_description', array('default' => 'Weekly actionable WordPress tutorials, speed tweaks, security alerts, and resources delivered straight to your inbox. No spam ever.'));
    $wp_customize->add_control('newsletter_description', array(
        'label' => __('Newsletter Description', 'wp-gyani'),
        'section' => 'wp_gyani_hero',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'wp_gyani_customizer_register');

function wp_gyani_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time;
}

function wp_gyani_fallback_menu() {
    echo '<ul class="nav-menu">';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 2,
    ));
    echo '</ul>';
}


/**
 * Custom comment markup used by comments.php (passed to wp_list_comments()
 * as the 'callback' argument) so comments match the WP Gyani design system
 * instead of WordPress's unstyled default output.
 */
function wp_gyani_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo esc_attr($tag); ?> <?php comment_class($depth > 1 ? 'ml-6 md:ml-12 mt-4' : 'mt-4'); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="p-5 md:p-6 rounded-2xl bg-white dark:bg-gray-800 border border-bordercolor dark:border-gray-700">
            <?php if ('0' == $comment->comment_approved): ?>
                <p class="text-xs font-semibold text-teal-dark dark:text-teal bg-teal-light dark:bg-teal-900/50 inline-block px-3 py-1 rounded-lg mb-3">Your comment is awaiting moderation.</p>
            <?php endif; ?>
            <div class="flex items-start gap-3">
                <?php echo get_avatar($comment, 44, '', '', array('class' => 'rounded-full border border-bordercolor dark:border-gray-700 flex-shrink-0')); ?>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-baseline gap-x-2">
                        <span class="font-manrope font-bold text-sm text-charcoal dark:text-white"><?php comment_author(); ?></span>
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="text-xs text-textmuted dark:text-gray-400 hover:text-teal transition-colors">
                            <?php echo esc_html(get_comment_date('', $comment)); ?> at <?php echo esc_html(get_comment_time()); ?>
                        </a>
                        <?php edit_comment_link(__('Edit'), '<span class="text-xs text-textmuted dark:text-gray-400">&bull; </span><span class="text-xs text-teal font-semibold hover:text-teal-dark">', '</span>'); ?>
                    </div>
                    <div class="font-inter text-sm text-charcoal dark:text-gray-300 leading-relaxed mt-2 comment-text">
                        <?php comment_text(); ?>
                    </div>
                    <div class="mt-2">
                        <?php
                        comment_reply_link(array_merge($args, array(
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'reply_text' => '<span class="inline-flex items-center gap-1">Reply <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>',
                            'before'    => '',
                            'after'     => '',
                            'class'     => 'text-xs font-bold font-manrope text-teal hover:text-teal-dark transition-colors',
                        )));
                        ?>
                    </div>
                </div>
            </div>
        </article>
    <?php
    // WordPress's Walker_Comment::end_el() automatically closes the outer
    // <li> (or <div>, per $args['style']) after this callback returns —
    // only the inner <article> markup we opened above needs closing here.
}

/**
 * Handle custom sorting on blog/archive pages via 'sort' GET parameter.
 */
function wp_gyani_sort_blog_posts($query) {
    if (!is_admin() && $query->is_main_query() && (is_home() || is_archive() || is_search())) {
        if (isset($_GET['sort'])) {
            $sort = sanitize_text_field($_GET['sort']);
            switch ($sort) {
                case 'oldest':
                    $query->set('orderby', 'date');
                    $query->set('order', 'ASC');
                    break;
                case 'popular':
                    $query->set('orderby', 'comment_count');
                    $query->set('order', 'DESC');
                    break;
                case 'az':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                case 'newest':
                default:
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'wp_gyani_sort_blog_posts');

/**
 * Category Image Uploader
 */
// 1. Add fields to "Add New Category" screen
function wp_gyani_add_category_image_field() {
    ?>
    <div class="form-field term-image-wrap">
        <label for="category-image-id"><?php _e('Category Image', 'wp-gyani'); ?></label>
        <input type="hidden" id="category-image-id" name="category_image_id" value="">
        <div id="category-image-wrapper" style="margin-bottom:10px;"></div>
        <p>
            <input type="button" class="button button-secondary wp_gyani_upload_image_btn" id="wp_gyani_upload_image_btn" value="<?php _e('Add Image', 'wp-gyani'); ?>" />
            <input type="button" class="button button-secondary wp_gyani_remove_image_btn" id="wp_gyani_remove_image_btn" value="<?php _e('Remove Image', 'wp-gyani'); ?>" style="display:none;" />
        </p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'wp_gyani_add_category_image_field', 10, 2);

// 2. Add fields to "Edit Category" screen
function wp_gyani_edit_category_image_field($term) {
    $image_id = get_term_meta($term->term_id, '_wp_gyani_category_image_id', true);
    $image_html = '';
    if ($image_id) {
        $image_html = wp_get_attachment_image($image_id, 'thumbnail');
    }
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="category-image-id"><?php _e('Category Image', 'wp-gyani'); ?></label></th>
        <td>
            <input type="hidden" id="category-image-id" name="category_image_id" value="<?php echo esc_attr($image_id); ?>">
            <div id="category-image-wrapper" style="margin-bottom:10px;"><?php echo $image_html; ?></div>
            <p>
                <input type="button" class="button button-secondary wp_gyani_upload_image_btn" id="wp_gyani_upload_image_btn" value="<?php _e('Add/Change Image', 'wp-gyani'); ?>" />
                <input type="button" class="button button-secondary wp_gyani_remove_image_btn" id="wp_gyani_remove_image_btn" value="<?php _e('Remove Image', 'wp-gyani'); ?>" <?php echo !$image_id ? 'style="display:none;"' : ''; ?> />
            </p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'wp_gyani_edit_category_image_field', 10, 2);

// 3. Save the image ID
function wp_gyani_save_category_image($term_id) {
    if (isset($_POST['category_image_id'])) {
        update_term_meta($term_id, '_wp_gyani_category_image_id', absint($_POST['category_image_id']));
    }
}
add_action('created_category', 'wp_gyani_save_category_image', 10, 2);
add_action('edited_category', 'wp_gyani_save_category_image', 10, 2);

// 4. Enqueue media uploader script on taxonomy screens
function wp_gyani_category_image_admin_scripts($hook) {
    if ($hook == 'edit-tags.php' || $hook == 'term.php') {
        wp_enqueue_media();
        wp_add_inline_script('jquery', '
            jQuery(document).ready(function($){
                var frame;
                $(".wp_gyani_upload_image_btn").on("click", function(e) {
                    e.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media({
                        title: "Select or Upload Media",
                        button: { text: "Use this media" },
                        multiple: false
                    });
                    frame.on("select", function() {
                        var attachment = frame.state().get("selection").first().toJSON();
                        $("#category-image-id").val(attachment.id);
                        $("#category-image-wrapper").html("<img src=\'" + attachment.url + "\' style=\'max-width:150px;height:auto;\'/>");
                        $(".wp_gyani_remove_image_btn").show();
                    });
                    frame.open();
                });
                $(".wp_gyani_remove_image_btn").on("click", function(e) {
                    e.preventDefault();
                    $("#category-image-id").val("");
                    $("#category-image-wrapper").html("");
                    $(this).hide();
                });
            });
        ');
    }
}
add_action('admin_enqueue_scripts', 'wp_gyani_category_image_admin_scripts');

// Include custom meta boxes for About Us page
require_once get_template_directory() . '/inc/meta-boxes-about.php';

// Fix WebP upload error on servers without WebP GD support
add_filter('file_is_displayable_image', function($result, $path) {
    if (pathinfo($path, PATHINFO_EXTENSION) === 'webp') {
        return false;
    }
    return $result;
}, 10, 2);

