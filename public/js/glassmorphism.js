/**
 * glassmorphism.js — Sandra Mbithi Portfolio
 * Drop this file in: public/js/glassmorphism.js
 * Add to your Blade layout BEFORE </body>:
 *   <script src="{{ asset('js/glassmorphism.js') }}"></script>
 *
 * What this does:
 * 1. Adds .scrolled class to navbar when user scrolls (deeper glass effect)
 * 2. Uses IntersectionObserver to trigger fade-in-up animations on scroll
 * 3. Tracks mouse for a subtle parallax tilt on glass cards (optional, tasteful)
 *
 * CONCEPT — IntersectionObserver:
 * This browser API fires a callback whenever an element enters or exits
 * the viewport. Way better than the old "listen to scroll event and calculate
 * positions" approach — no scroll jank, GPU-accelerated, zero layout thrashing.
 */

document.addEventListener('DOMContentLoaded', () => {

    // -----------------------------------------------------------------------
    // 1. NAVBAR SCROLL STATE
    // Adds .scrolled class when user scrolls past 50px
    // Your CSS already handles the visual change
    // -----------------------------------------------------------------------
    const navbar = document.querySelector('nav, .navbar, #navbar, header nav');

    if (navbar) {
        const handleNavScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };

        // Passive listener = browser can scroll without waiting for JS to finish
        // This is a performance win — always use passive: true for scroll listeners
        window.addEventListener('scroll', handleNavScroll, { passive: true });
        handleNavScroll(); // Run once on load in case page loads scrolled
    }


    // -----------------------------------------------------------------------
    // 2. SCROLL-TRIGGERED ENTRANCE ANIMATIONS
    // Elements with .fade-in-up animate into view when scrolled to
    // -----------------------------------------------------------------------
    const fadeEls = document.querySelectorAll('.fade-in-up');

    if (fadeEls.length > 0) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        // Once animated in, stop observing — saves resources
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12,    // Fire when 12% of element is visible
                rootMargin: '0px 0px -40px 0px'  // Trigger 40px before bottom
            }
        );

        fadeEls.forEach(el => observer.observe(el));
    }


    // -----------------------------------------------------------------------
    // 3. AUTO-APPLY FADE-IN-UP TO SECTIONS
    // If you don't want to manually add .fade-in-up to every element,
    // this automatically applies it to common section children.
    // Comment this out if you prefer manual control.
    // -----------------------------------------------------------------------
    const autoAnimateSelectors = [
        '.project-card',
        '.skill-badge',
        '.about-card',
        '.glass-card',
        'section h2',
        'section h3',
    ];

    autoAnimateSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach((el, i) => {
            // Only auto-apply if not already tagged
            if (!el.classList.contains('fade-in-up')) {
                el.classList.add('fade-in-up');
            }
        });
    });

    // Re-run observer for newly tagged elements
    document.querySelectorAll('.fade-in-up:not(.visible)').forEach(el => {
        if (typeof observer !== 'undefined') {
            observer.observe(el);
        }
    });


    // -----------------------------------------------------------------------
    // 4. GLASS CARD TILT EFFECT (subtle 3D on hover)
    // Gives cards a very subtle tilt as your mouse moves over them.
    // Looks premium. Max tilt: 6 degrees so it doesn't feel gimmicky.
    // -----------------------------------------------------------------------
    const tiltCards = document.querySelectorAll('.project-card, .glass-card, .about-card');

    // Skip tilt on touch devices — doesn't make sense there
    const isTouchDevice = window.matchMedia('(hover: none)').matches;

    if (!isTouchDevice) {
        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                // Normalise to -1..+1
                const deltaX = (e.clientX - centerX) / (rect.width / 2);
                const deltaY = (e.clientY - centerY) / (rect.height / 2);

                const maxTilt = 6; // degrees
                const rotateY =  deltaX * maxTilt;
                const rotateX = -deltaY * maxTilt;

                card.style.transform = `
                    translateY(-4px)
                    rotateX(${rotateX}deg)
                    rotateY(${rotateY}deg)
                    scale(1.01)
                `;
                card.style.transition = 'transform 0.1s ease'; // snappy while moving
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
                card.style.transition = 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)';
            });
        });
    }


    // -----------------------------------------------------------------------
    // 5. SMOOTH SCROLL for anchor links
    // Makes clicking #about, #skills, etc. scroll smoothly
    // -----------------------------------------------------------------------
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });


    // -----------------------------------------------------------------------
    // 6. ACTIVE NAV LINK HIGHLIGHTING
    // Highlights the nav link for the section currently in viewport
    // -----------------------------------------------------------------------
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');

    if (sections.length > 0 && navLinks.length > 0) {
        const sectionObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            },
            { threshold: 0.45 } // Section must be 45% visible to be "active"
        );

        sections.forEach(s => sectionObserver.observe(s));
    }


    // -----------------------------------------------------------------------
    // 7. CHATBOT TYPING INDICATOR helper
    // Call window.showTyping() and window.hideTyping() from your chatbot code
    // to show/hide the glass "AI is thinking" dots
    // -----------------------------------------------------------------------
    window.showTyping = function(container) {
        const existing = container?.querySelector('.typing-indicator');
        if (existing) return;

        const indicator = document.createElement('div');
        indicator.className = 'typing-indicator chat-bubble-bot';
        indicator.style.cssText = 'padding: 12px 16px; display: inline-flex; gap: 4px; align-items: center;';
        indicator.innerHTML = `
            <span class="thinking-dot"></span>
            <span class="thinking-dot"></span>
            <span class="thinking-dot"></span>
        `;
        indicator.setAttribute('aria-label', 'AI is typing');

        if (container) container.appendChild(indicator);
        return indicator;
    };

    window.hideTyping = function(container) {
        container?.querySelector('.typing-indicator')?.remove();
    };


    console.log('✨ Glassmorphism effects loaded — Sandra Portfolio');
});
