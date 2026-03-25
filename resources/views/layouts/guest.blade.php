<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PromptFlow') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pf-accent: #5b5ef4;
            --pf-accent-hover: #4a4dd6;
            --pf-border: #e9ecef;
            --pf-muted: #6c757d;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fb; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-card { background: #fff; border: 1px solid var(--pf-border); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 420px; box-shadow: 0 4px 24px rgba(0,0,0,.06); }
        .auth-brand { font-weight: 700; font-size: 1.4rem; color: var(--pf-accent); text-align: center; margin-bottom: 0.25rem; letter-spacing: -0.3px; }
        .auth-brand span { color: #1a1d23; }
        .auth-subtitle { text-align: center; color: var(--pf-muted); font-size: 13px; margin-bottom: 2rem; }
        .auth-label { font-size: 13px; font-weight: 500; color: #1a1d23; margin-bottom: 0.35rem; display: block; }
        .auth-input { border: 1px solid var(--pf-border); border-radius: 8px; padding: 0.55rem 0.85rem; font-size: 14px; width: 100%; transition: border-color .15s, box-shadow .15s; outline: none; font-family: 'Inter', sans-serif; }
        .auth-input:focus { border-color: var(--pf-accent); box-shadow: 0 0 0 3px rgba(91,94,244,.1); }
        .auth-btn { background: var(--pf-accent); color: #fff; border: none; border-radius: 8px; padding: 0.6rem 1.25rem; font-size: 14px; font-weight: 600; width: 100%; cursor: pointer; transition: background .15s; font-family: 'Inter', sans-serif; }
        .auth-btn:hover { background: var(--pf-accent-hover); }
        .auth-link { color: var(--pf-accent); text-decoration: none; font-size: 13px; }
        .auth-link:hover { text-decoration: underline; }
        .auth-error { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 0.75rem 1rem; font-size: 13px; color: #dc2626; margin-bottom: 1rem; }
        .auth-divider { border: none; border-top: 1px solid var(--pf-border); margin: 1.5rem 0; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-brand">Prompt<span>Flow</span></div>
        <p class="auth-subtitle">AI Prompt Management</p>
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
