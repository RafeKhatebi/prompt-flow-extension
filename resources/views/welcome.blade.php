<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PromptFlow — AI Prompt Manager</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">    
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('asset/css/welcome-page.css') }}">
    </head>

    <body>
        <nav>
            <a href="/" class="brand">Prompt<span>Flow</span></a>
            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-solid">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-solid">Get Started</a>
                    @endif
                @endauth
            </div>
        </nav>

        <main>
            <div class="hero-badge">✦ AI Prompt Manager</div>
            <h1>Manage & Inject <span>AI Prompts</span> Instantly</h1>
            <p class="hero-sub">Save, organize, and inject your best prompts into ChatGPT, Claude, and any AI tool —
                with one click.</p>
            <div class="hero-actions">
                @auth
                    <a href="{{ route('prompts.index') }}" class="btn-hero btn-hero-primary">My Prompts</a>
                    <a href="{{ route('prompts.create') }}" class="btn-hero btn-hero-secondary">+ New Prompt</a>
                @else
                    <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">Start for Free</a>
                    <a href="{{ route('login') }}" class="btn-hero btn-hero-secondary">Sign In</a>
                @endauth
            </div>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">📝</div>
                    <h3>Store Prompts</h3>
                    <p>Create and organize all your AI prompts in one place with tags.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">⚡</div>
                    <h3>One-Click Inject</h3>
                    <p>Paste any prompt directly into AI textareas or copy to clipboard.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🔍</div>
                    <h3>Instant Search</h3>
                    <p>Find any prompt instantly by title, content, or tags.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">📤</div>
                    <h3>Export & Share</h3>
                    <p>Export your prompts as JSON and share with your team.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🆔</div>
                    <h3>Prompt Variables</h3>
                    <p>Use placeholders like {topic} to create dynamic templates for any situation.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🌐</div>
                    <h3>Browser Sync</h3>
                    <p>Access your prompt library via a sidebar extension on any AI platform.</p>
                </div>
            </div>


        </main>

        <footer>© {{ date('Y') }} PromptFlow. Created by Rafe Khatebi</footer>
    </body>

</html>
