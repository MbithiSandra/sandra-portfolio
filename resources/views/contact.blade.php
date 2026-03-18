@extends('layouts.app')

@section('content')

<section class="contact-section">
    <div class="section-container">

        <div class="section-label">Get In Touch</div>
        <h2 class="section-title">Let's <span class="highlight">work together</span></h2>

        {{-- Success message --}}
        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="contact-grid">

            {{-- LEFT — Contact info --}}
            <div class="contact-info">
                <p class="contact-intro">Whether you want to collaborate, book me for a project, or just say hi — I'd love to hear from you.</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <div>
                            <span class="contact-label">Email</span>
                            <a href="mailto:mbithisandra83@gmail.com">mbithisandra83@gmail.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📱</span>
                        <div>
                            <span class="contact-label">Phone</span>
                            <a href="tel:+254758561281">+254 758 561 281</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <div>
                            <span class="contact-label">Location</span>
                            <span>Nairobi, Kenya</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">💼</span>
                        <div>
                            <span class="contact-label">LinkedIn</span>
                            <a href="https://www.linkedin.com/in/sandra-mbithi-032291291" target="_blank">Sandra Mbithi</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT — The form --}}
            <div class="contact-form-wrapper">
                <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                    {{-- CSRF token — required for all POST forms in Laravel --}}
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            {{-- old('name') repopulates the field if validation fails --}}
                            <input type="text" id="name" name="name"
                                value="{{ old('name') }}"
                                placeholder="John Doe"
                                class="{{ $errors->has('name') ? 'input-error' : '' }}">
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email') }}"
                                placeholder="john@example.com"
                                class="{{ $errors->has('email') ? 'input-error' : '' }}">
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type">Type of Enquiry</label>
                        <select id="type" name="type" class="{{ $errors->has('type') ? 'input-error' : '' }}">
                            <option value="">Select a type...</option>
                            <option value="general"       {{ old('type') == 'general'       ? 'selected' : '' }}>General Enquiry</option>
                            <option value="booking"       {{ old('type') == 'booking'       ? 'selected' : '' }}>Book Me</option>
                            <option value="collaboration" {{ old('type') == 'collaboration' ? 'selected' : '' }}>Collaboration</option>
                        </select>
                        @error('type')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject"
                            value="{{ old('subject') }}"
                            placeholder="What's this about?"
                            class="{{ $errors->has('subject') ? 'input-error' : '' }}">
                        @error('subject')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5"
                            placeholder="Tell me about your project or idea..."
                            class="{{ $errors->has('message') ? 'input-error' : '' }}">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        Send Message →
                    </button>

                </form>
            </div>

        </div>
    </div>
</section>

@endsection