<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .mesh-gradient {
            background-color: #020617;
            background-image: 
                radial-gradient(at 100% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 0% 0%, hsla(339,49%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 50%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 0% 50%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(339,49%,30%,1) 0, transparent 50%), 
                radial-gradient(at 50% 100%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 0% 100%, hsla(253,16%,7%,1) 0, transparent 50%);
        }
    </style>
</head>
<body class="h-full antialiased text-slate-400 mesh-gradient selection:bg-indigo-500/30 selection:text-indigo-200">
    <div class="flex min-h-full items-center justify-center p-6 lg:p-8">
        <div class="w-full max-w-md">
            <!-- Header Section -->
            <div class="mb-10 text-center animate-in fade-in slide-in-from-top-4 duration-1000">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-600/10 p-5 ring-1 ring-indigo-500/20 shadow-2xl shadow-indigo-500/10 mb-6 backdrop-blur-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight text-white mb-2">Create Account</h1>
                <p class="text-slate-400">Join {{ $app_name ?? 'TodoList' }} and stay organized</p>
            </div>

            <!-- Register Card -->
            <div class="relative animate-in zoom-in-95 duration-700 delay-150">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-indigo-500 rounded-3xl blur opacity-20 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-900/60 backdrop-blur-3xl px-8 py-10 shadow-2xl rounded-3xl border border-white/10">
                    <form class="space-y-5" action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-slate-300 ml-1">Full Name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required 
                                class="w-full bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="John Doe" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-slate-300 ml-1">Email Address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="w-full bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="name@example.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="password" class="text-sm font-medium text-slate-300 ml-1">Password</label>
                                <input id="password" name="password" type="password" required
                                    class="w-full bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                    placeholder="••••••••">
                            </div>
                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-sm font-medium text-slate-300 ml-1">Confirm</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="w-full bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                        @enderror

                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition-all duration-300 transform active:scale-95 shadow-lg shadow-indigo-600/20 mt-2">
                            Sign up
                        </button>
                    </form>

                    <div class="mt-8 pt-8 border-t border-white/5 text-center">
                        <p class="text-sm text-slate-500">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-indigo-400/30 underline-offset-4 hover:decoration-indigo-400">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <p class="mt-10 text-center text-xs text-slate-600 dark:text-slate-100 animate-in fade-in duration-1000 delay-500">
                &copy; {{ date('Y') }} {{ $app_name ?? 'TodoList' }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
