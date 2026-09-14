<?php
/**
 * Template Name: About Us
 */
get_header();

// Fetch meta values with defaults
$post_id = get_the_ID();

// Hero
$hero_subtitle = get_post_meta($post_id, 'about_hero_subtitle', true) ?: 'About Us';
$hero_title = get_post_meta($post_id, 'about_hero_title', true) ?: 'Your go-to platform to <br class="hidden md:block" /> <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal to-teal-dark">learn WordPress</span>';
$hero_desc = get_post_meta($post_id, 'about_hero_desc', true) ?: 'WP Gyani is your go-to platform to learn WordPress in a simple and practical way. We help beginners, bloggers, and business owners build, manage, and grow their websites without confusion.';

// Story
$story_heading = get_post_meta($post_id, 'about_story_heading', true) ?: 'Built to simplify <br/> WordPress for everyone.';
$story_p1 = get_post_meta($post_id, 'about_story_p1', true) ?: 'WordPress is powerful, but often confusing for beginners. Many users struggle with complicated guides, technical jargon, and outdated tutorials.';
$story_p2 = get_post_meta($post_id, 'about_story_p2', true) ?: 'We started WP Gyani to provide clear, easy-to-follow, and beginner-friendly content that actually helps users build real websites. Today, we help thousands learn WordPress, improve performance, and grow with confidence.';
$story_img = get_post_meta($post_id, 'about_story_img', true) ?: 'https://wpgyani.com/wp-content/uploads/2026/04/Our-Story.webp';

// Company
$company_heading = get_post_meta($post_id, 'about_company_heading', true) ?: 'About Our Company';
$company_desc = get_post_meta($post_id, 'about_company_desc', true) ?: 'WP Gyani is focused on delivering practical and result-driven WordPress knowledge. We cover everything you need to succeed online:';
$company_list = get_post_meta($post_id, 'about_company_list', true) ?: 'WordPress website setup, Theme & plugin guides, SEO tips, Website speed optimization, Security & maintenance';
$company_items = array_map('trim', explode(',', $company_list));

// Values
$v1_title = get_post_meta($post_id, 'about_value_1_title', true) ?: 'Authenticity';
$v1_desc = get_post_meta($post_id, 'about_value_1_desc', true) ?: 'We believe in sharing honest and tested knowledge. Every guide on WP Gyani is based on real experience to ensure it delivers accurate and useful results.';
$v2_title = get_post_meta($post_id, 'about_value_2_title', true) ?: 'Real Engagement';
$v2_desc = get_post_meta($post_id, 'about_value_2_desc', true) ?: 'We create content that solves real problems. Our tutorials are designed so you can apply them directly and see improvements on your website.';
$v3_title = get_post_meta($post_id, 'about_value_3_title', true) ?: 'Unique Stories';
$v3_desc = get_post_meta($post_id, 'about_value_3_desc', true) ?: 'We focus on creating unique and valuable content instead of repeating generic information. Each guide is written to help you learn faster and achieve better results.';

// Achievements
$achieve_heading = get_post_meta($post_id, 'about_achieve_heading', true) ?: 'Our Achievements';
$achieve_desc = get_post_meta($post_id, 'about_achieve_desc', true) ?: 'We are committed to helping users learn WordPress, build better websites, and grow online with confidence through practical and easy-to-follow content.';
// Achievements Repeater
$achievements = get_post_meta($post_id, 'about_achievements', true);
if (empty($achievements) || !is_array($achievements)) {
    // Fallback data
    $achievements = [
        [
            'title' => 'Beginner-Friendly Learning',
            'desc'  => 'We have helped thousands of beginners understand WordPress with simple, step-by-step tutorials designed for easy learning and quick implementation.',
            'img'   => 'https://wpgyani.com/wp-content/uploads/2026/04/Beginner-Friendly-Learning.webp'
        ],
        [
            'title' => 'Practical WordPress Solutions',
            'desc'  => 'Our guides focus on real-world solutions, helping users solve website issues, improve performance, and build professional websites efficiently.',
            'img'   => get_template_directory_uri() . '/images/practical-solutions.png'
        ],
        [
            'title' => 'Consistent Growth & Value',
            'desc'  => 'We continuously create and update high-quality content to keep users informed with the latest WordPress trends, tools, and best practices.',
            'img'   => get_template_directory_uri() . '/images/consistent-growth.png'
        ]
    ];
}

