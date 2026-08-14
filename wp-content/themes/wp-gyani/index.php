<?php
/**
 * The main template file
 *
 * @package WP_Gyani
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- MINIMAL BLOG HERO SECTION -->
    <section class="bg-offwhite pt-12 pb-12 border-b border-bordercolor">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex items-center gap-2 text-sm font-medium text-textmuted">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-teal transition-colors">Home</a>
                    </li>
                    <li class="text-gray-300">/</li>
                    <li class="text-charcoal font-semibold">
                        <?php echo is_home() && !is_front_page() ? single_post_title('', false) : 'Blog'; ?>
                    </li>
                </ol>
            </nav>

            <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal mb-3 block">BLOG</span>
            
            <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl text-charcoal leading-tight tracking-tight mb-4">
                <?php
                if (is_home() && !is_front_page()) {
                    single_post_title();
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
            
            <p class="font-inter text-sm text-textmuted">
                Last updated <?php echo date('F j, Y'); ?>
            </p>
        </div>
    </section>

    <!-- ARTICLES GRID & SIDEBAR -->
    <section class="py-16 md:py-20">
        <!-- FILTER & SEARCH BAR -->
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 mb-12">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="flex flex-col gap-5">
                
                <!-- Filters & Toggles Row -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-3 rounded-2xl border border-bordercolor shadow-sm">
                    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs font-bold font-manrope text-textmuted uppercase tracking-wider ml-2 hidden sm:block">Filter by:</span>
                        
                        <!-- Category Filter -->
                        <div class="relative w-full sm:w-48">
                            <?php
                            $categories = get_categories(array('hide_empty' => true));
                            $current_cat = is_category() ? get_query_var('cat') : (isset($_GET['cat']) ? (int)$_GET['cat'] : 0);
                            ?>
                            <select name="cat" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2.5 rounded-xl border-none focus:ring-2 focus:ring-teal/20 focus:outline-none text-sm text-charcoal bg-offwhite appearance-none cursor-pointer font-medium hover:bg-bordercolor/40 transition-colors">
                                <option value="0">All Categories</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo esc_attr($category->term_id); ?>" <?php selected($current_cat, $category->term_id); ?>>
                                        <?php echo esc_html($category->name); ?> (<?php echo esc_html($category->count); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <!-- Sort Filter -->
                        <div class="relative w-full sm:w-48">
                            <?php $current_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest'; ?>
                            <select name="sort" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2.5 rounded-xl border-none focus:ring-2 focus:ring-teal/20 focus:outline-none text-sm text-charcoal bg-offwhite appearance-none cursor-pointer font-medium hover:bg-bordercolor/40 transition-colors">
                                <option value="newest" <?php selected($current_sort, 'newest'); ?>>Newest First</option>
                                <option value="oldest" <?php selected($current_sort, 'oldest'); ?>>Oldest First</option>
                                <option value="popular" <?php selected($current_sort, 'popular'); ?>>Most Popular</option>
                                <option value="az" <?php selected($current_sort, 'az'); ?>>Alphabetical (A-Z)</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    
                    <!-- View Toggles -->
                    <div class="hidden md:flex bg-offwhite p-1 rounded-xl border border-bordercolor items-center">
                        <button type="button" id="btn-grid" onclick="setBlogView('grid')" class="p-2 rounded-lg text-teal bg-white shadow-sm transition-all" aria-label="Grid View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        </button>
                        <button type="button" id="btn-list" onclick="setBlogView('list')" class="p-2 rounded-lg text-gray-400 hover:text-teal transition-all" aria-label="List View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- MAIN CONTENT AREA -->
                <div class="lg:col-span-8">
                    <?php if (have_posts()): ?>
                        <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 transition-all duration-300">
                            <?php while (have_posts()): the_post(); ?>
                                <?php
                                $categories = get_the_category();
                                $cat_name = $categories ? $categories[0]->name : 'Uncategorized';
                                ?>
                                <article <?php post_class('bg-white rounded-2xl border border-bordercolor overflow-hidden flex flex-col h-full relative transition-colors hover:border-bordercolor-hover group/card'); ?>>
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
                                            <h2 class="font-manrope font-bold text-xl text-charcoal group-hover/card:text-teal transition-colors leading-snug">
                                                <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-30 hover:underline"><?php the_title(); ?></a>
                                            </h2>
                                            <p class="font-inter text-textmuted text-sm mt-3 mb-5 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                            
                                            <div class="meta-footer mt-auto pt-4 border-t border-bordercolor/60 flex items-center justify-between text-xs text-textmuted relative z-10">
                                                <span class="font-medium"><?php echo get_the_date(); ?></span>
                                                <span class="font-semibold text-charcoal bg-offwhite px-2 py-0.5 rounded"><?php echo wp_gyani_reading_time(); ?> min read</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-16 text-center">
                            <?php 
                            the_posts_pagination(array(
                                'mid_size' => 2,
                                'prev_text' => '&larr; Prev',
                                'next_text' => 'Next &rarr;',
                                'class' => 'font-manrope font-bold',
                            )); 
                            ?>
                        </div>
                        <style>
                            /* Style the default WP pagination nicely */
                            .nav-links { display: inline-flex; gap: 0.5rem; align-items: center; justify-content: center; }
                            .nav-links .page-numbers { padding: 0.5rem 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; background: #fff; color: #4b5563; text-decoration: none; transition: all 0.2s; }
                            .nav-links .page-numbers:hover { border-color: #14b8a6; color: #14b8a6; background: #f0fdfa; }
                            .nav-links .page-numbers.current { background: #14b8a6; color: #fff; border-color: #14b8a6; }
                            .nav-links .dots { border: none; background: transparent; padding: 0.5rem; pointer-events: none; }
                        </style>
                    <?php else: ?>
                        <div class="text-center py-20 bg-white border border-bordercolor rounded-2xl shadow-sm">
                            <p class="text-textmuted text-lg mb-6">No articles found.</p>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="px-6 py-3 rounded-xl bg-teal text-white font-manrope font-bold hover:bg-teal-dark transition-colors inline-block">Return Home</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- SIDEBAR -->
                <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-24 h-max">
                    
                    <!-- Widget: Search -->
                    <div class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft">
                        <h3 class="font-manrope font-extrabold text-lg text-charcoal mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Search
                        </h3>
                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="relative">
                            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search articles..." class="w-full pl-4 pr-12 py-3 rounded-xl border border-bordercolor focus:outline-none focus:border-teal focus:ring-2 focus:ring-teal/20 text-sm bg-offwhite transition-all">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal transition-colors" aria-label="Search">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </form>
                    </div>
                    <!-- Widget: Popular Topics -->
                    <div class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft">
                        <h3 class="font-manrope font-extrabold text-lg text-charcoal mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Popular Topics
                        </h3>
                        <ul class="space-y-3 font-medium text-sm text-textmuted">
                            <?php
                            $sidebar_cats = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'number' => 6));
                            foreach ($sidebar_cats as $cat):
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="flex items-center justify-between hover:text-teal transition-colors group">
                                    <span><?php echo esc_html($cat->name); ?></span>
                                    <span class="bg-offwhite px-2 py-0.5 rounded text-xs group-hover:bg-teal-light group-hover:text-teal-dark transition-colors"><?php echo esc_html($cat->count); ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Widget: Newsletter -->
                    <div class="p-6 rounded-2xl bg-gradient-to-br from-teal-light via-white to-offwhite border border-bordercolor shadow-soft text-center">
                        <div class="w-12 h-12 bg-teal rounded-full text-white flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-manrope font-extrabold text-xl text-charcoal mb-2">Join our Newsletter</h3>
                        <p class="font-inter text-sm text-textmuted mb-4">Get the latest WordPress tips and tutorials straight to your inbox.</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Email Address" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-teal text-sm">
                            <button type="button" class="w-full px-4 py-3 bg-teal text-white rounded-xl font-manrope font-bold text-sm hover:bg-teal-dark transition-colors shadow-soft">Subscribe Now</button>
                        </form>
                    </div>

                    <!-- Widget: Latest Posts -->
                    <div class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft">
                        <h3 class="font-manrope font-extrabold text-lg text-charcoal mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/></svg>
                            Latest Posts
                        </h3>
                        <ul class="space-y-4">
                            <?php
                            $latest_posts = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'ignore_sticky_posts' => true));
                            while ($latest_posts->have_posts()): $latest_posts->the_post();
                            ?>
                            <li class="flex gap-3 items-start group">
                                <a href="<?php the_permalink(); ?>" class="shrink-0 w-16 h-16 rounded-lg overflow-hidden bg-offwhite">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300')); ?>
                                    <?php else: ?>
                                        <img src="https://placehold.co/150x150/EAF6F5/333333?text=WP" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    <?php endif; ?>
                                </a>
                                <div>
                                    <h4 class="font-manrope font-bold text-sm text-charcoal group-hover:text-teal transition-colors leading-tight line-clamp-2">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <span class="text-xs text-textmuted mt-1 block"><?php echo get_the_date(); ?></span>
                                </div>
                            </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>

                </aside>
            </div>
        </div>
    </section>
