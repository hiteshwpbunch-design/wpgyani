<?php
/**
 * Template for displaying the homepage
 *
 * @package WP_Gyani
 */

get_header();
?>

    <!-- SECTION 2: HERO SECTION -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle pt-10 pb-16 md:py-20 overflow-hidden border-b border-bordercolor">

        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Column (60%) -->
                <div class="lg:col-span-6 space-y-6">
                    <!-- Eyebrow Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-light border border-teal/20">
                        <span class="w-2 h-2 rounded-full bg-teal "></span>
                        <span class="font-manrope font-extrabold text-xs tracking-wider uppercase text-teal-dark"><?php echo esc_html(get_theme_mod('hero_eyebrow', 'WORDPRESS KNOWLEDGE HUB')); ?></span>
                    </div>
                    <!-- Main H1 Headline -->
                    <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl lg:text-[56px] text-charcoal leading-[1.1] tracking-tight">
                        <?php echo get_theme_mod('hero_headline', 'Learn WordPress.<br><span class="text-teal relative">Build Better Websites.<svg class="absolute -bottom-2 left-0 w-full h-3 text-teal/30" viewBox="0 0 200 12" fill="none"><path id="hero-underline" d="M2 10C50 3 150 3 198 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg></span>'); ?>
                    </h1>
                    <!-- Supporting Text -->
                    <p class="font-inter text-lg md:text-xl text-textmuted leading-relaxed max-w-2xl">
                        <?php echo esc_html(get_theme_mod('hero_description', 'Practical WordPress tutorials, guides, tools and resources for beginners, creators, developers and website owners.')); ?>
                    </p>
                    <!-- CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="#featured" class="px-7 py-4 rounded-xl bg-teal text-white font-manrope font-bold text-base shadow-soft hover:bg-teal-dark hover:shadow-card-hover transition-all flex items-center justify-center gap-2 group">
                            <span>Explore Tutorials</span>
                            <svg class="w-5 h-5  transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="#latest" class="px-7 py-4 rounded-xl bg-white text-charcoal font-manrope font-bold text-base border border-bordercolor hover:border-teal hover:bg-teal-light/30 transition-all flex items-center justify-center">Latest Articles</a>
                    </div>
                    <!-- Trust Bar -->
                    <div class="pt-6 border-t border-bordercolor/80 flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-semibold text-textmuted">
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
    <section id="featured" class="py-16 md:py-20 border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 pb-4 border-b border-bordercolor">
                <div>
                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">CURATED READS</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-manrope font-extrabold text-charcoal mt-1">Featured on WP Gyani</h2>
                </div>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="mt-2 sm:mt-0 font-manrope font-bold text-sm text-teal-dark hover:text-teal flex items-center gap-1 group">
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
                <div class="lg:col-span-7 bg-white rounded-2xl border border-bordercolor p-5 sm:p-6 shadow-soft hover:shadow-card-hover transition-all group flex flex-col justify-between">
                    <?php 
                    $featured_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? $cat[0]->name : 'WordPress';
                    ?>
                    <div>
                        <div class="relative w-full aspect-[16/9] rounded-xl overflow-hidden bg-teal-light mb-6">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            <?php else : ?>
                                <img src="https://placehold.co/800x450/EAF6F5/333333?text=WP+Gyani" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <span class="absolute top-4 left-4 bg-teal text-white text-[11px] font-manrope font-extrabold uppercase px-3 py-1.5 rounded-md tracking-wider shadow-sm"><?php echo esc_html($cat_name); ?></span>
                        </div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-manrope font-bold text-charcoal group-hover:text-teal transition-colors leading-snug"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="font-inter text-textmuted text-sm sm:text-base mt-3 leading-relaxed line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-bordercolor flex items-center justify-between text-xs font-medium text-textmuted">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-teal-light text-teal font-bold flex items-center justify-center text-xs border border-teal/20"><?php echo strtoupper(substr(get_the_author(), 0, 2)); ?></div>
                            <div>
                                <span class="block font-bold text-charcoal"><?php the_author(); ?></span>
                                <span class="text-[11px]"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="bg-offwhite px-2.5 py-1 rounded text-charcoal text-[11px] font-semibold"><?php echo wp_gyani_reading_time(); ?> min read</span>
                            <a href="<?php the_permalink(); ?>" class="font-manrope font-bold text-teal group-hover:text-teal-dark flex items-center gap-1">Read Article &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- 4 Smaller Featured Posts Grid (Right, 5 cols) -->
                <div class="lg:col-span-5 flex flex-col gap-6 justify-between">
                    <?php while ($featured_query->have_posts()) : $featured_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? $cat[0]->name : 'Article';
                    ?>
                    <div class="bg-white rounded-2xl border border-bordercolor p-5 shadow-soft hover:shadow-card-hover transition-all group flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <div class="w-full sm:w-36 h-28 shrink-0 rounded-xl overflow-hidden bg-teal-light">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                            <?php else : ?>
                                <img src="https://placehold.co/300x200/EAF6F5/333333?text=Article" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="flex-1">
                            <span class="text-[10px] font-manrope font-extrabold text-teal uppercase tracking-wider block mb-1"><?php echo esc_html($cat_name); ?></span>
                            <h4 class="font-manrope font-bold text-base text-charcoal group-hover:text-teal transition-colors leading-snug line-clamp-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="mt-3 flex items-center gap-3 text-xs text-textmuted">
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
    <section id="categories" class="py-16 md:py-20 bg-white border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">STRUCTURED LEARNING</span>
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal mt-1">Explore WordPress Knowledge</h2>
                <p class="font-inter text-textmuted text-base mt-2">Browse curated tutorials, guides, and practical solutions organized by topic.</p>
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
                <a href="<?php echo get_category_link($cat->term_id); ?>" class="group p-6 rounded-2xl bg-white border border-bordercolor hover:border-teal hover:shadow-card-hover transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-teal-light text-teal flex items-center justify-center mb-5 group-hover:bg-teal group-hover:text-white transition-colors">
                            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><?php echo $icon_path; ?></svg>
                        </div>
                        <h3 class="font-manrope font-bold text-xl text-charcoal group-hover:text-teal transition-colors"><?php echo esc_html($cat->name); ?></h3>
                        <p class="font-inter text-textmuted text-sm mt-2 leading-relaxed"><?php echo esc_html(wp_trim_words($cat->description ? $cat->description : 'Explore all guides and tutorials.', 15)); ?></p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-bordercolor flex items-center justify-between text-xs font-bold text-teal-dark">
                        <span><?php echo $cat->count; ?> Guides</span><span class=" transition-transform">&rarr;</span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 5: LATEST ARTICLES -->
    <section id="latest" class="py-16 md:py-20 bg-offwhite border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Header & Filter Tabs -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">FRESH KNOWLEDGE</span>
                    <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal mt-1">Latest Articles & Tutorials</h2>
                </div>
                <!-- Interactive Category Filter Chips -->
                <div class="flex flex-wrap items-center gap-2 bg-white p-1.5 rounded-xl border border-bordercolor shadow-sm">
                    <button onclick="filterArticles('all')" id="btn-all" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all bg-teal text-white shadow-sm">All Topics</button>
                    <button onclick="filterArticles('speed')" id="btn-speed" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted hover:text-charcoal hover:bg-teal-light">Speed & SEO</button>
                    <button onclick="filterArticles('elementor')" id="btn-elementor" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted hover:text-charcoal hover:bg-teal-light">Elementor</button>
                    <button onclick="filterArticles('troubleshooting')" id="btn-troubleshooting" class="px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted hover:text-charcoal hover:bg-teal-light">Fix Errors</button>
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
                <article class="article-card bg-white rounded-2xl border border-bordercolor overflow-hidden flex flex-col justify-between relative transition-colors hover:border-bordercolor-hover group/card" data-category="<?php echo esc_attr($cat_class); ?>">
                    <div>
                        <div class="relative aspect-[16/9] overflow-hidden bg-teal-light border-b border-bordercolor/50">
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
                            <h3 class="font-manrope font-bold text-xl text-charcoal group-hover/card:text-teal transition-colors leading-snug">
                                <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-30 hover:underline"><?php the_title(); ?></a>
                            </h3>
                            <p class="font-inter text-textmuted text-sm mt-3 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-bordercolor/60 flex items-center justify-between text-xs text-textmuted">
                        <span class="font-medium"><?php echo get_the_date(); ?></span>
                        <span class="font-semibold text-charcoal bg-offwhite px-2 py-0.5 rounded"><?php echo wp_gyani_reading_time(); ?> min read</span>
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
    <section id="guides" class="py-16 md:py-20 bg-teal-light border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="max-w-2xl mb-12">
                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal-dark bg-white px-3 py-1 rounded-md border border-teal/20 inline-block">PILLAR KNOWLEDGE</span>
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal mt-3">WP Gyani Pillar Guides</h2>
                <p class="font-inter text-textmuted text-base mt-2">Comprehensive, step-by-step master guides built to take you from zero to expert on key WordPress subjects.</p>
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
                <div class="bg-white rounded-2xl border border-bordercolor p-7 shadow-soft hover:shadow-card-hover transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-manrope font-extrabold text-teal uppercase tracking-wider bg-teal-light px-2.5 py-1 rounded">PILLAR HUB</span>
                        </div>
                        <h3 class="font-manrope font-extrabold text-2xl text-charcoal group-hover:text-teal transition-colors"><?php the_title(); ?></h3>
                        <p class="font-inter text-textmuted text-sm mt-3 leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </div>
                    <div class="mt-8 pt-5 border-t border-bordercolor flex items-center justify-between">
                        <span class="text-xs font-bold text-charcoal">Updated <?php echo get_the_date('Y'); ?></span>
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
    <section class="py-16 md:py-20 bg-white border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left Column: Most Popular Numbered List (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-3 h-3 rounded-full bg-teal"></span>
                        <h2 class="text-2xl md:text-3xl font-manrope font-extrabold text-charcoal">Most Popular Articles</h2>
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
                        <div class="p-4 rounded-xl border border-bordercolor hover:border-teal transition-all flex items-start gap-4 group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>'">
                            <span class="font-manrope font-extrabold text-2xl text-teal-dark opacity-60 group-hover:opacity-100">0<?php echo $count++; ?></span>
                            <div>
                                <span class="text-[10px] font-bold text-teal uppercase tracking-wider"><?php echo esc_html($cat_name); ?></span>
                                <h4 class="font-manrope font-bold text-base text-charcoal group-hover:text-teal transition-colors mt-0.5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="text-xs text-textmuted mt-1"><?php echo wp_gyani_reading_time(); ?> min read &bull; <?php echo get_comments_number(); ?> comments</div>
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
                <div class="lg:col-span-5 bg-offwhite p-6 sm:p-8 rounded-2xl border border-bordercolor flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-bordercolor">
                            <h3 class="font-manrope font-bold text-xl text-charcoal flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-1.348l-3.75 3.75a1 1 0 00-.248.374l-1.5 4.5a1 1 0 001.264 1.264l4.5-1.5a1 1 0 00.374-.248l3.75-3.75a1 1 0 00-1.348-1.45L12 5.586l.395-3.033z" clip-rule="evenodd"/></svg>
                                Trending This Week
                            </h3>
                            <span class="text-xs font-bold text-teal bg-white px-2.5 py-1 rounded border border-bordercolor">LIVE FEED</span>
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
                            if ($trending_query->have_posts()) :
                                while ($trending_query->have_posts()) : $trending_query->the_post();
                                    $cat = get_the_category();
                                    $cat_name = !empty($cat) ? $cat[0]->name : 'Trending';
                            ?>
                            <a href="<?php the_permalink(); ?>" class="block p-3 rounded-lg hover:bg-white transition-all group"><span class="text-[10px] font-extrabold text-teal uppercase"><?php echo esc_html($cat_name); ?></span><h5 class="font-manrope font-bold text-sm text-charcoal group-hover:text-teal leading-snug"><?php the_title(); ?></h5></a>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <p class="text-sm text-textmuted">Not enough data to determine trends yet.</p>
                            <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="mt-8 pt-4 border-t border-bordercolor text-center">
                        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="font-manrope font-bold text-xs text-teal-dark hover:underline">Browse All Trending Articles &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: USEFUL WORDPRESS RESOURCES -->
    <section id="resources" class="py-16 md:py-20 bg-offwhite border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">CURATED TOOLKIT</span>
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal mt-1">Useful WordPress Resources</h2>
                <p class="font-inter text-textmuted text-sm mt-2">Tools, checklists, code snippets and curated recommendations to accelerate your workflow.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-bordercolor hover:border-teal transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-teal-light text-teal mx-auto flex items-center justify-center mb-4 ">
                        <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 01-3.586 0 2.548 2.548 0 010-3.586l5.653-4.655m3.03-2.496a2.652 2.652 0 00-3.75-3.75l-5.877 5.877"/></svg>
                    </div>
                    <h4 class="font-manrope font-bold text-lg text-charcoal">Speed Test Tools</h4>
                    <p class="font-inter text-textmuted text-xs mt-2 leading-relaxed">PageSpeed Insights, GTmetrix, and Pingdom benchmark suite.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-bordercolor hover:border-teal transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-teal-light text-teal mx-auto flex items-center justify-center mb-4 ">
                        <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="font-manrope font-bold text-lg text-charcoal">Pre-Launch Checklists</h4>
                    <p class="font-inter text-textmuted text-xs mt-2 leading-relaxed">42-point quality assurance checklist before client site launch.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-bordercolor hover:border-teal transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-teal-light text-teal mx-auto flex items-center justify-center mb-4 ">
                        <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/></svg>
                    </div>
                    <h4 class="font-manrope font-bold text-lg text-charcoal">Code Snippet Vault</h4>
                    <p class="font-inter text-textmuted text-xs mt-2 leading-relaxed">Tested PHP & CSS snippets for functions.php without heavy plugins.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-bordercolor hover:border-teal transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-teal-light text-teal mx-auto flex items-center justify-center mb-4 ">
                        <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="font-manrope font-bold text-lg text-charcoal">Free Template Library</h4>
                    <p class="font-inter text-textmuted text-xs mt-2 leading-relaxed">Ready-to-import Elementor container templates & section blocks.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 9: NEWSLETTER CTA -->
    <section id="newsletter" class="pt-12 md:pt-16 pb-12 md:pb-16 bg-white">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="bg-[#141A25] rounded-xl p-5 md:p-6 lg:p-8 flex flex-col md:flex-row items-center gap-6 lg:gap-8 shadow-2xl relative overflow-hidden">
                <!-- Background decoration (large circle on right) -->
                <div class="absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-1/4 w-80 h-80 bg-white/5 rounded-full pointer-events-none"></div>
                
                <!-- Icon -->
                <div class="hidden md:block shrink-0 w-24 lg:w-28 h-auto relative z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/newsletter-icon.png" alt="Newsletter" class="w-full h-auto drop-shadow-xl" />
                </div>
                
                <!-- Text -->
                <div class="flex-1 text-center md:text-left z-10">
                    <h2 class="text-2xl md:text-3xl font-manrope font-bold text-white tracking-tight">Get Smarter With WordPress</h2>
                    <p class="font-inter text-white/80 text-xs md:text-sm mt-2 leading-relaxed max-w-xl mx-auto md:mx-0">
                        Weekly <span class="text-amber-400 font-semibold">actionable WordPress tutorials</span>, <span class="text-amber-400 font-semibold">speed tweaks</span>, <span class="text-amber-400 font-semibold">security alerts</span> and resources delivered straight to your inbox.
                    </p>
                </div>
                
                <!-- Form -->
                <div class="w-full md:w-[380px] lg:w-[420px] shrink-0 z-10 flex flex-col justify-center">
                    <form onsubmit="handleSubscribe(event)" class="relative flex bg-white p-1 rounded-lg shadow-lg">
                        <input type="email" id="newsletter-email" placeholder="Enter your email address" required class="flex-1 bg-transparent px-4 py-2.5 text-charcoal font-inter text-sm border-none focus:ring-0 focus:outline-none placeholder-gray-400">
                        <button type="submit" class="px-5 py-2.5 rounded-md bg-[#1a202c] hover:bg-black text-white font-manrope font-bold text-sm transition-all whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                    <div class="mt-2 text-center md:text-left pl-2 flex items-center justify-between text-[10px] text-white/60 font-inter">
                        <span>No spam. Just useful WordPress knowledge.</span>
                        <svg class="w-3 h-3 opacity-50 hidden md:block text-[#FFFFFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 10: ABOUT WP GYANI (AUTHORITY & TRUST) -->
    <section id="about" class="py-20 md:py-28 bg-white border-b border-bordercolor relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-b from-offwhite to-transparent rounded-full blur-3xl opacity-50 transform translate-x-1/3 -translate-y-1/2 pointer-events-none"></div>

        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-12 items-start">
                <!-- Left: Text Content -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal/10 text-teal text-[11px] font-bold font-manrope uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal animate-pulse"></span>
                        Our Mission
                    </span>
                    <h2 class="text-4xl md:text-5xl lg:text-5xl font-manrope font-extrabold text-charcoal tracking-tight leading-[1.1]">
                        Your Practical <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-teal to-teal-dark">WordPress Hub</span>
                    </h2>
                    <p class="font-inter text-textmuted text-lg leading-relaxed">
                        WP Gyani was built with a simple mission: to eliminate confusion around WordPress development, search engine optimization, website speed, and security.
                    </p>
                    <p class="font-inter text-textmuted text-base leading-relaxed">
                        Whether you are building your very first blog, managing an online WooCommerce store, or engineering custom client websites with Elementor, our tested tutorials break down complex tech into simple actionable steps.
                    </p>
                    <div class="pt-4">
                        <a href="#newsletter" class="inline-flex items-center gap-2 font-manrope font-bold text-charcoal hover:text-teal transition-colors group">
                            Join the newsletter
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Resources Grid -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    
                    <!-- Card 1: WordPress Tools -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">WordPress Tools</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Essential tools to build and manage websites.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                    <!-- Card 2: Plugin Recommendations -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">Plugin Recoms</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Expert recommended WordPress plugins.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                    <!-- Card 3: Theme Recommendations -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">Theme Recoms</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Best themes for any type of website.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                    <!-- Card 4: SEO Tools -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">SEO Tools</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Improve your SEO with powerful tools.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                    <!-- Card 5: Performance Tools -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">Performance Tools</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Speed, optimization and analytics tools.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                    <!-- Card 6: Free Resources -->
                    <div class="bg-white border border-bordercolor rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 hover:border-teal/30 transition-all duration-300 text-center flex flex-col items-center group">
                        <div class="w-10 h-10 bg-offwhite group-hover:bg-teal/5 rounded-xl flex items-center justify-center text-teal mb-3 transition-colors border border-bordercolor/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </div>
                        <h4 class="font-manrope font-bold text-charcoal text-[13px] leading-tight mb-2">Free Resources</h4>
                        <p class="font-inter text-textmuted text-[11px] leading-relaxed mb-4 flex-1">Checklists, templates and free downloads.</p>
                        <a href="#" class="inline-flex items-center gap-1 text-[11px] font-bold text-charcoal group-hover:text-teal transition-colors mt-auto">Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
