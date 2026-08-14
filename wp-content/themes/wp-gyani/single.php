<?php
/**
 * The single post template
 *
 * Modern editorial redesign inspired by patterns from leading publications
 * (Medium, Smashing Magazine, CSS-Tricks, Stripe/Ahrefs blogs):
 *  - Reading progress bar + a sticky "shrunk" header that appears on scroll
 *  - Floating vertical share/save rail beside the content on desktop
 *  - A "Key Takeaways" callout for skimmability
 *  - A scrollspy table of contents that highlights the section you're on
 *  - A full-width "Continue Reading" grid + a closing newsletter band
 *  - Article + BreadcrumbList JSON-LD for SEO
 *
 * @package WP_Gyani
 */

get_header();

while (have_posts()): the_post();

    $categories   = get_the_category();
    $primary_cat  = !empty($categories) ? $categories[0] : null;
    $author_id    = get_the_author_meta('ID');
    $author_bio   = get_the_author_meta('description');
    $reading_time = wp_gyani_reading_time();
    $post_id      = get_the_ID();

    $takeaway = has_excerpt()
        ? get_the_excerpt()
        : wp_trim_words(wp_strip_all_tags(get_the_content()), 34);
?>

    <!-- READING PROGRESS BAR -->
    <div class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-teal to-teal-dark z-[60] transition-[width] duration-150" id="reading-progress" style="width:0%"></div>

    <!-- STICKY MINI HEADER (shows once you scroll past the hero) -->
    <!-- <div id="sticky-header" class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-md border-b border-bordercolor -translate-y-full opacity-0 transition-all duration-300">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 h-14 flex items-center justify-between gap-4">
            <span class="font-manrope font-bold text-sm text-charcoal truncate"><?php the_title(); ?></span>
            <div class="hidden sm:flex items-center gap-1.5 flex-shrink-0">
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X / Twitter" class="w-8 h-8 flex items-center justify-center rounded-lg text-textmuted hover:text-teal hover:bg-teal-light transition-all">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <button onclick="wpGyaniCopyLink()" aria-label="Copy link" class="w-8 h-8 flex items-center justify-center rounded-lg text-textmuted hover:text-teal hover:bg-teal-light transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 015.656 5.656l-1.5 1.5"/></svg>
                </button>
            </div>
            <a href="#comments" class="flex-shrink-0 px-4 py-1.5 rounded-lg bg-teal text-[#FFFFFF] font-manrope font-bold text-xs hover:bg-teal-dark transition-all">Comments</a>
        </div>
    </div> -->

    <main id="primary" class="site-main">

        <!-- POST HERO -->
        <section id="post-hero" class="relative bg-gradient-to-b from-teal-light/60 via-offwhite to-white border-b border-bordercolor pt-8 pb-10 md:pt-12 md:pb-14 overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 22px 22px;"></div>

            <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">

                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb" class="mb-5">
                    <ol class="flex items-center flex-wrap gap-1.5 text-xs font-medium text-textmuted" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="hover:text-teal transition-colors">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <?php if ($primary_cat): ?>
                            <li class="text-bordercolor" aria-hidden="true">/</li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a href="<?php echo esc_url(get_category_link($primary_cat)); ?>" itemprop="item" class="hover:text-teal transition-colors">
                                    <span itemprop="name"><?php echo esc_html($primary_cat->name); ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                        <?php endif; ?>
                        <li class="text-bordercolor" aria-hidden="true">/</li>
                        <li class="text-charcoal font-semibold truncate max-w-[220px] sm:max-w-none" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <span itemprop="name"><?php the_title(); ?></span>
                            <meta itemprop="item" content="<?php the_permalink(); ?>">
                            <meta itemprop="position" content="<?php echo $primary_cat ? '3' : '2'; ?>">
                        </li>
                    </ol>
                </nav>

                <?php if ($primary_cat): ?>
                    <a href="<?php echo esc_url(get_category_link($primary_cat)); ?>" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal text-[#FFFFFF] text-[11px] font-manrope font-extrabold uppercase tracking-wider hover:bg-teal-dark transition-colors">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <?php echo esc_html($primary_cat->name); ?>
                    </a>
                <?php endif; ?>

                <h1 class="font-manrope font-extrabold text-2xl sm:text-3xl md:text-4xl text-charcoal mt-4 leading-[1.3] tracking-tight">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="font-inter text-textmuted text-lg mt-4 leading-relaxed"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <!-- Author + meta row -->
                <div class="flex items-center flex-wrap justify-between gap-4 mt-7 pt-6 border-t border-bordercolor/70">
                    <div class="flex items-center gap-3">
                        <?php echo get_avatar($author_id, 48, '', '', array('class' => 'rounded-full border-2 border-[#FFFFFF] shadow-soft flex-shrink-0')); ?>
                        <div class="leading-tight">
                            <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="font-manrope font-bold text-sm text-charcoal hover:text-teal transition-colors"><?php the_author(); ?></a>
                            <div class="text-xs text-textmuted mt-0.5"><?php echo get_the_date(); ?> &bull; <?php echo (int) $reading_time; ?> min read</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X / Twitter" class="w-9 h-9 flex items-center justify-center rounded-full bg-white border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn" class="w-9 h-9 flex items-center justify-center rounded-full bg-white border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.446-2.136 2.94v5.666H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/></svg>
                        </a>
                        <button id="bookmark-btn" onclick="wpGyaniToggleBookmark(<?php echo (int) $post_id; ?>)" aria-label="Save for later" class="w-9 h-9 flex items-center justify-center rounded-full bg-white border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                            <svg id="bookmark-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT + SIDEBAR -->
        <section class="py-12 md:py-16">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                    <!-- MAIN COLUMN: floating share rail + article -->
                    <div class="lg:col-span-8 flex gap-6 items-start">

                        <!-- FLOATING SHARE / SAVE RAIL (desktop only) -->
                        <div class="hidden lg:flex flex-col items-center gap-2 sticky top-28 flex-shrink-0">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X / Twitter" class="w-10 h-10 flex items-center justify-center rounded-full border border-bordercolor text-charcoal hover:border-teal hover:text-teal hover:-translate-y-0.5 transition-all">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook" class="w-10 h-10 flex items-center justify-center rounded-full border border-bordercolor text-charcoal hover:border-teal hover:text-teal hover:-translate-y-0.5 transition-all">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn" class="w-10 h-10 flex items-center justify-center rounded-full border border-bordercolor text-charcoal hover:border-teal hover:text-teal hover:-translate-y-0.5 transition-all">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.446-2.136 2.94v5.666H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 11.001-4.124 2.062 2.062 0 01-.001 4.124zM7.114 20.452H3.558V9h3.556v11.452z"/></svg>
                            </a>
                            <button onclick="wpGyaniCopyLink()" aria-label="Copy link" class="w-10 h-10 flex items-center justify-center rounded-full border border-bordercolor text-charcoal hover:border-teal hover:text-teal hover:-translate-y-0.5 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 015.656 5.656l-1.5 1.5"/></svg>
                            </button>
                            <div class="w-8 h-px bg-bordercolor my-1"></div>
                            <div class="text-[10px] font-bold text-textmuted [writing-mode:vertical-rl] tracking-widest uppercase">Share</div>
                        </div>

                        <article <?php post_class('bg-white flex-1 min-w-0'); ?> itemscope itemtype="https://schema.org/BlogPosting">

                            <!-- FEATURED IMAGE -->
                            <?php if (has_post_thumbnail()): ?>
                                <div class="relative aspect-[16/9] rounded-2xl overflow-hidden bg-teal-light border border-bordercolor mb-8">
                                    <?php the_post_thumbnail('large', array(
                                        'class'    => 'w-full h-full object-cover',
                                        'alt'      => get_the_title(),
                                        'itemprop' => 'image',
                                    )); ?>
                                </div>
                            <?php endif; ?>

                            <!-- KEY TAKEAWAYS -->
                            <div class="p-5 md:p-6 rounded-2xl bg-teal-light/60 border border-teal/20 mb-8">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal-dark">Key Takeaway</span>
                                </div>
                                <p class="font-inter text-charcoal text-sm md:text-base leading-relaxed"><?php echo esc_html($takeaway); ?></p>
                            </div>

                            <!-- Article body -->
                            <div class="prose max-w-none font-inter text-base md:text-[17px] leading-[1.85] text-charcoal
                                        prose-headings:font-manrope prose-headings:font-extrabold prose-headings:text-charcoal prose-headings:scroll-mt-24
                                        prose-h2:text-2xl prose-h2:mt-12 prose-h2:mb-4
                                        prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                                        prose-a:text-teal prose-a:font-semibold prose-a:no-underline hover:prose-a:underline hover:prose-a:text-teal-dark
                                        prose-strong:text-charcoal
                                        prose-img:rounded-xl prose-img:border prose-img:border-bordercolor
                                        prose-blockquote:border-l-4 prose-blockquote:border-l-teal prose-blockquote:bg-teal-light/50 prose-blockquote:not-italic prose-blockquote:font-manrope prose-blockquote:font-semibold prose-blockquote:text-charcoal prose-blockquote:py-3 prose-blockquote:px-5 prose-blockquote:rounded-r-xl
                                        prose-code:text-teal-dark prose-code:bg-teal-light prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm prose-code:before:content-none prose-code:after:content-none"
                                 itemprop="articleBody" id="single-content">
                                <?php the_content(); ?>
                            </div>

                            <!-- Tags -->
                            <?php $tags = get_the_tags(); if ($tags): ?>
                                <div class="flex flex-wrap items-center gap-2 mt-10 pt-8 border-t border-bordercolor">
                                    <span class="text-xs font-bold font-manrope uppercase tracking-widest text-textmuted mr-1">Tagged</span>
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="px-3 py-1.5 rounded-lg bg-offwhite text-charcoal font-medium text-xs hover:bg-teal-light hover:text-teal-dark transition-colors border border-bordercolor">#<?php echo esc_html($tag->name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Mobile share / reaction bar -->
                            <div class="flex lg:hidden items-center justify-between mt-8 pt-6 border-t border-bordercolor">
                                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-textmuted">Share this article</span>
                                <div class="flex items-center gap-2">
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X / Twitter" class="w-9 h-9 flex items-center justify-center rounded-lg border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook" class="w-9 h-9 flex items-center justify-center rounded-lg border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                    </a>
                                    <button onclick="wpGyaniCopyLink()" aria-label="Copy link" class="w-9 h-9 flex items-center justify-center rounded-lg border border-bordercolor text-charcoal hover:border-teal hover:text-teal transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 015.656 5.656l-1.5 1.5"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- AUTHOR BIO CARD -->
                            <div class="mt-10 p-6 md:p-8 rounded-2xl bg-offwhite border border-bordercolor flex flex-col sm:flex-row items-start gap-5">
                                <?php echo get_avatar($author_id, 72, '', '', array('class' => 'rounded-full border border-bordercolor flex-shrink-0')); ?>
                                <div>
                                    <div class="text-xs font-bold font-manrope uppercase tracking-widest text-teal mb-1">Written by</div>
                                    <div class="font-manrope font-extrabold text-lg text-charcoal">
                                        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="hover:text-teal transition-colors"><?php the_author(); ?></a>
                                    </div>
                                    <p class="font-inter text-textmuted text-sm mt-2 leading-relaxed">
                                        <?php echo $author_bio ? esc_html($author_bio) : 'Contributor at WP Gyani, writing practical WordPress tutorials on speed, Elementor, SEO and troubleshooting.'; ?>
                                    </p>
                                </div>
                            </div>

                            <!-- PREV / NEXT NAVIGATION -->
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            if ($prev_post || $next_post):
                            ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                                    <?php if ($prev_post): ?>
                                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="group p-5 rounded-2xl border border-bordercolor bg-white hover:border-teal hover:shadow-card-hover transition-all">
                                            <span class="text-[10px] font-bold font-manrope uppercase tracking-widest text-textmuted flex items-center gap-1.5">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                                Previous Article
                                            </span>
                                            <span class="block mt-2 font-manrope font-bold text-sm text-charcoal group-hover:text-teal transition-colors line-clamp-2"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </a>
                                    <?php else: ?><div></div><?php endif; ?>

                                    <?php if ($next_post): ?>
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="group p-5 rounded-2xl border border-bordercolor bg-white hover:border-teal hover:shadow-card-hover transition-all text-right">
                                            <span class="text-[10px] font-bold font-manrope uppercase tracking-widest text-textmuted flex items-center justify-end gap-1.5">
                                                Next Article
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                            </span>
                                            <span class="block mt-2 font-manrope font-bold text-sm text-charcoal group-hover:text-teal transition-colors line-clamp-2"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- COMMENTS -->
                            <?php if (comments_open() || get_comments_number()): ?>
                                <div id="comments-anchor" class="mt-12 pt-10 border-t border-bordercolor">
                                    <?php comments_template(); ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    </div>

                    <!-- SIDEBAR -->
                    <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                        <!-- TABLE OF CONTENTS with scrollspy (auto-built from H2s via JS) -->
                        <div id="toc-card" class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft hidden">
                            <h3 class="font-manrope font-extrabold text-sm uppercase tracking-wider text-charcoal mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                On This Page
                            </h3>
                            <ul id="toc-list" class="space-y-1 text-sm font-medium text-textmuted border-l-2 border-bordercolor"></ul>
                        </div>

                        <!-- RELATED ARTICLES -->
                        <?php
                        $related_ids = array(get_the_ID());
                        if ($primary_cat):
                            $related = new WP_Query(array(
                                'post_type'          => 'post',
                                'posts_per_page'     => 4,
                                'post__not_in'       => array(get_the_ID()),
                                'ignore_sticky_posts' => true,
                                'cat'                => $primary_cat->term_id,
                            ));
                            if ($related->have_posts()):
                        ?>
                            <div class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft">
                                <h3 class="font-manrope font-extrabold text-sm uppercase tracking-wider text-charcoal mb-4">
                                    More in <?php echo esc_html($primary_cat->name); ?>
                                </h3>
                                <div class="space-y-4">
                                    <?php while ($related->have_posts()): $related->the_post(); $related_ids[] = get_the_ID(); ?>
                                        <a href="<?php the_permalink(); ?>" class="flex items-center gap-3 group">
                                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-teal-light flex-shrink-0">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300')); ?>
                                                <?php else: ?>
                                                    <img src="https://placehold.co/100x100/EAF6F5/333333?text=WP" alt="" class="w-full h-full object-cover">
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="font-manrope font-bold text-sm text-charcoal group-hover:text-teal transition-colors leading-snug line-clamp-2"><?php the_title(); ?></div>
                                                <div class="text-xs text-textmuted mt-1"><?php echo get_the_date(); ?></div>
                                            </div>
                                        </a>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                                <a href="<?php echo esc_url(get_category_link($primary_cat)); ?>" class="block text-center mt-5 py-2.5 rounded-xl border border-bordercolor text-charcoal font-manrope font-bold text-xs hover:border-teal hover:text-teal transition-all">
                                    View All <?php echo esc_html($primary_cat->name); ?> Articles
                                </a>
                            </div>
                        <?php
                            endif;
                        endif;
                        ?>
                    </aside>
                </div>
            </div>
        </section>

        <!-- CONTINUE READING (full-width grid) -->
        <?php
        $continue_reading = new WP_Query(array(
            'post_type'           => 'post',
            'posts_per_page'      => 3,
            'post__not_in'        => $related_ids,
            'ignore_sticky_posts' => true,
            'orderby'             => 'date',
            'order'               => 'DESC',
        ));
        if ($continue_reading->have_posts()):
        ?>
            <section class="py-14 md:py-16 bg-offwhite border-t border-bordercolor">
                <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                    <h2 class="text-2xl md:text-3xl font-manrope font-extrabold text-charcoal mb-8">Continue Reading</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php while ($continue_reading->have_posts()): $continue_reading->the_post();
                            $cr_cats = get_the_category();
                            $cat_name = !empty($cr_cats) ? $cr_cats[0]->name : 'WordPress';
                        ?>
                            <article <?php post_class('bg-white rounded-2xl border border-bordercolor overflow-hidden flex flex-col justify-between relative transition-colors hover:border-bordercolor-hover group/card'); ?>>
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
                                        <p class="font-inter text-textmuted text-sm mt-3 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                    </div>
                                </div>
                                <div class="px-6 pb-6 pt-2 border-t border-bordercolor/60 flex items-center justify-between text-xs text-textmuted">
                                    <span class="font-medium"><?php echo get_the_date(); ?></span>
                                    <span class="font-semibold text-charcoal bg-offwhite px-2 py-0.5 rounded"><?php echo (int) wp_gyani_reading_time(); ?> min read</span>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- NEWSLETTER CTA BAND -->
        <section class="py-14 md:py-16 bg-[#333333]">
            <div class="max-w-[720px] mx-auto px-4 md:px-8 text-center">
                <h2 class="font-manrope font-extrabold text-2xl md:text-3xl text-[#FFFFFF] mb-3">Enjoyed this article?</h2>
                <p class="text-gray-400 text-sm md:text-base leading-relaxed mb-6"><?php echo esc_html(get_theme_mod('newsletter_description', 'Get actionable WordPress tutorials, speed tweaks and resources delivered straight to your inbox every week.')); ?></p>
                <form onsubmit="handleSubscribe(event)" class="flex flex-col sm:flex-row items-stretch gap-3 max-w-md mx-auto">
                    <input type="email" id="newsletter-email" required placeholder="you@example.com" class="flex-1 px-4 py-3 rounded-xl bg-white/10 border border-[#FFFFFF]/20 text-[#FFFFFF] placeholder-gray-500 text-sm focus:outline-none focus:border-teal">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-teal text-[#FFFFFF] font-manrope font-bold text-sm hover:bg-teal-dark transition-all whitespace-nowrap">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

    <!-- BACK TO TOP -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top" class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-[#333333] text-[#FFFFFF] shadow-modal flex items-center justify-center opacity-0 pointer-events-none translate-y-3 transition-all duration-300">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>

    <script>
    function wpGyaniCopyLink() {
        navigator.clipboard.writeText(window.location.href);
        if (typeof showToast === 'function') showToast('Link copied to clipboard!');
    }

    function wpGyaniToggleBookmark(postId) {
        var key = 'wpgyani_saved_posts';
        var saved = JSON.parse(localStorage.getItem(key) || '[]');
        var icon = document.getElementById('bookmark-icon');
        var idx = saved.indexOf(postId);
        if (idx > -1) {
            saved.splice(idx, 1);
            icon.setAttribute('fill', 'none');
            if (typeof showToast === 'function') showToast('Removed from saved articles');
        } else {
            saved.push(postId);
            icon.setAttribute('fill', 'currentColor');
            if (typeof showToast === 'function') showToast('Saved for later');
        }
        localStorage.setItem(key, JSON.stringify(saved));
    }

    document.addEventListener('DOMContentLoaded', function () {
        var postId = <?php echo (int) $post_id; ?>;

        // Restore bookmark state
        try {
            var saved = JSON.parse(localStorage.getItem('wpgyani_saved_posts') || '[]');
            if (saved.indexOf(postId) > -1) {
                document.getElementById('bookmark-icon').setAttribute('fill', 'currentColor');
            }
        } catch (e) {}

        // Reading progress bar
        var bar = document.getElementById('reading-progress');
        function updateProgress() {
            var h = document.documentElement;
            var scrolled = (h.scrollTop) / (h.scrollHeight - h.clientHeight) * 100;
            if (bar) bar.style.width = (isFinite(scrolled) ? scrolled : 0) + '%';
        }

        // Sticky mini header + back-to-top, toggled once the hero scrolls out of view
        var hero = document.getElementById('post-hero');
        var stickyHeader = document.getElementById('sticky-header');
        var backToTop = document.getElementById('back-to-top');
        function updateChrome() {
            var pastHero = hero && (window.scrollY > hero.offsetTop + hero.offsetHeight - 80);
            if (stickyHeader) {
                stickyHeader.classList.toggle('-translate-y-full', !pastHero);
                stickyHeader.classList.toggle('opacity-0', !pastHero);
            }
            if (backToTop) {
                backToTop.classList.toggle('opacity-0', !pastHero);
                backToTop.classList.toggle('pointer-events-none', !pastHero);
                backToTop.classList.toggle('translate-y-3', !pastHero);
            }
        }

        document.addEventListener('scroll', function () {
            updateProgress();
            updateChrome();
        }, { passive: true });
        updateProgress();
        updateChrome();

        // Auto-build Table of Contents from H2s, with scrollspy active-state highlighting
        var content = document.getElementById('single-content');
        var tocCard = document.getElementById('toc-card');
        var tocList = document.getElementById('toc-list');
        if (content && tocList) {
            var headings = content.querySelectorAll('h2');
            var tocLinks = [];
            if (headings.length >= 2) {
                headings.forEach(function (h, i) {
                    if (!h.id) h.id = 'section-' + (i + 1);
                    var li = document.createElement('li');
                    var a = document.createElement('a');
                    a.href = '#' + h.id;
                    a.textContent = h.textContent;
                    a.className = 'block pl-4 py-1.5 border-l-2 -ml-0.5 border-transparent hover:text-teal hover:border-teal transition-colors';
                    li.appendChild(a);
                    tocList.appendChild(li);
                    tocLinks.push({ id: h.id, el: a });
                });
                tocCard.classList.remove('hidden');

                if ('IntersectionObserver' in window) {
                    var observer = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            var match = tocLinks.find(function (t) { return t.id === entry.target.id; });
                            if (!match) return;
                            if (entry.isIntersecting) {
                                tocLinks.forEach(function (t) {
                                    t.el.classList.remove('text-teal', 'font-bold', 'border-teal');
                                    t.el.classList.add('border-transparent');
                                });
                                match.el.classList.add('text-teal', 'font-bold', 'border-teal');
                                match.el.classList.remove('border-transparent');
                            }
                        });
                    }, { rootMargin: '-100px 0px -70% 0px' });
                    headings.forEach(function (h) { observer.observe(h); });
                }
            }
        }
    });
    </script>

<?php
    // Article + BreadcrumbList JSON-LD
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            array(
                '@type'            => 'BreadcrumbList',
                'itemListElement'  => array_values(array_filter(array(
                    array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
                    $primary_cat ? array('@type' => 'ListItem', 'position' => 2, 'name' => $primary_cat->name, 'item' => get_category_link($primary_cat)) : null,
                    array('@type' => 'ListItem', 'position' => $primary_cat ? 3 : 2, 'name' => get_the_title(), 'item' => get_permalink()),
                ))),
            ),
            array(
                '@type'            => 'BlogPosting',
                'headline'         => get_the_title(),
                'description'      => wp_strip_all_tags(get_the_excerpt()),
                'datePublished'    => get_the_date('c'),
                'dateModified'     => get_the_modified_date('c'),
                'author'           => array('@type' => 'Person', 'name' => get_the_author()),
                'mainEntityOfPage' => get_permalink(),
                'image'            => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '',
            ),
        ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";

endwhile;

get_footer();