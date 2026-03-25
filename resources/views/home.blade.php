<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @include('components.head')
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .mesh-gradient {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(147, 51, 234, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(79, 70, 229, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(147, 51, 234, 0.1) 0px, transparent 50%);
        }
        .hero-glow {
            filter: blur(120px);
            background: linear-gradient(to right, #4f46e5, #9333ea);
            opacity: 0.2;
        }
    </style>
</head>
<body class="min-h-full antialiased text-slate-400 mesh-gradient selection:bg-indigo-500/30 selection:text-indigo-200 overflow-x-hidden">
    
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 group">
                <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-600/10 border border-indigo-500/20 shadow-2xl shadow-indigo-500/10 group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">{{ $app_name }}</span>
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ route('lists') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="h-10 px-5 rounded-full bg-white/5 border border-white/10 text-sm font-medium text-white hover:bg-white/10 transition-all active:scale-95">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="h-10 px-5 flex items-center rounded-full bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 transition-all active:scale-95">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[400px] hero-glow rounded-[100%] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-xs font-semibold text-indigo-400 tracking-wider uppercase animate-in fade-in slide-in-from-bottom-2 duration-700">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Master Your Workflow
                </div>
                
                <h1 class="text-6xl md:text-7xl font-extrabold tracking-tight text-white animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-100">
                    Organize your life in <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">one simple place.</span>
                </h1>
                
                <p class="text-xl text-slate-400 leading-relaxed max-w-2xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-200">
                    Minimalist, powerful, and secure. Stay on top of your tasks with our modern productivity suite designed for clarity and focus.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4 animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-300">
                    @auth
                        <a href="{{ route('lists') }}" class="h-14 px-8 flex items-center rounded-2xl bg-indigo-600 text-lg font-bold text-white hover:bg-indigo-500 shadow-2xl shadow-indigo-600/30 transition-all active:scale-95 group">
                            Go to Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="h-14 px-8 flex items-center rounded-2xl bg-indigo-600 text-lg font-bold text-white hover:bg-indigo-500 shadow-2xl shadow-indigo-600/30 transition-all active:scale-95 group">
                            Start Tracking Free
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#features" class="h-14 px-8 flex items-center rounded-2xl bg-white/5 border border-white/10 text-lg font-bold text-white hover:bg-white/10 transition-all active:scale-95">
                            Learn More
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Dashboard Preview / Mockup -->
            <div class="mt-24 relative max-w-5xl mx-auto animate-in zoom-in-95 duration-1000 delay-500">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-25"></div>
                <div class="relative bg-slate-900 rounded-2xl border border-white/10 overflow-hidden shadow-2xl shadow-black">
                    <div class="h-10 bg-slate-800 border-b border-white/5 flex items-center gap-2 px-4">
                        <div class="h-3 w-3 rounded-full bg-red-500/60"></div>
                        <div class="h-3 w-3 rounded-full bg-amber-500/60"></div>
                        <div class="h-3 w-3 rounded-full bg-emerald-500/60"></div>
                    </div>
                    <div class="p-8 aspect-video bg-gradient-to-br from-slate-900 to-indigo-950/30 flex items-center justify-center">
                        <div class="space-y-4 w-full max-w-md">
                            <div class="h-12 w-full rounded-xl bg-white/5 border border-white/10 flex items-center px-4 gap-3 animate-pulse">
                                <div class="h-5 w-5 rounded border border-white/20"></div>
                                <div class="h-2 w-32 bg-white/10 rounded"></div>
                            </div>
                            <div class="h-12 w-full rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center px-4 gap-3">
                                <div class="h-5 w-5 rounded bg-indigo-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="h-2 w-48 bg-white/30 rounded"></div>
                            </div>
                            <div class="h-12 w-full rounded-xl bg-white/5 border border-white/10 flex items-center px-4 gap-3">
                                <div class="h-5 w-5 rounded border border-white/20"></div>
                                <div class="h-2 w-24 bg-white/10 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-indigo-500/30 transition-all duration-500 group">
                    <div class="h-14 w-14 rounded-2xl bg-indigo-600/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Secure by Default</h3>
                    <p class="text-slate-400">Advanced authentication powered by Laravel Sanctum ensures your data stays your data.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-purple-500/30 transition-all duration-500 group">
                    <div class="h-14 w-14 rounded-2xl bg-purple-600/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Blazing Fast</h3>
                    <p class="text-slate-400">Optimized for speed. Manage tasks without the friction of a slow, clunky interface.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-emerald-500/30 transition-all duration-500 group">
                    <div class="h-14 w-14 rounded-2xl bg-emerald-600/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Library Management</h3>
                    <p class="text-slate-400">The first todo app that also organizes your reading list. Categories, authors, and more.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <p class="text-sm text-slate-500">
                &copy; {{ date('Y') }} {{ $app_name }}. Built for performance and style.
            </p>
            <div class="flex items-center gap-6">
                <a href="/api/documentation" target="_blank" class="text-sm text-slate-500 hover:text-indigo-400 transition-colors">API Docs</a>
                <a href="#" class="text-sm text-slate-500 hover:text-indigo-400 transition-colors">Privacy</a>
                <a href="#" class="text-sm text-slate-500 hover:text-indigo-400 transition-colors">Github</a>
            </div>
        </div>
    </footer>

</body>
</html>