// Stats
$s1_num = get_post_meta($post_id, 'about_stat_1_num', true) ?: '400K+';
$s1_label = get_post_meta($post_id, 'about_stat_1_label', true) ?: 'Monthly Page Views';
$s2_num = get_post_meta($post_id, 'about_stat_2_num', true) ?: '320+';
$s2_label = get_post_meta($post_id, 'about_stat_2_label', true) ?: 'WordPress Tutorials';
$s3_num = get_post_meta($post_id, 'about_stat_3_num', true) ?: '250+';
$s3_label = get_post_meta($post_id, 'about_stat_3_label', true) ?: 'Guides & Resources';
?>

<main id="primary" class="site-main bg-white dark:bg-[#0B1120] transition-colors duration-300">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-teal-light to-white dark:from-gray-900 dark:to-[#0B1120] pt-20 pb-16 md:pt-28 md:pb-24 border-b border-bordercolor dark:border-gray-800 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal/10 dark:bg-teal-900/30 text-teal text-[11px] font-bold font-manrope uppercase tracking-widest mb-6">
                <?php echo esc_html($hero_subtitle); ?>
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-manrope font-extrabold text-charcoal dark:text-white tracking-tight mb-6">
                <?php echo wp_kses_post($hero_title); ?>
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-textmuted dark:text-gray-400 font-inter leading-relaxed">
                <?php echo esc_html($hero_desc); ?>
            </p>
        </div>
    </section>

    <!-- Our Story & Company Section -->
    <section class="py-16 md:py-24 bg-white dark:bg-[#0B1120]">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <!-- Story Part -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
                <!-- Text on Left (Spans 5 cols) -->
                <div class="lg:col-span-5 order-2 lg:order-1">
                    <span class="text-teal font-manrope font-bold tracking-widest uppercase text-sm mb-4 block">Our Story</span>
                    <h2 class="text-3xl md:text-5xl font-manrope font-extrabold text-charcoal dark:text-white mb-6 leading-tight">
                        <?php echo wp_kses_post($story_heading); ?>
                    </h2>
                    <p class="font-inter text-textmuted dark:text-gray-400 text-lg leading-relaxed mb-6">
                        <?php echo esc_html($story_p1); ?>
                    </p>
                    <p class="font-inter text-textmuted dark:text-gray-400 text-lg leading-relaxed mb-8">
                        <?php echo esc_html($story_p2); ?>
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <!-- Fake user avatars for social proof -->
                            <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0B1120]" src="https://i.pravatar.cc/100?img=1" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0B1120]" src="https://i.pravatar.cc/100?img=2" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white dark:border-[#0B1120]" src="https://i.pravatar.cc/100?img=3" alt="">
                        </div>
                        <div class="text-sm font-inter text-textmuted dark:text-gray-400">
                            Trusted by <span class="font-bold text-charcoal dark:text-white">400K+</span> monthly readers
                        </div>
                    </div>
                </div>
                
                <!-- Image on Right (Spans 7 cols) -->
                <div class="lg:col-span-7 order-1 lg:order-2 relative">
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-teal/20 dark:bg-teal/10 rounded-full filter blur-3xl"></div>
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl group">
                        <div class="absolute inset-0 bg-teal/10 mix-blend-overlay group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <img src="<?php echo esc_url($story_img); ?>" alt="Our Story" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700" />
                    </div>
                </div>
            </div>

            <!-- Company List Part (Grid) -->
            <div class="bg-offwhite dark:bg-gray-900 rounded-3xl p-8 md:p-12 border border-bordercolor dark:border-gray-800">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <h2 class="text-2xl md:text-3xl font-manrope font-extrabold text-charcoal dark:text-white mb-4"><?php echo esc_html($company_heading); ?></h2>
                    <p class="font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                        <?php echo esc_html($company_desc); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($company_items as $item) : ?>
                    <div class="flex items-center gap-4 bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-bordercolor dark:border-gray-700">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-teal/10 flex items-center justify-center text-teal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="font-inter font-semibold text-charcoal dark:text-gray-200"><?php echo esc_html($item); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section (Redesigned) -->
    <section class="py-20 md:py-32 bg-gray-50 dark:bg-[#141A25] border-y border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-teal font-manrope font-bold tracking-widest uppercase text-sm mb-4 block">Why Choose Us</span>
                <h2 class="text-3xl md:text-5xl font-manrope font-extrabold text-charcoal dark:text-white mb-6">Our Core Values</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Value 1 -->
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-800 relative group overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-light to-teal opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal/5 rounded-full group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-teal/10 flex items-center justify-center mb-8 text-teal group-hover:bg-teal group-hover:text-white transition-colors duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-2xl font-manrope font-bold text-charcoal dark:text-white mb-4"><?php echo esc_html($v1_title); ?></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                            <?php echo esc_html($v1_desc); ?>
                        </p>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-800 relative group overflow-hidden flex flex-col justify-between md:-translate-y-6">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-light to-teal opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal/5 rounded-full group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-teal/10 flex items-center justify-center mb-8 text-teal group-hover:bg-teal group-hover:text-white transition-colors duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/></svg>
                        </div>
                        <h3 class="text-2xl font-manrope font-bold text-charcoal dark:text-white mb-4"><?php echo esc_html($v2_title); ?></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                            <?php echo esc_html($v2_desc); ?>
                        </p>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-8 md:p-10 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-800 relative group overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-light to-teal opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal/5 rounded-full group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-teal/10 flex items-center justify-center mb-8 text-teal group-hover:bg-teal group-hover:text-white transition-colors duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h3 class="text-2xl font-manrope font-bold text-charcoal dark:text-white mb-4"><?php echo esc_html($v3_title); ?></h3>
                        <p class="font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                            <?php echo esc_html($v3_desc); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Our Achievements Section -->
    <section class="py-16 md:py-24 bg-white dark:bg-[#0B1120]">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-manrope font-extrabold text-charcoal dark:text-white mb-4"><?php echo esc_html($achieve_heading); ?></h2>
                <p class="font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                    <?php echo esc_html($achieve_desc); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($achievements as $achieve) : ?>
                <!-- Card -->
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-3 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 group relative flex flex-col h-full">
                    <div class="relative h-60 md:h-64 rounded-3xl overflow-hidden mb-6 w-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/40 to-transparent mix-blend-overlay opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                        <img src="<?php echo esc_url($achieve['img']); ?>" alt="<?php echo esc_attr($achieve['title']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    </div>
                    <div class="px-4 pb-6 md:px-6 md:pb-8 text-center flex-grow flex flex-col justify-start">
                        <h4 class="text-lg md:text-xl font-manrope font-extrabold text-charcoal dark:text-white mb-3 group-hover:text-teal transition-colors duration-300"><?php echo esc_html($achieve['title']); ?></h4>
                        <p class="text-sm font-inter text-textmuted dark:text-gray-400 leading-relaxed">
                            <?php echo esc_html($achieve['desc']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Stats Section (Minimalist) -->
    <section class="py-8 md:py-12 bg-gray-50 dark:bg-[#080d14] border-y border-bordercolor dark:border-gray-800">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-gray-800 text-center">
                
                <!-- Stat 1 -->
                <div class="pt-8 md:pt-0 pb-8 md:pb-0 group cursor-default">
                    <div class="text-4xl md:text-5xl font-manrope font-extrabold mb-2 text-charcoal dark:text-white group-hover:text-teal transition-colors duration-300">
                        <?php echo esc_html($s1_num); ?>
                    </div>
                    <div class="text-sm md:text-base font-inter uppercase tracking-[0.2em] font-bold text-textmuted dark:text-gray-400">
                        <?php echo esc_html($s1_label); ?>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="pt-8 md:pt-0 pb-8 md:pb-0 group cursor-default">
                    <div class="text-4xl md:text-5xl font-manrope font-extrabold mb-2 text-charcoal dark:text-white group-hover:text-teal transition-colors duration-300">
                        <?php echo esc_html($s2_num); ?>
                    </div>
                    <div class="text-sm md:text-base font-inter uppercase tracking-[0.2em] font-bold text-textmuted dark:text-gray-400">
                        <?php echo esc_html($s2_label); ?>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="pt-8 md:pt-0 group cursor-default">
                    <div class="text-4xl md:text-5xl font-manrope font-extrabold mb-2 text-charcoal dark:text-white group-hover:text-teal transition-colors duration-300">
                        <?php echo esc_html($s3_num); ?>
                    </div>
                    <div class="text-sm md:text-base font-inter uppercase tracking-[0.2em] font-bold text-textmuted dark:text-gray-400">
                        <?php echo esc_html($s3_label); ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
