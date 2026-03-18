// =============================================
// DARK MODE TOGGLE
// =============================================
// document.documentElement IS the <html> element.
// Your CSS targets html.dark { } so the class MUST go on <html>.
// getElementById('html-root') was finding the element but the real
// problem was the icon logic was backwards — fixed below.
const htmlRoot   = document.documentElement;
const darkToggle = document.getElementById('darkToggle');
const toggleIcon = darkToggle.querySelector('.toggle-icon');

// ── Sync icon to current state on load ──
// Reads the REAL current state rather than assuming light mode.
// Needed because the inline <head> script may have already added .dark.
function syncIcon() {
    const isDark = htmlRoot.classList.contains('dark');
    // Icon shows what you will SWITCH TO, not the current state:
    // Currently dark  → show ☀️  (click to go light)
    // Currently light → show 🌙  (click to go dark)
    toggleIcon.textContent = isDark ? '☀️' : '🌙';
}

syncIcon(); // set correct icon immediately on page load

darkToggle.addEventListener('click', () => {
    const isDark = htmlRoot.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    syncIcon();
});

// =============================================
// HAMBURGER MENU
// =============================================
// Clicking the burger toggles .nav-open on the nav-links list.
// The CSS uses that class to slide the menu into view on mobile.
const hamburger = document.getElementById('hamburger');
const navLinks  = document.querySelector('.nav-links');

if (hamburger && navLinks) {

    hamburger.addEventListener('click', () => {
        const isOpen = navLinks.classList.toggle('nav-open');

        // aria-expanded tells screen readers whether the menu is open —
        // this is important accessibility practice
        hamburger.setAttribute('aria-expanded', isOpen);

        // Animate burger bars → X shape
        hamburger.classList.toggle('hamburger--open', isOpen);
    });

    // Close menu when any nav link is clicked — good UX on mobile
    // so the menu doesn't stay open after navigating to a section
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('nav-open');
            hamburger.classList.remove('hamburger--open');
            hamburger.setAttribute('aria-expanded', false);
        });
    });

    // Close menu when clicking anywhere outside the navbar
    document.addEventListener('click', (e) => {
        const nav = document.querySelector('.navbar');
        if (nav && !nav.contains(e.target)) {
            navLinks.classList.remove('nav-open');
            hamburger.classList.remove('hamburger--open');
            hamburger.setAttribute('aria-expanded', false);
        }
    });
}

// =============================================
// AI CHAT WIDGET
// =============================================
const chatToggleBtn = document.getElementById('chatToggleBtn');
const chatWindow    = document.getElementById('chatWindow');
const chatClose     = document.getElementById('chatClose');
const chatInput     = document.getElementById('chatInput');
const chatSend      = document.getElementById('chatSend');
const chatMessages  = document.getElementById('chatMessages');

// Read the CSRF token from the meta tag in <head>.
// Laravel requires this on every POST request — it proves
// the request came from YOUR site, not a malicious one (CSRF attack).
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// ── Open / close ──
chatToggleBtn.addEventListener('click', () => {
    chatWindow.classList.toggle('chat-window--open');
});

chatClose.addEventListener('click', () => {
    chatWindow.classList.remove('chat-window--open');
});

// ── Send on Enter key ──
chatInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

chatSend.addEventListener('click', sendMessage);

// ── Helper: create and append a message bubble ──
function addMessage(text, type) {
    const div = document.createElement('div');
    div.classList.add('chat-message', `chat-message--${type}`);
    div.innerHTML = `<p>${text}</p>`;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    return div; // returned so caller can .remove() it (e.g. the typing bubble)
}

// ── Main send function ──
async function sendMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    addMessage(message, 'user');
    chatInput.value = '';
    chatSend.disabled = true;

    const typingBubble = addMessage("Sandra's assistant is typing...", 'typing');

    try {
        const response = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ message }),
        });

        // fetch() only rejects on network failure — a 500 server error still
        // "succeeds" from fetch's perspective. This line catches that case.
        if (!response.ok) throw new Error(`Server error: ${response.status}`);

        const data = await response.json();
        typingBubble.remove();

        if (data.error) {
            addMessage('Sorry, something went wrong. Please try again.', 'bot');
        } else {
            addMessage(data.reply, 'bot');
        }

    } catch (error) {
        typingBubble.remove();
        console.error('Chat error:', error); // open DevTools > Console to see details
        addMessage('Connection error. Please check your internet and try again.', 'bot');

    } finally {
        // finally always runs whether try succeeded or catch fired —
        // perfect for cleanup that must happen regardless of outcome
        chatSend.disabled = false;
        chatInput.focus();
    }
}
