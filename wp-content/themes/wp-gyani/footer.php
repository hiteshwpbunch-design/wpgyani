<?php
/**
 * Template part for displaying the footer
 */
?>

    <!-- SECTION 11: FOOTER -->
    <footer id="footer" class="bg-[#0a0a0a] text-[#FFFFFF] pt-20 pb-8 overflow-hidden relative">
        <!-- Massive Typography Section -->
        <!-- <div class="max-w-[1400px] mx-auto px-4 md:px-8 mb-16 relative z-10">
            <h2 class="font-manrope font-extrabold text-[12vw] leading-[0.85] tracking-tighter text-transparent bg-clip-text bg-gradient-to-br from-white to-gray-500 uppercase">
                Build<br>Better<br><span class="text-teal">Websites.</span>
            </h2>
        </div> -->

        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-16 border-b border-gray-800 relative z-10">
                <!-- Col 1: Brand Info (Left Side - 5 cols) -->
                <div class="md:col-span-5 space-y-8 flex flex-col justify-between">
                    <div>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block group">
                            <?php if (has_custom_logo()): ?>
                                <img src="<?php echo esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')); ?>" alt="WP Gyani Logo" class="h-12 w-auto object-contain brightness-0 invert group-hover:opacity-80 transition-opacity duration-300">
                            <?php else: ?>
                                <span class="font-manrope font-extrabold text-3xl text-teal tracking-tight">WP Gyani</span>
                            <?php endif; ?>
                        </a>
                        <p class="font-inter text-gray-400 text-base max-w-md leading-relaxed mt-6">
                            An editorial WordPress knowledge platform delivering practical tutorials, guides, and resources. Elevate your digital presence.
                        </p>
                    </div>
                    
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 rounded-full border border-gray-700 flex items-center justify-center text-[#FFFFFF] hover:border-teal hover:text-teal hover:bg-teal/10 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-gray-700 flex items-center justify-center text-[#FFFFFF] hover:border-teal hover:text-teal hover:bg-teal/10 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full border border-gray-700 flex items-center justify-center text-[#FFFFFF] hover:border-teal hover:text-teal hover:bg-teal/10 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation Columns (Right Side - 7 cols) -->
                <div class="md:col-span-7 grid grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="space-y-6">
                        <h4 class="font-manrope font-extrabold text-lg text-white">WordPress</h4>
                        <ul class="space-y-3 font-inter text-base">
                            <li><a href="#latest" class="text-gray-400 hover:text-teal transition-colors">Tutorials</a></li>
                            <li><a href="#guides" class="text-gray-400 hover:text-teal transition-colors">Pillar Guides</a></li>
                            <li><a href="#latest" class="text-gray-400 hover:text-teal transition-colors">WordPress Tips</a></li>
                            <li><a href="#latest" class="text-gray-400 hover:text-teal transition-colors">Bug Fixes</a></li>
                        </ul>
                    </div>

                    <div class="space-y-6">
                        <h4 class="font-manrope font-extrabold text-lg text-white">Resources</h4>
                        <ul class="space-y-3 font-inter text-base">
                            <li><a href="#categories" class="text-gray-400 hover:text-teal transition-colors">Plugins & Themes</a></li>
                            <li><a href="#resources" class="text-gray-400 hover:text-teal transition-colors">Speed Tools</a></li>
                            <li><a href="#latest" class="text-gray-400 hover:text-teal transition-colors">SEO Checklists</a></li>
                            <li><a href="#resources" class="text-gray-400 hover:text-teal transition-colors">Code Snippets</a></li>
                        </ul>
                    </div>

                    <div class="space-y-6 col-span-2 lg:col-span-1">
                        <h4 class="font-manrope font-extrabold text-lg text-white">Company</h4>
                        <ul class="space-y-3 font-inter text-base">
                            <li><a href="#about" class="text-gray-400 hover:text-teal transition-colors">About Us</a></li>
                            <li><a href="#footer" class="text-gray-400 hover:text-teal transition-colors">Contact</a></li>
                            <li><a href="#newsletter" class="text-gray-400 hover:text-teal transition-colors">Advertise</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-teal transition-colors">Partners</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-sm text-gray-600 gap-4 relative z-10">
                <div class="font-medium">&copy; <?php echo date('Y'); ?> WP Gyani. Crafted with precision.</div>
                <div class="flex items-center space-x-8 font-medium">
                    <a href="#" class="hover:text-[#FFFFFF] transition-colors duration-300">Terms</a>
                    <a href="#" class="hover:text-[#FFFFFF] transition-colors duration-300">Privacy</a>
                    <a href="#" class="hover:text-[#FFFFFF] transition-colors duration-300">Cookies</a>
                </div>
            </div>
        </div>
        
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-teal opacity-5 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-teal opacity-5 rounded-full blur-[150px] translate-y-1/2 -translate-x-1/3 pointer-events-none"></div>
    </footer>

    <!-- SEARCH MODAL OVERLAY -->
    <div id="search-modal" class="fixed inset-0 z-50 bg-charcoal/60 dark:bg-black/80 backdrop-blur-sm hidden flex items-start justify-center pt-20 px-4">
        <div class="bg-white dark:bg-gray-900 w-full max-w-2xl rounded-2xl shadow-modal border border-bordercolor dark:border-gray-700 overflow-hidden transform transition-all">
            <!-- Search Input Header -->
            <div class="p-4 border-b border-bordercolor dark:border-gray-700 flex items-center gap-3 bg-offwhite dark:bg-gray-800">
                <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="search-input" oninput="handleSearch(this.value)" placeholder="What do you want to learn today? (e.g. Speed, Elementor, SEO)" class="w-full bg-transparent text-charcoal dark:text-white font-manrope font-bold text-base focus:outline-none">
                <button onclick="closeSearchModal()" class="text-xs font-bold text-textmuted dark:text-gray-300 hover:text-charcoal dark:hover:text-white px-2 py-1 bg-white dark:bg-gray-700 border border-bordercolor dark:border-gray-600 rounded">ESC</button>
            </div>
            <!-- Modal Content & Results -->
            <div class="p-6 max-h-[60vh] overflow-y-auto custom-scrollbar">
                <!-- Recent Searches / Quick Chips -->
                <div id="search-suggestions" class="space-y-4">
                    <div class="text-xs font-bold text-textmuted dark:text-gray-400 uppercase tracking-wider">Popular Searches</div>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="applySearchTag('Speed')" class="px-3 py-1.5 rounded-lg bg-teal-light dark:bg-teal-900/30 text-teal-dark dark:text-teal font-medium text-xs hover:bg-teal hover:text-[#FFFFFF] transition-colors">WordPress Speed</button>
                        <button onclick="applySearchTag('Elementor')" class="px-3 py-1.5 rounded-lg bg-teal-light dark:bg-teal-900/30 text-teal-dark dark:text-teal font-medium text-xs hover:bg-teal hover:text-[#FFFFFF] transition-colors">Elementor Pro</button>
                        <button onclick="applySearchTag('SEO')" class="px-3 py-1.5 rounded-lg bg-teal-light dark:bg-teal-900/30 text-teal-dark dark:text-teal font-medium text-xs hover:bg-teal hover:text-[#FFFFFF] transition-colors">Technical SEO</button>
                        <button onclick="applySearchTag('Database')" class="px-3 py-1.5 rounded-lg bg-teal-light dark:bg-teal-900/30 text-teal-dark dark:text-teal font-medium text-xs hover:bg-teal hover:text-[#FFFFFF] transition-colors">Database Error</button>
                    </div>
                </div>
                <!-- Dynamic Results Area -->
                <div id="search-results" class="mt-4 space-y-3 hidden"></div>
            </div>
        </div>
    </div>

    <!-- ARTICLE READER VIEW MODAL -->
    <div id="article-modal" class="fixed inset-0 z-50 bg-charcoal/70 dark:bg-black/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-900 w-full max-w-3xl rounded-2xl shadow-modal border border-bordercolor dark:border-gray-700 max-h-[90vh] flex flex-col overflow-hidden">
            <div class="p-4 border-b border-bordercolor dark:border-gray-700 flex items-center justify-between bg-offwhite dark:bg-gray-800">
                <div class="flex items-center gap-2 text-xs font-bold text-teal" id="modal-category">WORDPRESS PERFORMANCE</div>
                <button onclick="closeArticleModal()" class="text-charcoal dark:text-white hover:text-teal font-bold text-sm p-1">&times; Close</button>
            </div>
            <div class="p-6 md:p-8 overflow-y-auto custom-scrollbar space-y-6">
                <h2 id="modal-title" class="font-manrope font-extrabold text-2xl md:text-3xl text-charcoal dark:text-white">Article Title Placeholder</h2>
                <div class="flex items-center gap-4 text-xs text-textmuted dark:text-gray-400 pb-4 border-b border-bordercolor dark:border-gray-700">
                    <span>By Rahul Sharma</span>
                    <span>&bull;</span>
                    <span>Updated Aug 2026</span>
                    <span>&bull;</span>
                    <span class="text-teal font-semibold">12 min read</span>
                </div>
                <!-- Article Body Content Demo -->
                <div class="space-y-4 text-charcoal dark:text-gray-300 font-inter text-base leading-relaxed">
                    <p>Building a fast, modern WordPress site requires a deep understanding of core web vitals, server caching strategies, and asset optimization.</p>
                    <div class="p-4 rounded-xl bg-teal-light dark:bg-teal-900/30 border-l-4 border-teal text-sm text-teal-dark dark:text-teal font-medium"><strong>Pro Tip:</strong> Always defer non-critical JavaScript files and load critical CSS inline to achieve a green LCP (Largest Contentful Paint) score.</div>
                    <p>In this guide, we break down step-by-step how to audit database queries, eliminate heavy plugins, and leverage modern web standards.</p>
                </div>
            </div>
            <div class="p-4 border-t border-bordercolor dark:border-gray-700 bg-offwhite dark:bg-gray-800 flex justify-between items-center">
                <button onclick="closeArticleModal()" class="text-charcoal dark:text-white hover:text-teal font-bold text-sm">Close</button>
                <a href="#" id="modal-link" class="px-5 py-2.5 rounded-xl bg-teal text-[#FFFFFF] font-manrope font-bold text-sm hover:bg-teal-dark">Read Full Article</a>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="fixed bottom-5 right-5 z-50 bg-charcoal text-[#FFFFFF] px-5 py-3 rounded-xl shadow-modal text-sm font-medium transition-all duration-300 transform translate-y-20 opacity-0 flex items-center gap-2">
        <svg class="w-5 h-5 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span id="toast-message">Action successful!</span>
    </div>

    <!-- JavaScript is enqueued via functions.php in assets/js/main.js -->
    <?php wp_footer(); ?>
</body>
</html>
