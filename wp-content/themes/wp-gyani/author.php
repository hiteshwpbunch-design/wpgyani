<?php
/**
 * Author Archive Template
 *
 * Displays the author's profile (avatar, bio, social links) and a paginated
 * grid of their published posts.
 *
 * @package WP_Gyani
 */

get_header();

$current_author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id      = $current_author->ID;
$author_name    = $current_author->display_name;
$author_desc    = get_the_author_meta('description', $author_id);
$author_url     = get_the_author_meta('user_url', $author_id);
$author_link    = get_author_posts_url($author_id);
$paged          = get_query_var('paged') ? (int) get_query_var('paged') : 1;

// Count author's posts
$author_post_count = count_user_posts($author_id, 'post', true);
?>

<main id="primary" class="site-main">

    <!-- AUTHOR HERO SECTION -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 border-b border-bordercolor dark:border-gray-800 py-12 md:py-16 overflow-hidden">
        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-10 pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">

            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex items-center flex-wrap gap-1.5 text-xs font-medium text-textmuted dark:text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="hover:text-teal transition-colors">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li class="text-bordercolor dark:text-gray-600" aria-hidden="true">/</li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="text-charcoal dark:text-gray-200 font-semibold">
                        <span itemprop="name"><?php echo esc_html($author_name); ?></span>
                        <meta itemprop="item" content="<?php echo esc_url($author_link); ?>">
                        <meta itemprop="position" content="2">
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10">
                <!-- Avatar -->
                <div class="shrink-0">
                    <?php echo get_avatar($author_id, 140, '', '', array('class' => 'rounded-full border-4 border-white dark:border-gray-800 shadow-soft object-cover w-24 h-24 md:w-36 md:h-36')); ?>
                </div>
                
                <!-- Author Details -->
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2">
                        <h1 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white leading-tight">
                            <?php echo esc_html($author_name); ?>
                        </h1>
                        <?php if ($author_url): ?>
                            <a href="<?php echo esc_url($author_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Author Website" class="w-8 h-8 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 border border-bordercolor dark:border-gray-700 text-textmuted dark:text-gray-400 hover:border-teal hover:text-teal transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if ($author_desc): ?>
                        <p class="font-inter text-textmuted dark:text-gray-400 text-base md:text-lg max-w-3xl leading-relaxed">
                            <?php echo wp_kses_post($author_desc); ?>
                        </p>
                    <?php endif; ?>

                    <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-teal-light dark:bg-teal-900/50 text-teal-dark dark:text-teal font-manrope font-bold text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <?php echo (int) $author_post_count; ?> Article<?php echo $author_post_count == 1 ? '' : 's'; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ARTICLE GRID -->
    <section class="py-14 md:py-16 bg-white dark:bg-transparent">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <?php
            $author_query = new WP_Query(array(
                'author'         => $author_id,
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 12,
                'paged'          => $paged,
                'no_found_rows'  => false,
            ));

            if ($author_query->have_posts()):
                $item_position = (($paged - 1) * 12) + 1;
            ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" itemscope itemtype="https://schema.org/CollectionPage">
                    <meta itemprop="name" content="<?php echo esc_attr('Articles by ' . $author_name); ?>">
                    <meta itemprop="url" content="<?php echo esc_url($author_link); ?>">

                    <?php while ($author_query->have_posts()): $author_query->the_post(); 
                        $cats = get_the_category();
                        $cat_name = !empty($cats) ? $cats[0]->name : 'Tutorial';
                    ?>
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
                                    <h2 class="font-manrope font-bold text-xl text-charcoal dark:text-white group-hover/card:text-teal transition-colors leading-snug" itemprop="headline">
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

                <!-- SEO-FRIENDLY PAGINATION -->
                <?php $total_pages = (int) $author_query->max_num_pages; ?>
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
                               class="inline-flex items-center justify-center min-w-[38px] h-[38px] px-3 rounded-lg text-sm font-manrope font-bold border transition-all <?php echo $i === $paged ? 'bg-teal text-[#FFFFFF] border-teal' : 'border-bordercolor dark:border-gray-700 text-charcoal dark:text-gray-300 hover:border-teal hover:text-teal'; ?>">
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
                    <p class="text-textmuted dark:text-gray-400 font-inter text-base">This author hasn't published any articles yet.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-teal text-[#FFFFFF] font-manrope font-bold text-sm hover:bg-teal-dark transition-all">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php
// BreadcrumbList + CollectionPage JSON-LD
$schema = array(
    '@context' => 'https://schema.org',
    '@graph'   => array(
        array(
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
                array('@type' => 'ListItem', 'position' => 2, 'name' => $author_name, 'item' => $author_link),
            ),
        ),
        array(
            '@type'       => 'CollectionPage',
            'name'        => 'Articles by ' . $author_name,
            'url'         => $author_link,
            'description' => $author_desc ? wp_strip_all_tags($author_desc) : ('Articles written by ' . $author_name . ' on WP Gyani.'),
        ),
    ),
);
echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";

get_footer();
