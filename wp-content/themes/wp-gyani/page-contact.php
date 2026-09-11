<?php
/**
 * Template Name: Contact Page
 *
 * A custom contact page layout featuring contact info cards on the left
 * and a Contact Form 7 integration on the right.
 */

get_header();

while (have_posts()): the_post();
?>
<main id="primary" class="site-main">

    <!-- PAGE HERO / BREADCRUMB BAND -->
    <section class="relative bg-gradient-to-br from-teal-light via-white to-teal-subtle dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 border-b border-bordercolor dark:border-gray-800 pt-8 pb-10 md:pt-10 md:pb-12 overflow-hidden">
        <!-- Subtle Background Dot Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-10 pointer-events-none" style="background-image: radial-gradient(#333333 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="mb-5">
                <ol class="flex items-center flex-wrap gap-1.5 text-xs font-medium text-textmuted dark:text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item" class="hover:text-teal transition-colors">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li class="text-bordercolor dark:text-gray-600" aria-hidden="true">/</li>
                    <li class="text-charcoal dark:text-gray-200 font-semibold" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name"><?php the_title(); ?></span>
                        <meta itemprop="item" content="<?php the_permalink(); ?>">
                        <meta itemprop="position" content="2">
                    </li>
                </ol>
            </nav>

            <span class="text-xs font-bold font-manrope uppercase tracking-widest text-teal">Contact</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-manrope font-extrabold text-charcoal dark:text-white mt-2 leading-tight max-w-4xl">
                <?php the_title(); ?>
            </h1>

            <p class="font-inter text-textmuted dark:text-gray-400 text-base md:text-lg mt-4 max-w-3xl leading-relaxed">
                Contact WP Gyani for expert WordPress support, theme customization, and SEO optimization.
            </p>
        </div>
    </section>

    <!-- CONTACT CONTENT GRID -->
    <section class="py-16 md:py-24 bg-[#FAFAFA] dark:bg-[#141A25]">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8">
            
            <!-- Main Card Wrapper -->
            <div class="bg-white dark:bg-gray-800 rounded-[40px] p-6 md:p-10 lg:p-10 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-gray-100 dark:border-gray-700 flex flex-col lg:flex-row gap-12 lg:gap-20">
                
                <!-- Left Column: Text & Info -->
                <div class="lg:w-1/2 flex flex-col justify-center">
                    
                    <!-- Top Badge -->
                    <div class="inline-flex items-center gap-3 border border-teal text-teal pr-4 pl-1.5 py-1.5 rounded-full mb-8 self-start">
                        <div class="w-7 h-7 bg-teal rounded-full flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <span class="text-[13px] font-bold tracking-wide uppercase">Get In Touch</span>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl lg:text-[56px] font-manrope font-extrabold text-[#111] dark:text-white mb-6 leading-[1.1] tracking-tight">
                        Send Us a Message
                    </h2>
                    
                    <p class="text-lg text-[#666] dark:text-gray-400 mb-12 max-w-lg leading-relaxed">
                        Contact WP Gyani for expert WordPress support, theme customization, and SEO optimization. We are here to help you grow your website.
                    </p>

                    <!-- Contact Info Grid -->
                    <div class="flex flex-col gap-5">
                        <!-- Phone -->
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#1a202c] dark:bg-gray-900 rounded-full flex items-center justify-center text-white shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <a href="tel:+919825050121" class="block text-[15px] font-bold text-[#111] dark:text-white hover:text-teal transition-colors">+91 98250 50121</a>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#1a202c] dark:bg-gray-900 rounded-full flex items-center justify-center text-white shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <a href="mailto:wpgyani2023@gmail.com" class="block text-[15px] font-bold text-[#111] dark:text-white hover:text-teal transition-colors">wpgyani2023@gmail.com</a>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#1a202c] dark:bg-gray-900 rounded-full flex items-center justify-center text-white shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <a href="https://maps.google.com/?q=1201,+Ganesh+Glory,+SBI+Bank+Building,+Ahmedabad" target="_blank" rel="noopener noreferrer" class="block text-[15px] font-bold text-[#111] dark:text-white hover:text-teal transition-colors">1201, Ganesh Glory, SBI Bank Building, Ahmedabad</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Solid Teal Form Box -->
                <div class="lg:w-1/2">
                    <div class="bg-teal dark:bg-teal-900 rounded-[32px] p-8 md:p-10 lg:p-12 h-full shadow-lg">
                        <!-- Theme Colored Form Wrapper -->
                        <div class="theme-colored-form-wrapper w-full h-full">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<?php
endwhile;
get_footer();