</main>

<style>
    /* List View Overrides */
    #articles-grid.layout-list {
        grid-template-columns: 1fr;
    }
    @media (min-width: 768px) {
        #articles-grid.layout-list article {
            flex-direction: row;
            align-items: stretch;
        }
        #articles-grid.layout-list article .img-container {
            width: 35%;
            flex-shrink: 0;
            border-right: 1px solid #e5e7eb;
            height: auto;
        }
        #articles-grid.layout-list article .content-container {
            width: 65%;
            display: flex;
            flex-direction: column;
        }
    }
</style>
<script>
    function setBlogView(view) {
        const grid = document.getElementById('articles-grid');
        if(!grid) return;
        
        const btnGrid = document.getElementById('btn-grid');
        const btnList = document.getElementById('btn-list');
        
        if (view === 'list') {
            grid.classList.add('layout-list');
            btnList.classList.add('bg-white', 'shadow-sm', 'text-teal');
            btnList.classList.remove('text-gray-400');
            btnGrid.classList.remove('bg-white', 'shadow-sm', 'text-teal');
            btnGrid.classList.add('text-gray-400');
            localStorage.setItem('blog_view', 'list');
        } else {
            grid.classList.remove('layout-list');
            btnGrid.classList.add('bg-white', 'shadow-sm', 'text-teal');
            btnGrid.classList.remove('text-gray-400');
            btnList.classList.remove('bg-white', 'shadow-sm', 'text-teal');
            btnList.classList.add('text-gray-400');
            localStorage.setItem('blog_view', 'grid');
        }
    }

    // Initialize view on load
    document.addEventListener('DOMContentLoaded', () => {
        const savedView = localStorage.getItem('blog_view') || 'grid';
        setBlogView(savedView);
    });
</script>

<?php
get_footer();
