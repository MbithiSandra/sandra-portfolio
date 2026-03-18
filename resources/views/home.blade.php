@extends('layouts.app')

@section('content')

    {{-- ===== HERO SECTION ===== --}}
    <section class="hero" id="hero">
        <div class="hero-container">
            <div class="hero-badge">👋 Available for opportunities</div>
            <h1 class="hero-title">
                Hi, I'm <span class="highlight">{{ $name }}</span>
            </h1>
            <p class="hero-subtitle">{{ $title }}</p>
            <p class="hero-location">📍 {{ $location }}</p>

            <div class="hero-buttons">
    <a href="{{ route('contact') }}" class="btn btn-primary">Let's Connect</a>
    <a href="{{ route('cv.download') }}" class="btn btn-secondary">Download CV ↓</a>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT SECTION ===== --}}
    <section class="about" id="about">
        <div class="section-container">

            <div class="section-label">About Me</div>
            <h2 class="section-title">Turning ideas into <span class="highlight">digital solutions</span></h2>

            <div class="about-grid">
                <div class="about-text">
                    <p>I'm a Business Information Technology student at Strathmore University, maintaining First-Class Standing and recognized twice on the Dean's List. I combine technical skills with business thinking to build practical, impactful solutions.</p>
                    <p>In 2025, I represented Strathmore at the FLOW Undergraduate Engineering Summer School at Polytech Montpellier, France — collaborating with an international cohort on AI and data processing projects.</p>
                    <p>I'm passionate about web development, data analytics, and cybersecurity, and I hold a Certificate in Cybersecurity from ISC2.</p>

                    <div class="about-stats">
                        <div class="stat">
                            <span class="stat-number">2×</span>
                            <span class="stat-label">Dean's List</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">A</span>
                            <span class="stat-label">Average Grade</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">ISC2</span>
                            <span class="stat-label">Cybersecurity Cert</span>
                        </div>
                    </div>
                </div>

                <div class="about-highlights">
                    <div class="highlight-card">
                        <span class="highlight-icon">🎓</span>
                        <div>
                            <strong>Strathmore University</strong>
                            <p>BSc Business Information Technology · 2023–Present</p>
                        </div>
                    </div>
                    <div class="highlight-card">
                        <span class="highlight-icon">🌍</span>
                        <div>
                            <strong>Polytech Montpellier, France</strong>
                            <p>FLOW Engineering Summer School · 2025</p>
                        </div>
                    </div>
                    <div class="highlight-card">
                        <span class="highlight-icon">🔐</span>
                        <div>
                            <strong>ISC2 Cybersecurity</strong>
                            <p>Certificate · Moringa School · 2023</p>
                        </div>
                    </div>
                    <div class="highlight-card">
                        <span class="highlight-icon">🤝</span>
                        <div>
                            <strong>AIESEC</strong>
                            <p>Marketing & Sales · Global Exchange Programs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SKILLS SECTION ===== --}}
    <section class="skills" id="skills">
        <div class="section-container">

            <div class="section-label">Technical Skills</div>
            <h2 class="section-title">What I <span class="highlight">work with</span></h2>

            <div class="skills-grid">

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">💻</span> Programming Languages
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-purple">Java</span>
                        <span class="tag tag-purple">PHP</span>
                        <span class="tag tag-purple">Python</span>
                        <span class="tag tag-purple">HTML</span>
                        <span class="tag tag-purple">CSS</span>
                        <span class="tag tag-purple">Assembly</span>
                    </div>
                </div>

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">🌐</span> Web Development
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-teal">Laravel</span>
                        <span class="tag tag-teal">XAMPP</span>
                        <span class="tag tag-teal">Git</span>
                        <span class="tag tag-teal">GitHub</span>
                        <span class="tag tag-teal">VS Code</span>
                        <span class="tag tag-teal">Responsive Design</span>
                    </div>
                </div>

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">🗄️</span> Database Management
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-blue">MySQL</span>
                        <span class="tag tag-blue">Stored Procedures</span>
                        <span class="tag tag-blue">Query Optimization</span>
                        <span class="tag tag-blue">Views & Functions</span>
                    </div>
                </div>

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">🤖</span> AI & Data
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-amber">Python</span>
                        <span class="tag tag-amber">Statistical Modeling</span>
                        <span class="tag tag-amber">ML Concepts</span>
                        <span class="tag tag-amber">Data Processing</span>
                    </div>
                </div>

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">🛠️</span> Dev Tools
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-coral">Docker</span>
                        <span class="tag tag-coral">Git Bash</span>
                        <span class="tag tag-coral">Visual Studio Code</span>
                        <span class="tag tag-coral">MS Office Suite</span>
                    </div>
                </div>

                <div class="skill-category">
                    <h3 class="skill-category-title">
                        <span class="skill-icon">🔐</span> Security & Networks
                    </h3>
                    <div class="skill-tags">
                        <span class="tag tag-green">Cybersecurity</span>
                        <span class="tag tag-green">Routing Protocols</span>
                        <span class="tag tag-green">Network Config</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== PROJECTS SECTION ===== --}}
<section class="projects" id="projects">
    <div class="section-container">

        <div class="section-label">My Work</div>
        <h2 class="section-title">Featured <span class="highlight">Projects</span></h2>

        <div class="projects-grid">

            {{-- Project 1 --}}
            <div class="project-card">
                <div class="project-header">
                    <div class="project-icon">🚗</div>
                    <div class="project-links">
                        <span class="project-tag">Python</span>
                        <span class="project-tag">OOP</span>
                    </div>
                </div>
                <h3 class="project-title">Vehicle Rental Management System</h3>
                <p class="project-desc">A comprehensive rental system applying core OOP principles — inheritance, classes, and method reuse. Focused on clean, maintainable code while addressing real-world business challenges.</p>
                <div class="project-footer">
                    <span class="project-type">Individual Assignment</span>
                </div>
            </div>

            {{-- Project 2 --}}
            <div class="project-card project-card--featured">
                <div class="project-header">
                    <div class="project-icon">📡</div>
                    <div class="project-links">
                        <span class="project-tag">MySQL</span>
                        <span class="project-tag">Database</span>
                    </div>
                </div>
                <h3 class="project-title">Safaricom Network Management System</h3>
                <p class="project-desc">In-depth analysis of Safaricom's network challenges including 5G expansion and cybersecurity risks. Implemented complex stored procedures, functions, and views in MySQL to simulate network reporting.</p>
                <div class="project-footer">
                    <span class="project-type">Advanced Database Project</span>
                </div>
            </div>

            {{-- Project 3 --}}
            <div class="project-card">
                <div class="project-header">
                    <div class="project-icon">🌐</div>
                    <div class="project-links">
                        <span class="project-tag">Laravel</span>
                        <span class="project-tag">PHP</span>
                        <span class="project-tag">MySQL</span>
                    </div>
                </div>
                <h3 class="project-title">Personal Portfolio Website</h3>
                <p class="project-desc">This very website — built with Laravel, featuring a dark mode toggle, contact form with email integration, CV download, and an AI-powered chatbot using Mistral AI.</p>
                <div class="project-footer">
                    <span class="project-type">Personal Project</span>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection