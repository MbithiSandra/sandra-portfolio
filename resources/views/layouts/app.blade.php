<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CSRF meta tag — needed for JavaScript POST requests --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Sandra Mbithi — Portfolio' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{--
        DARK MODE FLASH PREVENTION
        This tiny inline script runs SYNCHRONOUSLY before the browser
        paints a single pixel. If the user previously chose dark mode,
        we add the class immediately — zero white flash.
        It MUST be inline in <head>. An external script loads too late.
    --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

{{-- No class here — dark mode is handled entirely by JS + localStorage --}}
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">SM<span>.</span></a>

            <ul class="nav-links" id="nav-links-list">
                <li><a href="/#hero">Home</a></li>
                <li><a href="/#about">About</a></li>
                <li><a href="/#skills">Skills</a></li>
                <li><a href="/#projects">Projects</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>

            <div class="nav-right">
                {{--
                    DARK MODE TOGGLE
                    Icon defaults to 🌙 here. syncIcon() in app.js
                    immediately corrects it on load — no visible flash.
                --}}
                <button class="dark-toggle" id="darkToggle" aria-label="Toggle dark mode">
                    <span class="toggle-icon">🌙</span>
                </button>

                {{--
                    HAMBURGER BUTTON
                    Hidden on desktop, visible on mobile via CSS.
                    Three <span> bars animate into an X when menu opens.
                    aria-expanded is updated by app.js for screen readers.
                --}}
                <button
                    class="hamburger"
                    id="hamburger"
                    aria-label="Toggle navigation menu"
                    aria-expanded="false"
                    aria-controls="nav-links-list"
                >
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <p>Built with Laravel · Sandra Mbithi © {{ date('Y') }}</p>
    </footer>

    {{-- ===== AI CHAT WIDGET — floats on every page ===== --}}
    <div class="chat-widget" id="chatWidget">

        <button class="chat-toggle-btn" id="chatToggleBtn" aria-label="Open chat">
            <span class="chat-btn-icon">💬</span>
        </button>

        <div class="chat-window" id="chatWindow">
            <div class="chat-header">
                <div class="chat-header-info">
                    <div class="chat-avatar">SM</div>
                    <div>
                        <div class="chat-name">Sandra's Assistant</div>
                        <div class="chat-status">● Online</div>
                    </div>
                </div>
                <button class="chat-close" id="chatClose">✕</button>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="chat-message chat-message--bot">
                    <p>Hi! 👋 I'm Sandra's AI assistant. Ask me anything about her skills, experience, or how to get in touch!</p>
                </div>
            </div>

            <div class="chat-input-area">
                <input
                    type="text"
                    id="chatInput"
                    placeholder="Ask me anything..."
                    maxlength="500"
                    autocomplete="off"
                >
                <button id="chatSend" class="chat-send-btn">→</button>
            </div>
        </div>

    </div>

    {{-- Scripts at end of <body> — DOM is fully loaded before JS runs --}}
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
