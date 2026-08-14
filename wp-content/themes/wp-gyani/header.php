<?php
/**
 * Template part for displaying the header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-charcoal font-inter antialiased selection:bg-teal-light selection:text-teal-dark'); ?>>

    <!-- SECTION 1: TOP UTILITY BAR -->
    <div id="top-bar" class="bg-teal-light border-b border-bordercolor text-xs h-9 py-1">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 h-full flex justify-between items-center text-charcoal">
            <!-- Left links -->
            <div class="flex items-center space-x-6 font-medium text-charcoal">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="hover:text-teal-dark transition-colors">About Us</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('partners'))); ?>" class="hover:text-teal-dark transition-colors">Partners</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('press'))); ?>" class="hover:text-teal-dark transition-colors">Press</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="hover:text-teal-dark transition-colors">Contact & Support</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('advertise'))); ?>" class="hover:text-teal-dark transition-colors hidden sm:inline-block">Advertise</a>
            </div>
            <!-- Right Socials & Quick Search shortcut -->
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-3 text-charcoal opacity-80">
                    <a href="#" class="hover:text-teal transition-colors" title="X / Twitter">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" class="hover:text-teal transition-colors" title="YouTube">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="#" class="hover:text-teal transition-colors" title="GitHub">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                    </a>
                </div>
                
                <!-- Theme Toggle Switch -->
                <div id="theme-toggle" class="bg-gray-200/60 dark:bg-gray-700/50 rounded-full p-1 flex items-center gap-1 cursor-pointer border border-transparent hover:border-gray-300 dark:hover:border-gray-600 transition-colors" title="Toggle Theme">
                    <!-- Dark Mode Icon -->
                    <div class="p-1 rounded-full text-gray-400 hover:text-gray-600 dark:text-teal dark:bg-gray-800 dark:shadow-sm transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </div>
                    <!-- Light Mode Icon -->
                    <div class="p-1 rounded-full text-teal bg-white shadow-sm dark:bg-transparent dark:text-gray-400 dark:shadow-none hover:text-gray-800 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                </div>
                <script>
                    document.getElementById('theme-toggle').addEventListener('click', function() {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- SECTION 1B: MAIN HEADER -->
    <header class="sticky top-0 z-40 bg-white border-b border-bordercolor shadow-sm transition-all duration-200" id="main-header">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 h-[74px] flex items-center justify-between">
            <!-- WP Gyani Logo -->
            <div class="flex items-center gap-3 group">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="font-manrope font-extrabold text-2xl text-teal">WP Gyani</a>
                <?php endif; ?>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1 font-inter text-sm font-medium text-charcoal main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'flex items-center gap-6',
                    'container' => false,
                    'depth' => 2,
                    'fallback_cb' => 'wp_gyani_fallback_menu',
                ));
                ?>
            </nav>

            <!-- Right Header CTA Buttons -->
            <div class="flex items-center space-x-3">
                <button onclick="openSearchModal()" class="p-2.5 rounded-xl border border-bordercolor text-charcoal hover:text-teal hover:border-teal hover:bg-teal-light/30 transition-all" title="Search Knowledge Base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <a href="#guides" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-teal text-white font-manrope font-bold text-sm shadow-sm hover:bg-teal-dark transform hover:-translate-y-0.5 transition-all">
                    <span>Start Learning</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="lg:hidden p-2.5 rounded-xl border border-bordercolor text-charcoal hover:bg-offwhite">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Slide-out Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-bordercolor px-6 py-6 space-y-4 shadow-xl">
            <div class="font-manrope font-bold text-xs uppercase tracking-wider text-teal">Navigation</div>
            <div class="grid grid-cols-1 gap-2 font-medium text-charcoal">
                <a href="#latest" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">WordPress Tutorials</a>
                <a href="#categories" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">Elementor Hub</a>
                <a href="#categories" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">Plugins & Themes</a>
                <a href="#latest" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">SEO & Speed</a>
                <a href="#guides" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">WP Gyani Pillar Guides</a>
                <a href="#resources" onclick="toggleMobileMenu()" class="py-2 px-3 rounded-lg hover:bg-teal-light">Useful Resources</a>
            </div>
            <div class="pt-2">
                <a href="#guides" onclick="toggleMobileMenu()" class="w-full text-center block py-3 rounded-xl bg-teal text-white font-manrope font-bold">Start Learning Now</a>
            </div>
        </div>
    </header>
