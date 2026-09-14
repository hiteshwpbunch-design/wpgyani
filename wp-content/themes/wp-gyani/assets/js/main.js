/* WP Gyani Theme JavaScript */

// Article Filtering Logic
function filterArticles(category) {
    const cards = document.querySelectorAll('.article-card');
    const btns = ['btn-all', 'btn-speed', 'btn-elementor', 'btn-troubleshooting'];
    btns.forEach(id => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.className = "px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all text-textmuted dark:text-gray-400 hover:text-charcoal dark:hover:text-white hover:bg-teal-light dark:hover:bg-gray-700";
        }
    });
    const activeBtn = document.getElementById('btn-' + category);
    if (activeBtn) {
        activeBtn.className = "px-4 py-2 rounded-lg text-xs font-manrope font-bold transition-all bg-teal text-white shadow-sm";
    }
    cards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Mobile Menu Toggle
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}

// Search Modal Functions
function openSearchModal() {
    document.getElementById('search-modal').classList.remove('hidden');
    document.getElementById('search-input').focus();
}

function closeSearchModal() {
    document.getElementById('search-modal').classList.add('hidden');
}

function applySearchTag(tag) {
    const input = document.getElementById('search-input');
    input.value = tag;
    handleSearch(tag);
}

function handleSearch(query) {
    const suggestions = document.getElementById('search-suggestions');
    const results = document.getElementById('search-results');
    
    if (!query.trim()) {
        suggestions.classList.remove('hidden');
        results.classList.add('hidden');
        return;
    }
    
    suggestions.classList.add('hidden');
    results.classList.remove('hidden');
    results.innerHTML = '<div class="text-center text-textmuted text-sm py-4">Searching...</div>';

    // AJAX request to WordPress
    const formData = new URLSearchParams();
    formData.append('action', 'wpgyani_search');
    formData.append('query', query);

    fetch(wpgyani_ajax.ajax_url, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(res => {
        if (res.success && res.data && res.data.length > 0) {
            results.innerHTML = res.data.map(item => 
                `<div onclick="openArticleModal('${item.title.replace(/'/g, "\\'")}', '${item.cat}', '${item.url}')" class="p-3 bg-offwhite dark:bg-gray-800 hover:bg-teal-light dark:hover:bg-gray-700 rounded-xl cursor-pointer transition-colors border border-bordercolor dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-teal uppercase">${item.cat}</span>
                        <div class="font-manrope font-bold text-sm text-charcoal dark:text-white">${item.title}</div>
                    </div>
                    <span class="text-xs text-teal font-bold">&rarr;</span>
                </div>`
            ).join('');
        } else {
            results.innerHTML = `<div class="text-center text-textmuted text-sm py-4">No tutorials found for "${query}". Try another keyword.</div>`;
        }
    })
    .catch(error => {
        console.error("Search error:", error);
        results.innerHTML = '<div class="text-center text-red-500 text-sm py-4">An error occurred while searching.</div>';
    });
}

// Article Modal Drawer
function openArticleModal(title, category, url) {
    closeSearchModal();
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-category').innerText = category.toUpperCase();
    if(url) {
        document.getElementById('modal-link').href = url;
    }
    document.getElementById('article-modal').classList.remove('hidden');
}

function closeArticleModal() {
    document.getElementById('article-modal').classList.add('hidden');
}

// Newsletter Handler
function handleSubscribe(e) {
    e.preventDefault();
    const emailInput = document.getElementById('newsletter-email');
    showToast('Thank you for subscribing with ' + emailInput.value + '!');
    emailInput.value = '';
}

// Toast Notification
function showToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-message').innerText = msg;
    toast.classList.remove('translate-y-20', 'opacity-0');
    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
    }, 3000);
}

// Keyboard Shortcut Cmd+K for Search
document.addEventListener('keydown', (e) => {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        openSearchModal();
    }
    if (e.key === 'Escape') {
        closeSearchModal();
        closeArticleModal();
    }
});

// GSAP Animations
document.addEventListener("DOMContentLoaded", (event) => {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // 3D Hero Image Scroll Parallax
        gsap.to("#hero-image", {
            scrollTrigger: {
                trigger: "header",
                start: "top top",
                end: "bottom -800px",
                scrub: 1,
            },
            rotateX: 15,
            rotateY: -15,
            rotateZ: 2,
            scale: 1.1,
            y: 80,
            ease: "none"
        });

        // Section Reveal Animations
        const sections = gsap.utils.toArray('section');
        sections.forEach(sec => {
            if (sec.id === 'featured' || sec.id === 'resources' || sec.id === 'about' || sec.id === 'newsletter') {
                gsap.from(sec.children[0], {
                    scrollTrigger: {
                        trigger: sec,
                        start: "top 85%",
                    },
                    y: 60,
                    opacity: 0,
                    duration: 1,
                    ease: "power3.out"
                });
            }
        });

        // 3D Flip-Card Reveal
        const flipCards = document.querySelectorAll('[data-flip-card]');
        flipCards.forEach((card, i) => {
            gsap.set(card, { rotateY: 90, opacity: 0, transformOrigin: 'left center' });
            gsap.to(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 88%",
                },
                rotateY: 0,
                opacity: 1,
                duration: 1.1,
                delay: i * 0.12,
                ease: "power3.out"
            });
        });

        // Staggered Items (Trust Bar)
        gsap.from(".gap-x-6 span", {
            scrollTrigger: {
                trigger: ".gap-x-6",
                start: "top 95%",
            },
            y: 20,
            opacity: 0,
            scale: 0.8,
            duration: 0.6,
            stagger: 0.1,
            ease: "back.out(1.5)"
        });

        // Staggered Footer Columns
        gsap.from("#footer > div > div > div", {
            scrollTrigger: {
                trigger: "#footer",
                start: "top 90%",
            },
            y: 30,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: "power2.out"
        });

        // Hero Text Entrance Animation
        const heroTextElements = document.querySelectorAll(".lg\\:col-span-7 > *");
        gsap.from(heroTextElements, {
            y: 40,
            opacity: 0,
            duration: 1.2,
            stagger: 0.15,
            ease: "power3.out",
            delay: 0.1
        });
    }
});
