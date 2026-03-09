<link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
<meta name="apple-mobile-web-app-title" content="{{ $app_name ?? 'Todos' }}" />
<link rel="manifest" href="{{ asset('site.webmanifest') }}" />
<meta property="og:title" content="Todo - Secure To-Do App">
<meta property="og:description" content="Simple todo app built with Laravel with Sanctum authentication">
<meta property="og:image" content="https://todos.rahmaanms.my.id/preview.png">
<meta property="og:url" content="https://todos.rahmaanms.my.id">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="https://todos.rahmaanms.my.id/preview.png">

<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>