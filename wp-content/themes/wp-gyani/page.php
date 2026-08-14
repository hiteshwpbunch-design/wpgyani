<?php
/**
 * The page template
 *
 * Modernized to match the WP Gyani design system: a breadcrumb + hero
 * band, an optional full-width featured image, a two-column reading
 * layout (prose + sticky sidebar with an auto-generated table of
 * contents for longer pages), and a closing contact CTA. Falls back
 * gracefully — the sidebar TOC simply doesn't render on short pages.
 *
 * @package WP_Gyani
 */

get_header();

while (have_posts()): the_post();
?>

    <main id="primary" class="site-main">

        <!-- PAGE HERO / BREADCRUMB BAND -->
        <section class="bg-offwhite border-b border-bordercolor pt-8 pb-10 md:pt-10 md:pb-12">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">

                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb" class="mb-5">
                    <ol class="flex items-center flex-wrap gap-1.5 text-xs font-medium text-textmuted" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="hover:text-teal transition-colors">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="text-bordercolor" aria-hidden="true">/</li>
                        <li class="text-charcoal font-semibold" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <span itemprop="name"><?php the_title(); ?></span>
                            <meta itemprop="item" content="<?php the_permalink(); ?>">
                            <meta itemprop="position" content="2">
                        </li>
                    </ol>
                </nav>

                <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">Page</span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-manrope font-extrabold text-charcoal mt-2 leading-tight max-w-4xl">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="font-inter text-textmuted text-base md:text-lg mt-4 max-w-3xl leading-relaxed"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <div class="text-xs text-textmuted mt-5">Last updated <?php echo get_the_modified_date(); ?></div>
            </div>
        </section>

        <!-- FEATURED IMAGE -->
        <?php if (has_post_thumbnail()): ?>
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="relative aspect-[16/6] rounded-2xl overflow-hidden bg-teal-light border border-bordercolor mt-8">
                    <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover', 'alt' => get_the_title())); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- CONTENT + SIDEBAR -->
        <section class="py-12 md:py-16">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                    <!-- MAIN CONTENT COLUMN -->
                    <div class="lg:col-span-8">
                        <article <?php post_class('bg-white'); ?>>
                            <div class="prose max-w-none font-inter text-base md:text-[17px] leading-relaxed text-charcoal
                                        prose-headings:font-manrope prose-headings:font-extrabold prose-headings:text-charcoal
                                        prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                                        prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                                        prose-a:text-teal prose-a:font-semibold hover:prose-a:text-teal-dark
                                        prose-strong:text-charcoal
                                        prose-ul:my-4 prose-li:my-1
                                        prose-img:rounded-xl prose-img:border prose-img:border-bordercolor
                                        prose-blockquote:border-l-teal prose-blockquote:bg-teal-light/50 prose-blockquote:not-italic prose-blockquote:py-1 prose-blockquote:rounded-r-lg
                                        prose-code:text-teal-dark prose-code:bg-teal-light prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm prose-code:before:content-none prose-code:after:content-none
                                        prose-table:overflow-hidden prose-th:bg-offwhite"
                                 id="page-content">
                                <?php the_content(); ?>
                            </div>
                        </article>

                        <?php
                        // Allow child pages to list themselves (common for pillar/hub pages).
                        $children = get_pages(array('parent' => get_the_ID(), 'sort_column' => 'menu_order'));
                        if ($children):
                        ?>
                            <div class="mt-10 pt-8 border-t border-bordercolor">
                                <h2 class="font-manrope font-extrabold text-lg text-charcoal mb-4">On This Page</h2>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php foreach ($children as $child): ?>
                                        <a href="<?php echo esc_url(get_permalink($child)); ?>" class="group p-4 rounded-xl border border-bordercolor bg-white hover:border-teal hover:shadow-card-hover transition-all flex items-center justify-between">
                                            <span class="font-manrope font-bold text-sm text-charcoal group-hover:text-teal transition-colors"><?php echo esc_html(get_the_title($child)); ?></span>
                                            <svg class="w-4 h-4 text-textmuted group-hover:text-teal group-hover:translate-x-0.5 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- SIDEBAR -->
                    <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                        <!-- TABLE OF CONTENTS (auto-built from H2s in the content via JS; hidden if too few) -->
                        <div id="page-toc-card" class="p-6 rounded-2xl bg-white border border-bordercolor shadow-soft hidden">
                            <h3 class="font-manrope font-extrabold text-sm uppercase tracking-wider text-charcoal mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                On This Page
                            </h3>
                            <ul id="page-toc-list" class="space-y-2.5 text-sm font-medium text-textmuted"></ul>
                        </div>

                        <!-- CONTACT / HELP CTA -->
                        <div class="p-6 rounded-2xl bg-[#333333] text-[#FFFFFF]">
                            <h3 class="font-manrope font-extrabold text-base mb-2">Still Have Questions?</h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-4">Our team is happy to help with anything WordPress-related — speed, Elementor, SEO or troubleshooting.</p>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="block text-center py-2.5 rounded-xl bg-teal text-[#FFFFFF] font-manrope font-bold text-sm hover:bg-teal-dark transition-all">Contact Us</a>
                        </div>

                        <!-- NEWSLETTER CTA -->
                        <div class="p-6 rounded-2xl bg-offwhite border border-bordercolor">
                            <h3 class="font-manrope font-extrabold text-base text-charcoal mb-2">Weekly WordPress Tips</h3>
                            <p class="text-textmuted text-sm leading-relaxed mb-4"><?php echo esc_html(get_theme_mod('newsletter_description', 'Actionable tutorials, speed tweaks and resources delivered straight to your inbox.')); ?></p>
                            <form onsubmit="handleSubscribe(event)" class="space-y-2">
                                <input type="email" id="newsletter-email" required placeholder="you@example.com" class="w-full px-4 py-2.5 rounded-xl bg-white border border-bordercolor text-charcoal placeholder-textmuted text-sm focus:outline-none focus:border-teal">
                                <button type="submit" class="w-full py-2.5 rounded-xl bg-teal text-white font-manrope font-bold text-sm hover:bg-teal-dark transition-all">Subscribe</button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var content = document.getElementById('page-content');
        var tocCard = document.getElementById('page-toc-card');
        var tocList = document.getElementById('page-toc-list');
        if (content && tocList) {
            var headings = content.querySelectorAll('h2');
            if (headings.length >= 2) {
                headings.forEach(function (h, i) {
                    if (!h.id) h.id = 'section-' + (i + 1);
                    var li = document.createElement('li');
                    var a = document.createElement('a');
                    a.href = '#' + h.id;
                    a.textContent = h.textContent;
                    a.className = 'block hover:text-teal transition-colors';
                    li.appendChild(a);
                    tocList.appendChild(li);
                });
                tocCard.classList.remove('hidden');
            }
        }
    });
    </script>

<?php
endwhile;

get_footer();
