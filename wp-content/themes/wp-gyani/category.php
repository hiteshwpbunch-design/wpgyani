<?php
/**
 * Category Archive Template ("Inner Page")
 *
 * Displays every published post that belongs to the current category,
 * 12 per page with SEO-friendly numbered pagination (up to 50 posts =
 * pages 1-5 for a fully seeded category). Includes on-page SEO basics:
 * a unique H1, a category intro paragraph, breadcrumb + BreadcrumbList
 * schema, and CollectionPage/BlogPosting JSON-LD.
 *
 * Meta description, canonical URL and Open Graph tags for this page are
 * printed by wp_gyani_category_seo_meta() in functions.php.
 *
 * @package WP_Gyani
 */

get_header();

$current_cat = get_queried_object();
$cat_name    = $current_cat->name;
$cat_desc    = category_description();
$cat_count   = $current_cat->count;
$cat_link    = get_category_link($current_cat);
$paged       = get_query_var('paged') ? (int) get_query_var('paged') : 1;
?>

<main id="primary" class="site-main">

    <!-- CATEGORY HERO / BREADCRUMB BAND -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 border-b border-bordercolor dark:border-gray-800 py-10 md:py-14 overflow-hidden">
        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-10 pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">

            <!-- Breadcrumb (visible + schema.org BreadcrumbList) -->
            <nav aria-label="Breadcrumb" class="mb-4">
                <ol class="flex items-center flex-wrap gap-1.5 text-xs font-medium text-textmuted dark:text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="hover:text-teal transition-colors">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li class="text-bordercolor dark:text-gray-600" aria-hidden="true">/</li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="text-charcoal dark:text-gray-200 font-semibold">
                        <span itemprop="name"><?php echo esc_html($cat_name); ?></span>
                        <meta itemprop="item" content="<?php echo esc_url($cat_link); ?>">
                        <meta itemprop="position" content="2">
                    </li>
                </ol>
            </nav>

            <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">Category</span>
            <h1 class="text-3xl md:text-5xl font-manrope font-extrabold text-charcoal dark:text-white mt-1 leading-tight">
                <?php echo esc_html($cat_name); ?> Tutorials &amp; Guides
            </h1>

            <?php if ($cat_desc): ?>
                <div class="font-inter text-textmuted dark:text-gray-400 text-base md:text-lg mt-4 max-w-3xl leading-relaxed">
                    <?php echo wp_kses_post($cat_desc); ?>
                </div>
            <?php else: ?>
                <p class="font-inter text-textmuted dark:text-gray-400 text-base md:text-lg mt-4 max-w-3xl leading-relaxed">
                    Browse every <?php echo esc_html($cat_name); ?> article on WP Gyani &mdash; practical, step-by-step
                    WordPress tutorials written to help you build, optimize and troubleshoot faster.
                </p>
            <?php endif; ?>

            <div class="mt-4 text-xs font-semibold text-textmuted dark:text-gray-500">
                <?php echo esc_html($cat_count); ?> article<?php echo $cat_count == 1 ? '' : 's'; ?> in this category
            </div>
        </div>
    </section>

    <!-- ARTICLE GRID -->
    <section class="py-14 md:py-16 bg-white dark:bg-transparent">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <?php
            $cat_query = new WP_Query(array(
                'cat'            => $current_cat->term_id,
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 12,
                'paged'          => $paged,
                'no_found_rows'  => false,
            ));

            if ($cat_query->have_posts()):
                $item_position = (($paged - 1) * 12) + 1;
            ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" itemscope itemtype="https://schema.org/CollectionPage">
                    <meta itemprop="name" content="<?php echo esc_attr($cat_name . ' Tutorials & Guides'); ?>">
                    <meta itemprop="url" content="<?php echo esc_url($cat_link); ?>">

                    <?php while ($cat_query->have_posts()): $cat_query->the_post(); ?>
                        <article <?php post_class('bg-white dark:bg-gray-800 rounded-2xl border border-bordercolor dark:border-gray-700 overflow-hidden flex flex-col justify-between relative transition-colors hover:border-bordercolor-hover dark:hover:border-gray-500 group/card'); ?> itemscope itemtype="https://schema.org/BlogPosting" itemprop="mainEntity">
                            <meta itemprop="position" content="<?php echo (int) $item_position++; ?>">
                            <div>
                                <div class="relative aspect-[16/9] overflow-hidden bg-teal-light border-b border-bordercolor/50 dark:border-gray-700">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium_large', array(
                                            'class'   => 'w-full h-full object-cover relative z-0',
                                            'loading' => 'lazy',
                                            'alt'     => get_the_title(),
                                            'itemprop'=> 'image',
                                        )); ?>
                                    <?php else: ?>
                                        <img src="https://placehold.co/600x340/EAF6F5/333333?text=WP+Gyani" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover relative z-0" loading="lazy" itemprop="image">
                                    <?php endif; ?>
                                    <!-- Dark overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10 pointer-events-none"></div>
                                    <span class="absolute top-3 left-3 bg-teal text-white text-[10px] font-manrope font-extrabold uppercase px-2.5 py-1 rounded z-20"><?php echo esc_html($cat_name); ?></span>
                                </div>
                                <div class="p-6">
                                    <h2 class="font-manrope font-bold text-xl text-charcoal dark:text-white leading-snug group-hover/card:text-teal transition-colors" itemprop="headline">
                                        <a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-30 hover:underline" itemprop="url"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="font-inter text-textmuted dark:text-gray-400 text-sm mt-3 line-clamp-2" itemprop="description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                </div>
                            </div>
                            <div class="px-6 pb-6 pt-2 border-t border-bordercolor/60 dark:border-gray-700 flex items-center justify-between text-xs text-textmuted dark:text-gray-400">
                                <span class="font-medium" itemprop="datePublished" content="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo get_the_date(); ?></span>
                                <span class="font-semibold text-charcoal dark:text-gray-200 bg-offwhite dark:bg-gray-700 px-2 py-0.5 rounded"><?php echo (int) wp_gyani_reading_time(); ?> min read</span>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- SEO-FRIENDLY PAGINATION (crawlable <a> links, rel=prev/next) -->
                <?php $total_pages = (int) $cat_query->max_num_pages; ?>
                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Article pagination" class="mt-12 flex items-center justify-center gap-1.5 flex-wrap">
                        <?php if ($paged > 1): ?>
                            <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" rel="prev" class="inline-flex items-center justify-center h-[38px] px-4 rounded-lg text-sm font-manrope font-bold border border-bordercolor dark:border-gray-700 text-charcoal dark:text-gray-300 hover:border-teal hover:text-teal transition-all">&larr; Newer</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++):
                            $show = ($i === 1 || $i === $total_pages || abs($i - $paged) <= 1);
                            if ($show):
                        ?>
                            <a href="<?php echo esc_url(get_pagenum_link($i)); ?>"
                               <?php echo $i === $paged ? 'aria-current="page"' : ''; ?>
                               class="inline-flex items-center justify-center min-w-[38px] h-[38px] px-3 rounded-lg text-sm font-manrope font-bold border transition-all <?php echo $i === $paged ? 'bg-teal text-white border-teal' : 'border-bordercolor dark:border-gray-700 text-charcoal dark:text-gray-300 hover:border-teal hover:text-teal'; ?>">
                                <?php echo (int) $i; ?>
                            </a>
                        <?php elseif (abs($i - $paged) === 2): ?>
                            <span class="px-1 text-textmuted dark:text-gray-500" aria-hidden="true">&hellip;</span>
                        <?php endif; endfor; ?>

                        <?php if ($paged < $total_pages): ?>
                            <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" rel="next" class="inline-flex items-center justify-center h-[38px] px-4 rounded-lg text-sm font-manrope font-bold border border-bordercolor dark:border-gray-700 text-charcoal dark:text-gray-300 hover:border-teal hover:text-teal transition-all">Older &rarr;</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>

            <?php
                wp_reset_postdata();
            else:
            ?>
                <div class="text-center py-16">
                    <p class="text-textmuted dark:text-gray-400 font-inter text-base">No articles have been published in this category yet. Check back soon!</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-teal text-white font-manrope font-bold text-sm hover:bg-teal-dark transition-all">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php
// BreadcrumbList + CollectionPage JSON-LD (search engines prefer JSON-LD over microdata,
// so we output both — this is the richer, primary signal).
$schema = array(
    '@context' => 'https://schema.org',
    '@graph'   => array(
        array(
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
                array('@type' => 'ListItem', 'position' => 2, 'name' => $cat_name, 'item' => $cat_link),
            ),
        ),
        array(
            '@type'       => 'CollectionPage',
            'name'        => $cat_name . ' Tutorials & Guides',
            'url'         => $cat_link,
            'description' => $cat_desc ? wp_strip_all_tags($cat_desc) : ($cat_name . ' tutorials and guides on WP Gyani.'),
        ),
    ),
);
echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";

get_footer();