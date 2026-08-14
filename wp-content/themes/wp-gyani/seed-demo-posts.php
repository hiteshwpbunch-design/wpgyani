<?php
/**
 * WP Gyani — Demo Content Seeder
 * -------------------------------
 * Creates 50 published blog posts and assigns each one to the correct
 * category (Speed & Performance, Elementor, Troubleshooting, SEO) so the
 * new category.php archive template has real content to display.
 *
 * This is a ONE-TIME utility script — it is NOT a theme template and
 * should not be left active on a live site.
 *
 * HOW TO RUN (pick one):
 *
 *   Option A — WP-CLI (recommended):
 *     wp eval-file seed-demo-posts.php
 *
 *   Option B — Temporary mu-plugin:
 *     Copy this file into wp-content/mu-plugins/seed-demo-posts.php,
 *     load the site once (any page), then DELETE the file. It guards
 *     itself with an option flag so it will not run twice.
 *
 * Safe to re-run: it checks a saved option and exits early if the seed
 * has already been done.
 */

if (!defined('ABSPATH')) {
    // Allow running as a plain script only via `wp eval-file`, which
    // already bootstraps WordPress before including this file.
    if (!function_exists('wp_insert_post')) {
        die("This script must be run through WP-CLI (wp eval-file seed-demo-posts.php)\nor placed in wp-content/mu-plugins/ so WordPress loads it.\n");
    }
}

function wp_gyani_seed_demo_posts() {

    if (get_option('wp_gyani_demo_posts_seeded')) {
        echo "Demo posts already seeded — skipping.\n";
        return;
    }

    // 1. Make sure the categories exist and grab their term IDs.
    $categories = array(
        'speed'           => 'Speed & Performance',
        'elementor'       => 'Elementor',
        'troubleshooting' => 'Troubleshooting',
        'seo'             => 'SEO',
    );

    $term_ids = array();
    foreach ($categories as $slug => $name) {
        $term = get_term_by('slug', $slug, 'category');
        if (!$term) {
            $inserted = wp_insert_term($name, 'category', array('slug' => $slug));
            $term_ids[$slug] = is_wp_error($inserted) ? 0 : $inserted['term_id'];
        } else {
            $term_ids[$slug] = $term->term_id;
        }
    }

    // 2. 50 realistic WordPress-tutorial titles, 12-13 per category.
    $posts_by_category = array(
        'speed' => array(
            'How to Speed Up Your WordPress Website: Core Web Vitals 2026 Guide',
            'LiteSpeed Cache vs WP Rocket: Which Caching Plugin Wins in 2026?',
            'How to Fix a Low PageSpeed Insights Score on WordPress',
            'Image Optimization for WordPress: WebP, AVIF and Lazy Loading Explained',
            'Reducing Time to First Byte (TTFB) on Shared Hosting',
            'How to Minify and Combine CSS/JS Without Breaking Your Site',
            'CDN Setup Guide: Cloudflare vs BunnyCDN for WordPress',
            'Database Cleanup: Optimizing WordPress Tables for Faster Queries',
            'GTmetrix vs PageSpeed Insights: Understanding the Difference',
            'How to Defer Render-Blocking JavaScript in WordPress',
            'Choosing Fast WordPress Hosting: Shared vs VPS vs Managed',
            'Reduce Cumulative Layout Shift (CLS) on WooCommerce Product Pages',
            "Object Caching with Redis on WordPress: A Beginner's Setup Guide",
        ),
        'elementor' => array(
            'Complete Elementor Pro Beginner Guide: From Zero to Hero',
            "10 Hidden Elementor Pro Workflow Tips You Didn't Know Existed",
            'Elementor Loop Builder: Creating Dynamic Post Grids Without Code',
            'Elementor Containers vs Sections: Which Should You Use in 2026?',
            'How to Build a Sticky Header in Elementor (No Plugin Needed)',
            'Elementor Global Widgets: Save Hours on Repetitive Design Work',
            'Speeding Up Elementor Sites: Reduce Bloat Without Losing Design',
            'Elementor Popup Builder: Exit-Intent and Timed Popups Explained',
            'Elementor Motion Effects: Scroll and Mouse Animations Guide',
            'Building a WooCommerce Product Page with Elementor Pro',
            'Elementor Theme Builder: Custom Headers, Footers, and Archives',
            'Elementor Form Widget: Multi-Step Forms and Conditional Logic',
            'Elementor vs Gutenberg: Which Page Builder Fits Your Workflow?',
        ),
        'troubleshooting' => array(
            'How to Fix Common WordPress Database Connection Errors',
            'Fixing the White Screen of Death in WordPress',
            'How to Resolve the "Are You Sure You Want to Do This" Error',
            'Troubleshooting 500 Internal Server Errors on WordPress',
            'How to Fix Mixed Content Warnings After Moving to HTTPS',
            'Debugging Plugin Conflicts: A Step-by-Step Elimination Method',
            'How to Recover a Hacked WordPress Site Safely',
            'Fixing "Memory Exhausted" Errors in WordPress',
            'Resolving REST API Errors That Break the Block Editor',
            'How to Fix Broken Permalinks After a Site Migration',
            'Troubleshooting Email Deliverability Issues on WordPress',
            'How to Restore WordPress From a Backup the Right Way',
        ),
        'seo' => array(
            'WordPress On-Page SEO Checklist for Higher Google Rankings',
            'RankMath vs Yoast SEO: Which Plugin Should You Choose in 2026?',
            'How to Set Up XML Sitemaps and Submit Them to Google',
            'Internal Linking Strategy for WordPress Blogs That Actually Works',
            "Schema Markup for WordPress: A Beginner's Guide to Rich Snippets",
            'How to Write SEO-Friendly URLs and Permalinks in WordPress',
            'Fixing Duplicate Content Issues on WordPress Category Pages',
            'Core Web Vitals and SEO: How Site Speed Affects Rankings',
            'How to Optimize Featured Images for SEO and Social Sharing',
            'Canonical Tags Explained: Preventing SEO Cannibalization',
            'Local SEO for WordPress: Optimizing for "Near Me" Searches',
            'How to Recover Rankings After a Google Core Update',
        ),
    );

    // 3. Insert each post, spacing publish dates out so the archive looks
    //    naturally published over time (newest first, roughly 3 days apart).
    $days_ago  = 0;
    $inserted  = 0;
    $author_id = get_current_user_id() ?: 1;

    foreach ($posts_by_category as $slug => $titles) {
        foreach ($titles as $title) {
            $days_ago += 3;
            $post_date = gmdate('Y-m-d H:i:s', strtotime("-{$days_ago} days"));

            $excerpt = 'A practical, step-by-step WordPress tutorial covering ' . lcfirst(rtrim($title, '?')) . '.';
            $content = "<p>{$excerpt}</p>\n\n<p>This article walks through the exact settings, tools and checks used on real WordPress sites, "
                . "with plain-language explanations for beginners and actionable detail for developers.</p>";

            $post_id = wp_insert_post(array(
                'post_title'   => $title,
                'post_excerpt' => $excerpt,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_author'  => $author_id,
                'post_date'    => $post_date,
                'post_date_gmt'=> $post_date,
            ));

            if ($post_id && !is_wp_error($post_id)) {
                wp_set_object_terms($post_id, array((int) $term_ids[$slug]), 'category');
                $inserted++;
            }
        }
    }

    update_option('wp_gyani_demo_posts_seeded', true);
    echo "Done — inserted {$inserted} posts across " . count($posts_by_category) . " categories.\n";
}

wp_gyani_seed_demo_posts();
