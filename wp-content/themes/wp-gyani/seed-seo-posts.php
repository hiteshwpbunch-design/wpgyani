<?php
/**
 * WP Gyani — 10 SEO Posts Seeder
 */

if (php_sapi_name() === 'cli' && !defined('ABSPATH')) {
    require_once dirname(__FILE__) . '/../../../wp-load.php';
}

function wp_gyani_seed_10_seo_posts() {
    $posts_data = array(
        array(
            'category' => 'WordPress Basics',
            'slug' => 'wordpress-basics',
            'title' => 'WordPress for Beginners: Complete Guide to Building Your First Website',
            'excerpt' => 'Overwhelmed by building your first website? Our complete WordPress for beginners guide breaks down the process into simple, actionable steps so you can launch your site today without writing a single line of code.',
        ),
        array(
            'category' => 'WordPress Basics',
            'slug' => 'wordpress-basics',
            'title' => 'How to Install WordPress Step by Step',
            'excerpt' => 'Learn how to install WordPress quickly and easily on any web host. A complete step-by-step tutorial for beginners.',
        ),
        array(
            'category' => 'Elementor',
            'slug' => 'elementor',
            'title' => 'Elementor Tutorial: Build a Professional Website Without Coding',
            'excerpt' => 'Master Elementor with this comprehensive tutorial. Learn how to build stunning websites visually without any coding experience.',
        ),
        array(
            'category' => 'Elementor',
            'slug' => 'elementor',
            'title' => 'Best Elementor Widgets for Creating Modern Websites',
            'excerpt' => 'Discover the essential Elementor widgets you need to create engaging, modern, and highly functional WordPress websites.',
        ),
        array(
            'category' => 'Themes',
            'slug' => 'themes',
            'title' => '10 Best WordPress Themes for Fast and Professional Websites',
            'excerpt' => 'Explore the top 10 fastest and most customizable WordPress themes for building professional websites in 2026.',
        ),
        array(
            'category' => 'Plugins',
            'slug' => 'plugins',
            'title' => '15 Must-Have WordPress Plugins for Every Website',
            'excerpt' => 'A curated list of the 15 essential WordPress plugins that every website needs for security, speed, and SEO.',
        ),
        array(
            'category' => 'SEO',
            'slug' => 'seo',
            'title' => 'WordPress SEO Guide: How to Rank Your Website on Google',
            'excerpt' => 'The ultimate WordPress SEO guide to help you optimize your content, improve your rankings, and drive organic traffic from Google.',
        ),
        array(
            'category' => 'SEO',
            'slug' => 'seo',
            'title' => 'Best SEO Plugins for WordPress: Complete Comparison',
            'excerpt' => 'Compare the top WordPress SEO plugins including Yoast, Rank Math, and All in One SEO to find the best tool for your site.',
        ),
        array(
            'category' => 'Speed & Performance',
            'slug' => 'speed-performance',
            'title' => 'How to Speed Up WordPress Website: Complete Optimization Guide',
            'excerpt' => 'A step-by-step guide to speeding up your WordPress website, from caching plugins to server optimization.',
        ),
        array(
            'category' => 'Speed & Performance',
            'slug' => 'speed-performance',
            'title' => 'How to Improve WordPress Core Web Vitals and PageSpeed',
            'excerpt' => 'Learn how to fix LCP, FID, and CLS issues to achieve a perfect Core Web Vitals score on Google PageSpeed Insights.',
        ),
    );

    $days_ago = 0;
    $inserted = 0;
    $author_id = get_current_user_id() ?: 1;

    foreach ($posts_data as $data) {
        // Create or get category
        $term = get_term_by('slug', $data['slug'], 'category');
        if (!$term) {
            $term_inserted = wp_insert_term($data['category'], 'category', array('slug' => $data['slug']));
            $cat_id = is_wp_error($term_inserted) ? 0 : $term_inserted['term_id'];
        } else {
            $cat_id = $term->term_id;
        }

        $days_ago += 2; // Stagger dates by 2 days
        $post_date = gmdate('Y-m-d H:i:s', strtotime("-{$days_ago} days"));

        $post_id = wp_insert_post(array(
            'post_title'   => $data['title'],
            'post_excerpt' => $data['excerpt'],
            'post_content' => '<h2>Introduction</h2><p>' . $data['excerpt'] . '</p><p>This is a placeholder for the full SEO optimized article. The full content will be pasted here.</p>',
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_author'  => $author_id,
            'post_date'    => $post_date,
            'post_date_gmt'=> $post_date,
        ));

        if ($post_id && !is_wp_error($post_id)) {
            if ($cat_id) {
                wp_set_object_terms($post_id, array((int) $cat_id), 'category');
            }
            $inserted++;
            echo "Inserted: " . $data['title'] . "\n";
        }
    }

    echo "\nSuccessfully seeded {$inserted} new SEO posts.\n";
}

wp_gyani_seed_10_seo_posts();
