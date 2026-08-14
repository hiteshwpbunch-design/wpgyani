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
    
    wp_add_inline_script('tailwindcss', "
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        white: 'var(--color-bg-white)',
                        black: 'var(--color-text-heading)',
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
 * SEO: meta description, canonical URL, Open Graph / Twitter tags, and
 * rel=prev/next pagination hints for category archive ("inner") pages.
 *
 * WordPress core only auto-prints a canonical tag for singular posts/pages,
 * so category archives need their own — this fills that gap and keeps
 * paginated pages (page 2, 3...) from competing with page 1 in the index.
 */
function wp_gyani_category_seo_meta() {
    if (!is_category()) {
        return;
    }

    $term = get_queried_object();
    if (!$term || is_wp_error($term)) {
        return;
    }

    $paged = get_query_var('paged') ? (int) get_query_var('paged') : 1;

    $raw_desc = category_description($term->term_id);
    $description = $raw_desc
        ? wp_trim_words(wp_strip_all_tags($raw_desc), 30)
        : sprintf(
            'Browse %d %s tutorials and guides on WP Gyani. Practical, step-by-step WordPress articles to help you build, optimize, and troubleshoot faster.',
            (int) $term->count,
            $term->name
        );

    if ($paged > 1) {
        $description = sprintf('Page %d — %s', $paged, $description);
    }

    $canonical = $paged > 1 ? get_pagenum_link($paged) : get_category_link($term->term_id);
    $title     = $term->name . ' Tutorials & Guides' . ($paged > 1 ? ' - Page ' . $paged : '') . ' - WP Gyani';

    echo "\n<!-- WP Gyani SEO Meta -->\n";
    printf('<meta name="description" content="%s">' . "\n", esc_attr($description));
    printf('<link rel="canonical" href="%s">' . "\n", esc_url($canonical));
    printf('<meta property="og:type" content="website">' . "\n");
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr($title));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($description));
    printf('<meta property="og:url" content="%s">' . "\n", esc_url($canonical));
    printf('<meta name="twitter:card" content="summary_large_image">' . "\n");
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr($title));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($description));

    if ($paged > 1) {
        // Thin, duplicate-ish paginated pages shouldn't fight page 1 for rankings,
        // but should still be crawled so linked posts get discovered.
        echo '<meta name="robots" content="noindex,follow">' . "\n";
    }

    global $wp_query;
    if (!empty($wp_query->max_num_pages) && $wp_query->max_num_pages > 1) {
        if ($paged > 1) {
            printf('<link rel="prev" href="%s">' . "\n", esc_url(get_pagenum_link($paged - 1)));
        }
        if ($paged < $wp_query->max_num_pages) {
            printf('<link rel="next" href="%s">' . "\n", esc_url(get_pagenum_link($paged + 1)));
        }
    }
}
add_action('wp_head', 'wp_gyani_category_seo_meta', 5);

/**
 * SEO: Open Graph / Twitter tags for single posts.
 * (Canonical URL is already handled by WordPress core for singular posts.)
 */
function wp_gyani_single_post_seo_meta() {
    if (!is_singular('post')) {
        return;
    }

    $description = has_excerpt()
        ? wp_strip_all_tags(get_the_excerpt())
        : wp_trim_words(wp_strip_all_tags(get_the_content()), 30);

    $image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';

    echo "\n<!-- WP Gyani SEO Meta -->\n";
    printf('<meta name="description" content="%s">' . "\n", esc_attr($description));
    printf('<meta property="og:type" content="article">' . "\n");
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr(get_the_title()));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($description));
    printf('<meta property="og:url" content="%s">' . "\n", esc_url(get_permalink()));
    if ($image) {
        printf('<meta property="og:image" content="%s">' . "\n", esc_url($image));
    }
    printf('<meta property="article:published_time" content="%s">' . "\n", esc_attr(get_the_date('c')));
    printf('<meta property="article:modified_time" content="%s">' . "\n", esc_attr(get_the_modified_date('c')));
    printf('<meta name="twitter:card" content="%s">' . "\n", $image ? 'summary_large_image' : 'summary');
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr(get_the_title()));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($description));
}
add_action('wp_head', 'wp_gyani_single_post_seo_meta', 5);

/**
 * Custom comment markup used by comments.php (passed to wp_list_comments()
 * as the 'callback' argument) so comments match the WP Gyani design system
 * instead of WordPress's unstyled default output.
 */
function wp_gyani_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo esc_attr($tag); ?> <?php comment_class($depth > 1 ? 'ml-6 md:ml-12 mt-4' : 'mt-4'); ?> id="comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="p-5 md:p-6 rounded-2xl bg-white border border-bordercolor">
            <?php if ('0' == $comment->comment_approved): ?>
                <p class="text-xs font-semibold text-teal-dark bg-teal-light inline-block px-3 py-1 rounded-lg mb-3">Your comment is awaiting moderation.</p>
            <?php endif; ?>
            <div class="flex items-start gap-3">
                <?php echo get_avatar($comment, 44, '', '', array('class' => 'rounded-full border border-bordercolor flex-shrink-0')); ?>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-baseline gap-x-2">
                        <span class="font-manrope font-bold text-sm text-charcoal"><?php comment_author(); ?></span>
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="text-xs text-textmuted hover:text-teal transition-colors">
                            <?php echo esc_html(get_comment_date('', $comment)); ?> at <?php echo esc_html(get_comment_time()); ?>
                        </a>
                        <?php edit_comment_link(__('Edit'), '<span class="text-xs text-textmuted">&bull; </span><span class="text-xs text-teal font-semibold hover:text-teal-dark">', '</span>'); ?>
                    </div>
                    <div class="font-inter text-sm text-charcoal leading-relaxed mt-2 comment-text">
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
