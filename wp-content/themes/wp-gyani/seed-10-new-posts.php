<?php
/**
 * WP Gyani — 10 New Scheduled SEO Posts Seeder
 */

if (php_sapi_name() === 'cli' && !defined('ABSPATH')) {
    require_once dirname(__FILE__) . '/../../../wp-load.php';
}

function wp_gyani_seed_scheduled_seo_posts() {
    $posts_data = array(
        array(
            'category' => 'WordPress Basics',
            'slug' => 'wordpress-website-cost-2026',
            'title' => 'WordPress Website Cost in 2026: Complete Pricing Guide for Beginners',
            'date' => '2026-08-24 09:15:00',
            'keyword' => 'WordPress website cost',
            'seo_title' => 'WordPress Website Cost 2026: Complete Beginner\'s Pricing Guide',
            'meta_desc' => 'Wondering about WordPress website cost? Read our complete 2026 pricing guide for beginners covering domains, hosting, plugins, themes, and development.',
        ),
        array(
            'category' => 'WordPress Basics',
            'slug' => 'install-wordpress-on-localhost',
            'title' => 'How to Install WordPress on Localhost: Step-by-Step Guide',
            'date' => '2026-08-27 09:30:00',
            'keyword' => 'install WordPress on localhost',
            'seo_title' => 'How to Install WordPress on Localhost: Step-by-Step Guide',
            'meta_desc' => 'Learn how to easily install WordPress on localhost using XAMPP. A complete step-by-step local development guide for beginners and developers.',
        ),
        array(
            'category' => 'Elementor',
            'slug' => 'elementor-vs-gutenberg',
            'title' => 'Elementor vs Gutenberg in 2026: Which WordPress Editor Should You Use?',
            'date' => '2026-08-30 09:45:00',
            'keyword' => 'Elementor vs Gutenberg',
            'seo_title' => 'Elementor vs Gutenberg 2026: Which Editor is Best for You?',
            'meta_desc' => 'Elementor vs Gutenberg: Which is the best WordPress editor? Compare ease of use, performance, speed, and features to make the right choice.',
        ),
        array(
            'category' => 'WordPress SEO',
            'slug' => 'wordpress-meta-title-meta-description',
            'title' => 'How to Add SEO Meta Title and Meta Description in WordPress',
            'date' => '2026-09-02 10:00:00',
            'keyword' => 'WordPress meta title and description',
            'seo_title' => 'How to Add SEO Meta Title and Meta Description in WordPress',
            'meta_desc' => 'Learn how to easily add an SEO meta title and meta description in WordPress using plugins like Yoast and Rank Math to boost your Google rankings.',
        ),
        array(
            'category' => 'WordPress Performance',
            'slug' => 'speed-up-wordpress-website',
            'title' => 'How to Speed Up WordPress Website: 15 Proven Performance Tips',
            'date' => '2026-09-05 10:15:00',
            'keyword' => 'speed up WordPress website',
            'seo_title' => 'How to Speed Up WordPress Website: 15 Proven Tips',
            'meta_desc' => 'Need to speed up your WordPress website? Follow our 15 proven performance optimization tips covering caching, images, and Core Web Vitals.',
        ),
        array(
            'category' => 'WordPress Security',
            'slug' => 'wordpress-security-guide',
            'title' => 'WordPress Security Guide: 20 Ways to Protect Your Website',
            'date' => '2026-09-08 10:30:00',
            'keyword' => 'WordPress security',
            'seo_title' => 'WordPress Security Guide: 20 Ways to Protect Your Website',
            'meta_desc' => 'The ultimate WordPress security guide for 2026. Discover 20 actionable ways to protect your website from malware, hackers, and brute force attacks.',
        ),
        array(
            'category' => 'Elementor',
            'slug' => 'responsive-website-with-elementor',
            'title' => 'How to Create a Responsive Website with Elementor',
            'date' => '2026-09-11 10:45:00',
            'keyword' => 'responsive Elementor website',
            'seo_title' => 'How to Create a Responsive Website with Elementor',
            'meta_desc' => 'Learn how to build a fully responsive Elementor website for mobile and tablet devices. Discover expert tips for fonts, spacing, and hidden elements.',
        ),
        array(
            'category' => 'WordPress Plugins',
            'slug' => 'best-wordpress-plugins-2026',
            'title' => '15 Best WordPress Plugins Every Website Should Consider in 2026',
            'date' => '2026-09-14 11:00:00',
            'keyword' => 'best WordPress plugins',
            'seo_title' => '15 Best WordPress Plugins Every Website Needs in 2026',
            'meta_desc' => 'Discover the 15 best WordPress plugins for SEO, security, performance, and page building. Essential tools every WordPress website should consider.',
        ),
        array(
            'category' => 'WooCommerce',
            'slug' => 'create-online-store-with-woocommerce',
            'title' => 'How to Create an Online Store with WooCommerce: Beginner\'s Guide',
            'date' => '2026-09-17 09:20:00',
            'keyword' => 'create WooCommerce store',
            'seo_title' => 'How to Create an Online Store with WooCommerce (Guide)',
            'meta_desc' => 'Learn how to create a profitable online store with WooCommerce. Our beginner\'s guide covers installation, products, payments, and shipping setup.',
        ),
        array(
            'category' => 'WordPress Development',
            'slug' => 'wordpress-child-theme-guide',
            'title' => 'WordPress Child Theme Explained: Why and When You Should Use One',
            'date' => '2026-09-20 09:40:00',
            'keyword' => 'WordPress child theme',
            'seo_title' => 'WordPress Child Theme Guide: Why & When You Need One',
            'meta_desc' => 'What is a WordPress child theme? Learn exactly why, when, and how to use child themes to safely customize your WordPress website design.',
        ),
    );

    $inserted = 0;
    $author_id = get_current_user_id() ?: 1;

    foreach ($posts_data as $data) {
        $term = get_term_by('slug', sanitize_title($data['category']), 'category');
        if (!$term) {
            $term_inserted = wp_insert_term($data['category'], 'category', array('slug' => sanitize_title($data['category'])));
            $cat_id = is_wp_error($term_inserted) ? 0 : $term_inserted['term_id'];
        } else {
            $cat_id = $term->term_id;
        }

        $post_id = wp_insert_post(array(
            'post_name'    => $data['slug'],
            'post_title'   => $data['title'],
            'post_content' => '<h2>Introduction</h2><p>This is a placeholder for the full SEO optimized article. The full content will be added shortly.</p>',
            'post_status'  => 'publish', // or 'future' if dates are in future. In WP, setting publish with a future date often just makes it 'future', but we can force 'publish' if we want it visible now, or just let WP schedule it.
            'post_type'    => 'post',
            'post_author'  => $author_id,
            'post_date'    => $data['date'],
            'meta_input'   => array(
                '_yoast_wpseo_title'    => $data['seo_title'],
                '_yoast_wpseo_metadesc' => $data['meta_desc'],
                '_yoast_wpseo_focuskw'  => $data['keyword']
            )
        ));

        // If date is in the future, WP will set status to 'future' (Scheduled).
        
        if ($post_id && !is_wp_error($post_id)) {
            if ($cat_id) {
                wp_set_object_terms($post_id, array((int) $cat_id), 'category');
            }
            $inserted++;
            echo "Inserted/Scheduled: " . $data['title'] . " for " . $data['date'] . "\n";
        }
    }

    echo "\nSuccessfully scheduled {$inserted} new SEO posts.\n";
}

wp_gyani_seed_scheduled_seo_posts();
