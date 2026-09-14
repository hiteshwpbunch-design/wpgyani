<?php
/**
 * Template Name: Categories Index
 * 
 * @package WP_Gyani
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- PAGE HERO SECTION -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 pt-12 pb-12 border-b border-bordercolor dark:border-gray-800 overflow-hidden">
        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-10 pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex items-center gap-2 text-sm font-medium text-textmuted dark:text-gray-400">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-teal transition-colors">Home</a>
                    </li>
                    <li class="text-gray-300 dark:text-gray-600">/</li>
                    <li class="text-charcoal dark:text-gray-200 font-semibold">Categories</li>
                </ol>
            </nav>

            <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal mb-3 block">EXPLORE TOPICS</span>
            <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl text-charcoal dark:text-white leading-tight tracking-tight mb-4">
                <?php the_title(); ?>
            </h1>
            <p class="font-inter text-textmuted dark:text-gray-400 text-base max-w-2xl">
                Browse our entire library of WordPress tutorials, guides, and resources organized by topic.
            </p>
        </div>
    </section>

    <!-- CATEGORIES GRID -->
    <section class="py-16 md:py-24 bg-white dark:bg-transparent">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $categories = get_categories(array(
                    'hide_empty' => true,
                    'orderby'    => 'count',
                    'order'      => 'DESC'
                ));

                foreach ($categories as $category) {
                    $cat_link = get_category_link($category->term_id);
                    $cat_slug = $category->slug;

                    // Match icon logically
                    if (strpos($cat_slug, 'server') !== false || strpos($cat_slug, 'hosting') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>';
                    } elseif (strpos($cat_slug, 'blog') !== false || strpos($cat_slug, 'content') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>';
                    } elseif (strpos($cat_slug, 'gutenberg') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>';
                    } elseif (strpos($cat_slug, 'woo') !== false || strpos($cat_slug, 'commerce') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>';
                    } elseif (strpos($cat_slug, 'plugin') !== false || strpos($cat_slug, 'theme') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
                    } elseif (strpos($cat_slug, 'speed') !== false || strpos($cat_slug, 'performance') !== false) {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>';
                    } else {
                        $svg = '<svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                    }

                    // Check for custom category image first
                    $custom_image_id = get_term_meta($category->term_id, '_wp_gyani_category_image_id', true);
                    if ($custom_image_id) {
                        $bg_url = wp_get_attachment_image_url($custom_image_id, 'medium_large');
                    } else {
                        // Fallback to latest post thumbnail
                        $bg_url = 'https://placehold.co/600x400/1F2937/4B5563?text=' . urlencode($category->name);
                        $latest_post = get_posts(array('category' => $category->term_id, 'posts_per_page' => 1));
                        if (!empty($latest_post) && has_post_thumbnail($latest_post[0]->ID)) {
                            $bg_url = get_the_post_thumbnail_url($latest_post[0]->ID, 'medium_large');
                        }
                    }
                    
                    $cat_desc = $category->description ? wp_trim_words($category->description, 15) : 'Explore the latest articles, tutorials, and insights in ' . esc_html($category->name) . '.';
                ?>
                <a href="<?php echo esc_url($cat_link); ?>" class="relative block aspect-[4/3] rounded-2xl overflow-hidden group shadow-soft hover:shadow-card-hover transition-all">
                    <!-- Background Image -->
                    <img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($category->name); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-black/10 opacity-100 transition-opacity duration-300"></div>

                    <!-- Content Wrapper -->
                    <div class="absolute inset-0 p-6 flex flex-col justify-between z-10">
                        <!-- Top Row: Icon and Badge -->
                        <div class="flex items-start justify-between">
                            <div class="w-8 h-8 text-[#FFFFFF] drop-shadow-md shrink-0">
                                <?php echo $svg; ?>
                            </div>
                            <span class="bg-[#111827]/90 backdrop-blur border border-[#FFFFFF]/20 text-[#FFFFFF] text-[10px] font-manrope font-bold uppercase px-3 py-1.5 rounded-full shadow-md">
                                <?php echo esc_html($category->count); ?> Articles
                            </span>
                        </div>
                        
                        <!-- Bottom Row: Title and Description -->
                        <div class="bg-[#111827]/60 backdrop-blur-md p-4 rounded-xl border border-[#FFFFFF]/10 shadow-lg mt-auto">
                            <h3 class="font-manrope font-bold text-xl text-[#FFFFFF] mb-1 drop-shadow-lg tracking-wide"><?php echo esc_html($category->name); ?></h3>
                            <p class="font-inter text-[#FFFFFF]/90 text-xs leading-relaxed line-clamp-2 drop-shadow-md"><?php echo esc_html($cat_desc); ?></p>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
