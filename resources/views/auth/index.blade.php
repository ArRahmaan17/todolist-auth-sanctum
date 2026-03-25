<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @include('components.head')
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-full antialiased text-slate-400 mesh-gradient selection:bg-indigo-500/30 selection:text-indigo-200">
    <div class="flex min-h-full items-center justify-center p-6 lg:p-8">
        <div class="w-full max-w-md">
            <!-- Header Section -->
            <div class="mb-10 text-center animate-in fade-in slide-in-from-top-4 duration-1000">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-600/10 p-5 ring-1 ring-indigo-500/20 shadow-2xl shadow-indigo-500/10 mb-6 backdrop-blur-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight text-blue-600 dark:text-white mb-2">Welcome Back</h1>
                <p class="text-slate-400">Sign in to your account at {{ $app_name ?? 'TodoList' }}</p>
            </div>

            <!-- Login Card -->
            <div class="relative animate-in zoom-in-95 duration-700 delay-150">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl blur opacity-20 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-900/10 dark:bg-slate-900/60 backdrop-blur-3xl px-8 py-10 shadow-2xl rounded-3xl border border-white/10">
                    <form class="space-y-6" action="{{ route('login.post') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-blue-600 dark:text-slate-300 ml-1">Email Address</label>
                            <input id="email" name="email" type="email" required 
                                class="w-full bg-slate-400 dark:bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="name@example.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between ml-1">
                                <label for="password" class="text-sm font-medium text-blue-600 dark:text-slate-300">Password</label>
                                <a href="{{ route('password.request') }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">Forgot password?</a>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full bg-slate-400 dark:bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="••••••••">
                        </div>

                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition-all duration-300 transform active:scale-95 shadow-lg shadow-indigo-600/20">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-indigo-300 group-hover:text-indigo-100 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Sign in
                        </button>
                    </form>

                    <div class="mt-8 pt-8 border-t border-white/5 flex flex-col items-center gap-4">
                        <p class="text-sm text-black dark:text-slate-500">
                            New here? 
                            <a href="{{ route('register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-indigo-400/30 underline-offset-4 hover:decoration-indigo-400">
                                Create an account
                            </a>
                        </p>
                        
                        <!-- Swagger Documentation Link -->
                        <a href="/api/documentation" target="_blank" 
                           class="inline-flex items-center gap-2 text-xs font-medium text-slate-500 hover:text-indigo-400 transition-all duration-300 bg-white/5 px-4 py-2 rounded-full border border-white/5 hover:border-indigo-500/30 hover:bg-indigo-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            API Documentation Browser
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <p class="mt-10 text-center text-xs text-slate-600 dark:text-slate-100 animate-in fade-in duration-1000 delay-500">
                &copy; {{ date('Y') }} {{ $app_name ?? 'TodoList' }}. All rights reserved. Built with ❤️ for your productivity.
            </p>
        </div>
    </div>
</body>
</html>
