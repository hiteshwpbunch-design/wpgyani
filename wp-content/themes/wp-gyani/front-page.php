<?php
/**
 * Template for displaying the homepage
 *
 * @package WP_Gyani
 */

get_header();
?>

    <!-- SECTION 2: HERO SECTION -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle dark:from-gray-900 dark:via-[#141A25] dark:to-gray-900 pt-10 pb-16 md:py-20 overflow-hidden border-b border-bordercolor dark:border-gray-800">

        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] text-[#333333] dark:text-white pointer-events-none" style="background-image: radial-gradient(currentColor 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Column (60%) -->
                <div class="lg:col-span-6 space-y-6">
                    <!-- Eyebrow Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-light dark:bg-teal-900/30 border border-teal/20 dark:border-teal/30">
                        <span class="w-2 h-2 rounded-full bg-teal "></span>
                        <span class="font-manrope font-extrabold text-xs tracking-wider uppercase text-teal-dark dark:text-teal"><?php echo esc_html(get_theme_mod('hero_eyebrow', 'WORDPRESS KNOWLEDGE HUB')); ?></span>
                    </div>
                    <!-- Main H1 Headline -->
                    <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl lg:text-[56px] text-charcoal dark:text-white leading-[1.1] tracking-tight">
                        <?php echo get_theme_mod('hero_headline', 'Learn WordPress.<br><span class="text-teal relative">Build Better Websites.<svg class="absolute -bottom-2 left-0 w-full h-3 text-teal/30" viewBox="0 0 200 12" fill="none"><path id="hero-underline" d="M2 10C50 3 150 3 198 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg></span>'); ?>
                    </h1>
                    <!-- Supporting Text -->
                    <p class="font-inter text-lg md:text-xl text-textmuted dark:text-gray-300 leading-relaxed max-w-2xl">
                        <?php echo esc_html(get_theme_mod('hero_description', 'Practical WordPress tutorials, guides, tools and resources for beginners, creators, developers and website owners.')); ?>
                    </p>
                    <!-- CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="#featured" class="px-7 py-4 rounded-xl bg-teal text-white font-manrope font-bold text-base shadow-soft hover:bg-teal-dark hover:shadow-card-hover transition-all flex items-center justify-center gap-2 group">
                            <span>Explore Tutorials</span>
                            <svg class="w-5 h-5  transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="#latest" class="px-7 py-4 rounded-xl bg-white dark:bg-gray-800/50 text-charcoal dark:text-gray-200 font-manrope font-bold text-base border border-bordercolor dark:border-gray-700 hover:border-teal dark:hover:border-teal hover:bg-teal-light/30 dark:hover:bg-teal-900/30 transition-all flex items-center justify-center">Latest Articles</a>
                    </div>
                    <!-- Trust Bar -->
                    <div class="pt-6 border-t border-bordercolor/80 dark:border-gray-800 flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-semibold text-textmuted dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> WordPress Core</span>
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Elementor Pro</span>
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Core Web Vitals</span>
                        <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> SEO & Security</span>
                    </div>
                </div>
                <!-- Hero Right Illustration Column (40%) -->
                <div class="lg:col-span-6 relative flex justify-center items-center" style="perspective: 1000px;">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/hero-laptop.png" alt="WP Gyani Knowledge Hub" id="hero-image" class="max-w-full h-auto">
                </div>
            </div>
        </div>
    </section>

        <!-- SECTION 3: FEATURED CONTENT -->
    <section id="featured" class="py-16 md:py-20 border-b border-bordercolor dark:border-gray-800 dark:bg-[#141A25]">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 pb-4 border-b border-bordercolor dark:border-gray-800">
                <div>
                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">CURATED READS</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white mt-1">Featured on WP Gyani</h2>
                </div>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="mt-2 sm:mt-0 font-manrope font-bold text-sm text-teal-dark dark:text-teal hover:text-teal flex items-center gap-1 group">
                    <span>View All Featured</span>
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <?php
            $featured_args = array(
                'posts_per_page' => 5,
                'tag' => 'featured',
                'ignore_sticky_posts' => 1
            );
            $featured_query = new WP_Query($featured_args);
            if ($featured_query->have_posts()) :
            ?>
            <!-- Asymmetric Grid: 1 Large Hero Card (7 cols) + 2 Stacked Cards (5 cols) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch" style="perspective: 1200px;">
                <!-- Main Large Featured Article Card -->
                <div class="lg:col-span-7 bg-white dark:bg-gray-800 rounded-2xl border border-bordercolor dark:border-gray-700 p-5 sm:p-6 shadow-soft hover:shadow-card-hover transition-all group flex flex-col justify-between">
                    <?php 
                    $featured_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? $cat[0]->name : 'WordPress';
                    ?>
                    <div>
                        <div class="relative w-full aspect-[16/9] rounded-xl overflow-hidden bg-teal-light dark:bg-teal-900/30 mb-6 border border-bordercolor/50 dark:border-gray-700/50">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            <?php else : ?>
                                <img src="https://placehold.co/800x450/EAF6F5/333333?text=WP+Gyani" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <span class="absolute top-4 left-4 bg-teal text-white text-[11px] font-manrope font-extrabold uppercase px-3 py-1.5 rounded-md tracking-wider shadow-sm"><?php echo esc_html($cat_name); ?></span>
                        </div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-manrope font-bold text-charcoal dark:text-white group-hover:text-teal transition-colors leading-snug"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm sm:text-base mt-3 leading-relaxed line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-bordercolor dark:border-gray-700 flex items-center justify-between text-xs font-medium text-textmuted dark:text-gray-400">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-teal-light dark:bg-teal-900/50 text-teal dark:text-teal font-bold flex items-center justify-center text-xs border border-teal/20 dark:border-teal/30"><?php echo strtoupper(substr(get_the_author(), 0, 2)); ?></div>
                            <div>
                                <span class="block font-bold text-charcoal dark:text-gray-200"><?php the_author(); ?></span>
                                <span class="text-[11px]"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="bg-offwhite dark:bg-gray-900 px-2.5 py-1 rounded text-charcoal dark:text-gray-300 text-[11px] font-semibold border border-transparent dark:border-gray-700"><?php echo wp_gyani_reading_time(); ?> min read</span>
                            <a href="<?php the_permalink(); ?>" class="font-manrope font-bold text-teal group-hover:text-teal-dark dark:group-hover:text-teal-light flex items-center gap-1">Read Article &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- 4 Smaller Featured Posts Grid (Right, 5 cols) -->
                <div class="lg:col-span-5 flex flex-col gap-6 justify-between">
                    <?php while ($featured_query->have_posts()) : $featured_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? $cat[0]->name : 'Article';
                    ?>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-bordercolor dark:border-gray-700 p-5 shadow-soft hover:shadow-card-hover transition-all group flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <div class="w-full sm:w-36 h-28 shrink-0 rounded-xl overflow-hidden bg-teal-light dark:bg-teal-900/30 border border-bordercolor/50 dark:border-gray-700/50">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                            <?php else : ?>
                                <img src="https://placehold.co/300x200/EAF6F5/333333?text=Article" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <span class="text-[10px] font-manrope font-extrabold text-teal uppercase tracking-wider block mb-1"><?php echo esc_html($cat_name); ?></span>
                            <h4 class="font-manrope font-bold text-base text-charcoal dark:text-white group-hover:text-teal transition-colors leading-snug line-clamp-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="mt-3 flex items-center gap-3 text-xs text-textmuted dark:text-gray-400">
                                <span><?php echo get_the_date('M d, Y'); ?></span><span>&bull;</span><span><?php echo wp_gyani_reading_time(); ?> min read</span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php else : ?>
                <p>No featured articles found. Please add the 'featured' tag to your posts.</p>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

        <!-- SECTION 4: CATEGORY EXPLORER -->
    <section id="categories" class="py-16 md:py-20 bg-white dark:bg-gray-900 border-b border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">STRUCTURED LEARNING</span>
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white mt-1">Explore WordPress Knowledge</h2>
                <p class="font-inter text-textmuted dark:text-gray-400 text-base mt-2">Browse curated tutorials, guides, and practical solutions organized by topic.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $categories = get_categories(array('number' => 6, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false));
                foreach ($categories as $cat) :
                    // Dynamic icons based on category slug
                    $slug = $cat->slug;
                    if (strpos($slug, 'hosting') !== false || strpos($slug, 'server') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>';
                    } elseif (strpos($slug, 'blog') !== false || strpos($slug, 'content') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>';
                    } elseif (strpos($slug, 'gutenberg') !== false || strpos($slug, 'editor') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c-.186-.025-.37-.05-.552-.078a1.2 1.2 0 00-1.128.84A12.01 12.01 0 003 12c0 1.25.19 2.45.542 3.58a1.2 1.2 0 001.128.841c.182-.028.366-.053.552-.078 1.385-.187 2.775-.288 4.163-.3a.64.64 0 01.657.643v0c0 .355-.186.676-.401.959-.221.29-.349.634-.349 1.003 0 1.035 1.007 1.875 2.25 1.875s2.25-.84 2.25-1.875c0-.369-.128-.713-.349-1.003-.215-.283-.401-.604-.401-.959v0a.64.64 0 01.657-.643c1.388.012 2.778.113 4.163.3.186.025.37.05.552.078a1.2 1.2 0 001.128-.841A12.01 12.01 0 0021 12c0-1.25-.19-2.45-.542-3.58a1.2 1.2 0 00-1.128-.84c-.182.028-.366.053-.552.078-1.385.187-2.775.288-4.163.3a.64.64 0 01-.657-.643v0z"/>';
                    } elseif (strpos($slug, 'woo') !== false || strpos($slug, 'ecommerce') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>';
                    } elseif (strpos($slug, 'plugin') !== false || strpos($slug, 'theme') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
                    } elseif (strpos($slug, 'speed') !== false || strpos($slug, 'performance') !== false || strpos($slug, 'seo') !== false) {
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>';
                    } else {
                        // Default Library Icon
                        $icon_path = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.315 48.315 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>';
                    }
                ?>
                <a href="<?php echo get_category_link($cat->term_id); ?>" class="group p-6 rounded-2xl bg-white dark:bg-gray-800 border border-bordercolor dark:border-gray-700 hover:border-teal dark:hover:border-teal hover:shadow-card-hover transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-teal-light dark:bg-teal-900/30 text-teal flex items-center justify-center mb-5 group-hover:bg-teal group-hover:text-white transition-colors">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><?php echo $icon_path; ?></svg>
                        </div>
                        <h3 class="font-manrope font-bold text-xl text-charcoal dark:text-white group-hover:text-teal transition-colors"><?php echo esc_html($cat->name); ?></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm mt-2 leading-relaxed"><?php echo esc_html(wp_trim_words($cat->description ? $cat->description : 'Explore all guides and tutorials.', 15)); ?></p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-bordercolor dark:border-gray-700 flex items-center justify-between text-xs font-bold text-teal-dark dark:text-teal">
                        <span><?php echo $cat->count; ?> Guides</span><span class=" transition-transform">&rarr;</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 5: LATEST ARTICLES -->
    <section id="latest" class="py-16 md:py-20 bg-offwhite dark:bg-gray-900 border-b border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Header & Filter Tabs -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">FRESH KNOWLEDGE</span>
                    <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white mt-1">Latest Articles & Tutorials</h2>
                </div>
                <!-- Interactive Category Filter Chips -->
                <div class="flex flex-wrap items-center gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-xl border border-bordercolor dark:border-gray-700 shadow-sm">
                    <button onclick="filterArticles('all')" id="btn-all" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all bg-teal text-white shadow-sm">All Topics</button>
                    <button onclick="filterArticles('speed')" id="btn-speed" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted dark:text-gray-400 hover:text-charcoal dark:hover:text-white hover:bg-teal-light dark:hover:bg-gray-700">Speed & SEO</button>
                    <button onclick="filterArticles('elementor')" id="btn-elementor" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted dark:text-gray-400 hover:text-charcoal dark:hover:text-white hover:bg-teal-light dark:hover:bg-gray-700">Elementor</button>
                    <button onclick="filterArticles('troubleshooting')" id="btn-troubleshooting" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted dark:text-gray-400 hover:text-charcoal dark:hover:text-white hover:bg-teal-light dark:hover:bg-gray-700">Fix Errors</button>
                </div>
            </div>
            <!-- 3-Column Article Grid -->
            <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                );
                $query = new WP_Query($args);
                if ($query->have_posts()):
                    while ($query->have_posts()): $query->the_post();
                        $categories = get_the_category();
                        $cat_slug = !empty($categories) ? $categories[0]->slug : 'general';
                        if (in_array($cat_slug, array('speed', 'seo', 'performance'))) {
                            $cat_class = 'speed';
                        } elseif (in_array($cat_slug, array('elementor', 'page-builder'))) {
                            $cat_class = 'elementor';
                        } elseif (in_array($cat_slug, array('troubleshooting', 'errors', 'security'))) {
                            $cat_class = 'troubleshooting';
                        } else {
                            $cat_class = 'all';
                        }
                        $cat_name = !empty($categories) ? $categories[0]->name : 'WordPress';
                ?>
                <article class="article-card bg-white dark:bg-gray-800 rounded-2xl border border-bordercolor dark:border-gray-700 overflow-hidden flex flex-col justify-between relative transition-colors hover:border-bordercolor-hover dark:hover:border-teal group/card" data-category="<?php echo esc_attr($cat_class); ?>">
                    <div>
                        <div class="relative aspect-[16/9] overflow-hidden bg-teal-light dark:bg-teal-900/30 border-b border-bordercolor/50 dark:border-gray-700/50">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover relative z-0', 'loading' => 'lazy')); ?>
                            <?php else: ?>
                                <img src="https://placehold.co/600x340/EAF6F5/333333?text=WP+Gyani" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover relative z-0" loading="lazy">
                            <?php endif; ?>
                            <!-- Dark overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10 pointer-events-none"></div>
                            <span class="absolute top-3 left-3 bg-teal text-white text-[10px] font-manrope font-extrabold uppercase px-2.5 py-1 rounded z-20"><?php echo esc_html($cat_name); ?></span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-manrope font-bold text-xl text-charcoal dark:text-white group-hover/card:text-teal transition-colors leading-snug">
                                <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-30 hover:underline"><?php the_title(); ?></a>
                            </h3>
                            <p class="font-inter text-textmuted dark:text-gray-400 text-sm mt-3 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-bordercolor/60 dark:border-gray-700 flex items-center justify-between text-xs text-textmuted dark:text-gray-400">
                        <span class="font-medium"><?php echo get_the_date(); ?></span>
                        <span class="font-semibold text-charcoal dark:text-gray-300 bg-offwhite dark:bg-gray-900 px-2 py-0.5 rounded border border-transparent dark:border-gray-700"><?php echo wp_gyani_reading_time(); ?> min read</span>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                ?>
                <p>No articles found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

        <!-- SECTION 6: WP GYANI GUIDES (EVERGREEN PILLAR HUB) -->
    <section id="guides" class="py-16 md:py-20 bg-teal-light dark:bg-teal-900/10 border-b border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="max-w-2xl mb-12">
                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal-dark dark:text-teal bg-white dark:bg-teal-900/40 px-3 py-1 rounded-md border border-teal/20 dark:border-teal/30 inline-block">PILLAR KNOWLEDGE</span>
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white mt-3">WP Gyani Pillar Guides</h2>
                <p class="font-inter text-textmuted dark:text-gray-400 text-base mt-2">Comprehensive, step-by-step master guides built to take you from zero to expert on key WordPress subjects.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $pillar_args = array(
                    'posts_per_page' => 6,
                    'category_name' => 'guides', // or pillar
                    'ignore_sticky_posts' => 1
                );
                $pillar_query = new WP_Query($pillar_args);
                if ($pillar_query->have_posts()) :
                    while ($pillar_query->have_posts()) : $pillar_query->the_post();
                ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-bordercolor dark:border-gray-700 p-7 shadow-soft hover:shadow-card-hover transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-manrope font-extrabold text-teal uppercase tracking-wider bg-teal-light dark:bg-teal-900/30 px-2.5 py-1 rounded">PILLAR HUB</span>
                        </div>
                        <h3 class="font-manrope font-extrabold text-2xl text-charcoal dark:text-white group-hover:text-teal transition-colors"><?php the_title(); ?></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm mt-3 leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </div>
                    <div class="mt-8 pt-5 border-t border-bordercolor dark:border-gray-700 flex items-center justify-between">
                        <span class="text-xs font-bold text-charcoal dark:text-gray-300">Updated <?php echo get_the_date('Y'); ?></span>
                        <a href="<?php the_permalink(); ?>" class="px-4 py-2 rounded-xl bg-teal text-white font-manrope font-bold text-xs hover:bg-teal-dark transition-colors flex items-center gap-1"><span>Read Guide</span><span>&rarr;</span></a>
                    </div>
                </div>
                <?php
                    endwhile;
                else:
                ?>
                    <div class="col-span-full"><p>No guides found. Create a category 'guides' and add posts.</p></div>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

        <!-- SECTION 7: POPULAR & TRENDING NOW -->
    <section class="py-16 md:py-20 bg-white dark:bg-[#141A25] border-b border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left Column: Most Popular Numbered List (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-3 h-3 rounded-full bg-teal"></span>
                        <h2 class="text-2xl md:text-3xl font-manrope font-extrabold text-charcoal dark:text-white">Most Popular Articles</h2>
                    </div>
                    <div class="space-y-4">
                        <?php
                        $popular_args = array(
                            'posts_per_page' => 4,
                            'orderby' => 'comment_count',
                            'order' => 'DESC'
                        );
                        $popular_query = new WP_Query($popular_args);
                        $count = 1;
                        if ($popular_query->have_posts()) :
                            while ($popular_query->have_posts()) : $popular_query->the_post();
                                $cat = get_the_category();
                                $cat_name = !empty($cat) ? $cat[0]->name : 'Article';
                        ?>
                        <div class="p-4 rounded-xl border border-bordercolor dark:border-gray-700 hover:border-teal dark:hover:border-teal transition-all flex items-start gap-4 group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>'">
                            <span class="font-manrope font-extrabold text-2xl text-teal-dark dark:text-teal opacity-60 group-hover:opacity-100">0<?php echo $count++; ?></span>
                            <div>
                                <span class="text-[10px] font-bold text-teal uppercase tracking-wider"><?php echo esc_html($cat_name); ?></span>
                                <h4 class="font-manrope font-bold text-base text-charcoal dark:text-white group-hover:text-teal transition-colors mt-0.5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="text-xs text-textmuted dark:text-gray-400 mt-1"><?php echo wp_gyani_reading_time(); ?> min read &bull; <?php echo get_comments_number(); ?> comments</div>
                            </div>
                        </div>
                        <?php
                            endwhile;
                        else:
                            echo "<p>No popular articles found.</p>";
                        endif; wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <!-- Right Column: Trending Sidebar Box (5 cols) -->
                <div class="lg:col-span-5 bg-gradient-to-br from-offwhite to-white dark:from-gray-800 dark:to-gray-900/80 p-6 sm:p-8 rounded-2xl border border-bordercolor dark:border-gray-700 shadow-soft flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-bordercolor dark:border-gray-700">
                            <h3 class="font-manrope font-bold text-xl text-charcoal dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-1.348l-3.75 3.75a1 1 0 00-.248.374l-1.5 4.5a1 1 0 001.264 1.264l4.5-1.5a1 1 0 00.374-.248l3.75-3.75a1 1 0 00-1.348-1.45L12 5.586l.395-3.033z" clip-rule="evenodd"/></svg>
                                Trending This Week
                            </h3>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-teal uppercase tracking-widest bg-white dark:bg-gray-900 px-2.5 py-1 rounded shadow-sm border border-bordercolor dark:border-gray-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                LIVE FEED
                            </span>
                        </div>
                        <div class="space-y-4">
                            <?php
                            $trending_args = array(
                                'posts_per_page' => 3,
                                'orderby' => 'rand',
                                'date_query' => array(
                                    array(
                                        'after' => '1 week ago',
                                    ),
                                ),
                            );
                            $trending_query = new WP_Query($trending_args);
                            $trend_count = 1;
                            if ($trending_query->have_posts()) :
                                while ($trending_query->have_posts()) : $trending_query->the_post();
                                    $cat = get_the_category();
                                    $cat_name = !empty($cat) ? $cat[0]->name : 'Trending';
                            ?>
                            <a href="<?php the_permalink(); ?>" class="group flex items-start p-4 rounded-xl bg-white dark:bg-gray-700/50 hover:bg-white dark:hover:bg-gray-700 shadow-sm hover:shadow-md transition-all border border-transparent hover:border-teal/30 dark:hover:border-teal/50 relative overflow-hidden">
                                <div class="flex-1 relative z-10">
                                    <span class="text-[10px] font-extrabold text-teal uppercase tracking-wider mb-1.5 block"><?php echo esc_html($cat_name); ?></span>
                                    <h5 class="font-manrope font-bold text-sm text-charcoal dark:text-gray-200 group-hover:text-teal transition-colors leading-snug"><?php the_title(); ?></h5>
                                    <div class="mt-2.5 flex items-center gap-2 text-[11px] text-textmuted dark:text-gray-400 font-medium">
                                        <svg class="w-3.5 h-3.5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                        Trending higher
                                    </div>
                                </div>
                            </a>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <p class="text-sm text-textmuted dark:text-gray-400">Not enough data to determine trends yet.</p>
                            <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="mt-8 pt-4 border-t border-bordercolor dark:border-gray-700 text-center">
                        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="font-manrope font-bold text-xs text-teal-dark dark:text-teal hover:underline">Browse All Trending Articles &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: USEFUL WORDPRESS RESOURCES -->
    <!-- SECTION 8: USEFUL WORDPRESS RESOURCES -->
    <section id="resources" class="py-20 md:py-32 bg-offwhite dark:bg-gray-900 border-b border-bordercolor dark:border-gray-800 relative overflow-hidden">
        
        <!-- Decorative Background Elements -->
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-teal/5 dark:bg-teal-900/10 rounded-full blur-3xl -translate-x-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-teal/5 dark:bg-teal-900/10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal/10 dark:bg-teal-900/30 text-teal text-[11px] font-bold font-manrope uppercase tracking-widest mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal animate-pulse"></span>
                        Curated Toolkit
                    </span>
                    <h2 class="text-4xl md:text-5xl font-manrope font-extrabold text-charcoal dark:text-white tracking-tight leading-[1.1]">
                        Useful <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal to-teal-dark">WordPress</span> Resources
                    </h2>
                    <p class="font-inter text-textmuted dark:text-gray-400 text-lg mt-6 leading-relaxed max-w-xl">
                        Tools, checklists, code snippets, and curated recommendations to instantly accelerate your workflow and build better websites.
                    </p>
                </div>
                <div class="hidden md:block">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white dark:bg-gray-800 text-charcoal dark:text-white font-manrope font-bold text-sm border border-bordercolor dark:border-gray-700 hover:border-teal dark:hover:border-teal hover:shadow-[0_0_20px_rgba(78,170,167,0.15)] transition-all group">
                        View all resources
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Bento/Premium Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="relative group h-full">
                    <div class="absolute -inset-[1px] bg-gradient-to-b from-teal to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-[2px]"></div>
                    <div class="relative h-full bg-white dark:bg-gray-800 p-8 rounded-3xl border border-bordercolor dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col items-start z-10">
                        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-teal/5 to-transparent dark:from-teal/10 pointer-events-none"></div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal to-teal-dark shadow-lg shadow-teal/30 text-white flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 relative z-10">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 01-3.586 0 2.548 2.548 0 010-3.586l5.653-4.655m3.03-2.496a2.652 2.652 0 00-3.75-3.75l-5.877 5.877"/></svg>
                        </div>
                        <h4 class="font-manrope font-extrabold text-xl text-charcoal dark:text-white mb-3 relative z-10 group-hover:text-teal transition-colors">Speed Test Tools</h4>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm leading-relaxed mb-8 flex-1 relative z-10">PageSpeed Insights, GTmetrix, and Pingdom benchmark suite.</p>
                        <a href="<?php echo esc_url(home_url('/category/speed/')); ?>" class="mt-auto font-manrope font-bold text-sm text-charcoal dark:text-gray-300 flex items-center gap-2 group-hover:text-teal dark:group-hover:text-teal transition-colors relative z-10">
                            Explore Tools <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-teal/5 dark:bg-teal/10 rounded-full blur-2xl group-hover:bg-teal/15 transition-colors duration-500 pointer-events-none"></div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="relative group h-full">
                    <div class="absolute -inset-[1px] bg-gradient-to-b from-teal to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-[2px]"></div>
                    <div class="relative h-full bg-white dark:bg-gray-800 p-8 rounded-3xl border border-bordercolor dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col items-start z-10">
                        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-teal/5 to-transparent dark:from-teal/10 pointer-events-none"></div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal to-teal-dark shadow-lg shadow-teal/30 text-white flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 relative z-10">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-manrope font-extrabold text-xl text-charcoal dark:text-white mb-3 relative z-10 group-hover:text-teal transition-colors">Pre-Launch Checklists</h4>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm leading-relaxed mb-8 flex-1 relative z-10">42-point quality assurance checklist before client site launch.</p>
                        <a href="<?php echo esc_url(home_url('/category/guides/')); ?>" class="mt-auto font-manrope font-bold text-sm text-charcoal dark:text-gray-300 flex items-center gap-2 group-hover:text-teal dark:group-hover:text-teal transition-colors relative z-10">
                            Get Checklists <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-teal/5 dark:bg-teal/10 rounded-full blur-2xl group-hover:bg-teal/15 transition-colors duration-500 pointer-events-none"></div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="relative group h-full">
                    <div class="absolute -inset-[1px] bg-gradient-to-b from-teal to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-[2px]"></div>
                    <div class="relative h-full bg-white dark:bg-gray-800 p-8 rounded-3xl border border-bordercolor dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col items-start z-10">
                        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-teal/5 to-transparent dark:from-teal/10 pointer-events-none"></div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal to-teal-dark shadow-lg shadow-teal/30 text-white flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 relative z-10">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/></svg>
                        </div>
                        <h4 class="font-manrope font-extrabold text-xl text-charcoal dark:text-white mb-3 relative z-10 group-hover:text-teal transition-colors">Code Snippet Vault</h4>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm leading-relaxed mb-8 flex-1 relative z-10">Tested PHP & CSS snippets for functions.php without heavy plugins.</p>
                        <a href="<?php echo esc_url(home_url('/category/wp-core/')); ?>" class="mt-auto font-manrope font-bold text-sm text-charcoal dark:text-gray-300 flex items-center gap-2 group-hover:text-teal dark:group-hover:text-teal transition-colors relative z-10">
                            Browse Vault <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-teal/5 dark:bg-teal/10 rounded-full blur-2xl group-hover:bg-teal/15 transition-colors duration-500 pointer-events-none"></div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="relative group h-full">
                    <div class="absolute -inset-[1px] bg-gradient-to-b from-teal to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-[2px]"></div>
                    <div class="relative h-full bg-white dark:bg-gray-800 p-8 rounded-3xl border border-bordercolor dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col items-start z-10">
                        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-teal/5 to-transparent dark:from-teal/10 pointer-events-none"></div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal to-teal-dark shadow-lg shadow-teal/30 text-white flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500 relative z-10">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-manrope font-extrabold text-xl text-charcoal dark:text-white mb-3 relative z-10 group-hover:text-teal transition-colors">Free Template Library</h4>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-sm leading-relaxed mb-8 flex-1 relative z-10">Ready-to-import Elementor container templates & section blocks.</p>
                        <a href="<?php echo esc_url(home_url('/category/elementor/')); ?>" class="mt-auto font-manrope font-bold text-sm text-charcoal dark:text-gray-300 flex items-center gap-2 group-hover:text-teal dark:group-hover:text-teal transition-colors relative z-10">
                            View Library <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-teal/5 dark:bg-teal/10 rounded-full blur-2xl group-hover:bg-teal/15 transition-colors duration-500 pointer-events-none"></div>
                    </div>
                </div>

            </div>
            
            <!-- Mobile 'View All' Button (shows only on mobile since desktop has it in header) -->
            <div class="mt-10 md:hidden text-center">
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-white dark:bg-gray-800 text-charcoal dark:text-white font-manrope font-bold text-sm border border-bordercolor dark:border-gray-700 hover:border-teal transition-all group w-full">
                    View all resources
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

        </div>
    </section>

    <!-- SECTION 9: NEWSLETTER CTA -->
    <section id="newsletter" class="pt-12 md:pt-16 pb-6 md:pb-8 bg-white dark:bg-[#141A25] relative z-10">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <style>
                @keyframes panPattern {
                    0% { background-position: 0 0; }
                    100% { background-position: 24px 24px; }
                }
                .animate-pattern {
                    background-image: radial-gradient(rgba(255,255,255,0.07) 1px, transparent 1px);
                    background-size: 24px 24px;
                    animation: panPattern 10s linear infinite;
                }
            </style>
            <div class="bg-[#141A25] rounded-xl p-5 md:p-6 lg:p-8 flex flex-col md:flex-row items-center gap-6 lg:gap-8 shadow-2xl relative overflow-hidden">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 animate-pattern pointer-events-none"></div>
                <!-- Background decoration (large circle on right) -->
                <div class="absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-1/4 w-80 h-80 bg-white/5 rounded-full pointer-events-none"></div>
                
                <!-- Icon -->
                <div class="hidden md:block shrink-0 w-40 lg:w-44 h-auto relative z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/newsletter-icon.png" alt="Newsletter" class="w-full h-auto drop-shadow-xl" />
                </div>
                
                <!-- Text -->
                <div class="flex-1 text-center md:text-left z-10">
                    <h2 class="text-2xl md:text-3xl font-manrope font-bold text-white tracking-tight">Get Smarter With WordPress</h2>
                    <p class="font-inter text-white text-xs md:text-sm mt-2 leading-relaxed max-w-xl mx-auto md:mx-0">
                        Weekly <span class="text-amber-400 font-semibold">actionable WordPress tutorials</span>, <span class="text-amber-400 font-semibold">speed tweaks</span>, <span class="text-amber-400 font-semibold">security alerts</span> and resources delivered straight to your inbox.
                    </p>
                </div>
                
                <!-- Form -->
                <div class="w-full md:w-[380px] lg:w-[420px] shrink-0 z-10 flex flex-col justify-center">
                    <form onsubmit="handleSubscribe(event)" class="relative flex flex-col sm:flex-row bg-white dark:bg-gray-800 p-1.5 rounded-lg shadow-lg gap-2 sm:gap-0">
                        <input type="email" id="newsletter-email" placeholder="Enter your email address" required class="flex-1 w-full bg-transparent px-4 py-2.5 text-charcoal dark:text-white font-inter text-sm border-none focus:ring-0 focus:outline-none placeholder-gray-400">
                        <button type="submit" class="w-full sm:w-auto px-5 py-3 sm:py-2.5 rounded-md bg-[#1a202c] hover:bg-black text-white font-manrope font-bold text-sm transition-all whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                    <div class="mt-2 text-center md:text-left pl-2 flex items-center justify-between text-[10px] text-white font-inter">
                        <span>No spam. Just useful WordPress knowledge.</span>
                        <svg class="w-3 h-3 opacity-50 hidden md:block text-[#FFFFFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 10: ABOUT WP GYANI (AUTHORITY & TRUST) -->
    <section class="relative bg-white dark:bg-[#141A25] pt-10 pb-10 md:py-20 overflow-hidden border-b border-bordercolor dark:border-gray-800">

        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] text-[#333333] dark:text-white pointer-events-none" style="background-image: radial-gradient(currentColor 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-stretch">
                <!-- Left: Text Content -->
                <div class="lg:col-span-5 flex flex-col">
                    <div class="space-y-6">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal/10 dark:bg-teal-900/30 text-teal text-[11px] font-bold font-manrope uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal animate-pulse"></span>
                            Our Mission
                        </span>
                        <h2 class="text-4xl md:text-5xl lg:text-5xl font-manrope font-extrabold text-charcoal dark:text-white tracking-tight leading-[1.1]">
                            Your Practical <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-teal to-teal-dark">WordPress Hub</span>
                        </h2>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-lg leading-relaxed">
                            WP Gyani was built with a simple mission: to eliminate confusion around WordPress development, search engine optimization, website speed, and security.
                        </p>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-base leading-relaxed">
                            Whether you are building your very first blog, managing an online WooCommerce store, or engineering custom client websites with Elementor, our tested tutorials break down complex tech into simple actionable steps.
                        </p>
                        <div class="pt-4 pb-0">
                            <a href="#newsletter" class="inline-flex items-center gap-2 font-manrope font-bold text-charcoal dark:text-white hover:text-teal dark:hover:text-teal transition-colors group">
                                Join the newsletter
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Resources Grid -->
                <div class="lg:col-span-7 relative mt-0 lg:mt-0">
                    
                    <?php
                    $stepped_logos = [
                        // Row 1 (2 items)
                        [
                            ['name' => 'WordPress', 'slug' => 'wordpress'],
                            ['name' => 'Elementor', 'slug' => 'elementor']
                        ],
                        // Row 2 (3 items)
                        [
                            ['name' => 'WooCommerce', 'slug' => 'woo'],
                            ['name' => 'Yoast SEO', 'slug' => 'yoast'],
                            ['name' => 'Figma', 'slug' => 'figma']
                        ],
                        // Row 3 (4 items)
                        [
                            ['name' => 'Gutenberg', 'slug' => 'gutenberg'],
                            ['name' => 'PHP', 'slug' => 'php'],
                            ['name' => 'WP Engine', 'slug' => 'wpengine'],
                            ['name' => 'MySQL', 'slug' => 'mysql']
                        ],
                        // Row 4 (5 items)
                        [
                            ['name' => 'Stripe', 'slug' => 'stripe'],
                            ['name' => 'Mailchimp', 'slug' => 'mailchimp'],
                            ['name' => 'Cloudflare', 'slug' => 'cloudflare'],
                            ['name' => 'Analytics', 'slug' => 'googleanalytics'],
                            ['name' => 'JavaScript', 'slug' => 'javascript']
                        ]
                    ];
                    ?>
                    
                    <!-- Mobile Logo Marquee (Hidden on Desktop) -->
                    <style>
                        @keyframes logo-marquee {
                            0% { transform: translateX(0); }
                            100% { transform: translateX(calc(-100% - 1rem)); } /* 1rem is gap-4 */
                        }
                        .animate-logo-marquee {
                            animation: logo-marquee 20s linear infinite;
                        }
                    </style>
                    <div class="flex lg:hidden overflow-hidden w-full relative mb-0 group">
                        <div class="flex gap-4 animate-logo-marquee whitespace-nowrap shrink-0">
                            <?php 
                            foreach($stepped_logos as $row): 
                                foreach($row as $logo): 
                            ?>
                            <div class="shrink-0 bg-white dark:bg-gray-800 border border-bordercolor dark:border-gray-700 rounded-2xl w-16 h-16 flex items-center justify-center hover:border-teal dark:hover:border-teal shadow-sm relative">
                                <img src="https://cdn.simpleicons.org/<?php echo $logo['slug']; ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="w-8 h-8" />
                            </div>
                            <?php 
                                endforeach; 
                            endforeach; 
                            ?>
                        </div>
                        <div class="flex gap-4 animate-logo-marquee whitespace-nowrap shrink-0 ml-4">
                            <?php 
                            foreach($stepped_logos as $row): 
                                foreach($row as $logo): 
                            ?>
                            <div class="shrink-0 bg-white dark:bg-gray-800 border border-bordercolor dark:border-gray-700 rounded-2xl w-16 h-16 flex items-center justify-center hover:border-teal dark:hover:border-teal shadow-sm relative">
                                <img src="https://cdn.simpleicons.org/<?php echo $logo['slug']; ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="w-8 h-8" />
                            </div>
                            <?php 
                                endforeach; 
                            endforeach; 
                            ?>
                        </div>
                    </div>

                    <!-- Desktop Stepped Pyramid (Hidden on Mobile) -->
                    <div class="hidden lg:flex flex-col items-end gap-4 w-full">
                        <?php foreach($stepped_logos as $row_index => $row): ?>
                        <div class="flex items-center gap-4 relative z-10">
                            <?php foreach($row as $logo_index => $logo): ?>
                            <div class="bg-white dark:bg-gray-800 border-2 border-bordercolor dark:border-gray-700 rounded-2xl w-24 h-24 flex items-center justify-center hover:border-teal dark:hover:border-teal shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-pointer relative">
                                <!-- Display official brand colors -->
                                <img src="https://cdn.simpleicons.org/<?php echo $logo['slug']; ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300 relative z-10" />
                                
                                <!-- Tooltip -->
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-charcoal dark:bg-gray-900 text-white text-[10px] font-bold px-3 py-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-xl z-30">
                                    <?php echo esc_html($logo['name']); ?>
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-charcoal dark:bg-gray-900 rotate-45"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
