<link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
<meta name="apple-mobile-web-app-title" content="{{ $app_name ?? 'Todos' }}" />
<link rel="manifest" href="{{ asset('site.webmanifest') }}" />
<meta property="og:title" content="{{ $app_name ?? 'Todos' }}">
<meta property="og:description" content="Simple todo app built with Laravel">
<meta property="og:image" content="{{ asset('preview.png') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">