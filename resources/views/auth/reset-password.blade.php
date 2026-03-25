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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight text-blue-600 dark:text-white mb-2">Reset Password</h1>
                <p class="text-slate-400">Please choose a new strong password</p>
            </div>

            <!-- Reset Password Card -->
            <div class="relative animate-in zoom-in-95 duration-700 delay-150">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl blur opacity-20 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-900/10 dark:bg-slate-900/60 backdrop-blur-3xl px-8 py-10 shadow-2xl rounded-3xl border border-white/10">
                    <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-blue-600 dark:text-slate-300 ml-1">Email Address</label>
                            <input id="email" name="email" type="email" required readonly
                                class="w-full bg-slate-400/20 dark:bg-slate-950/30 border border-white/10 rounded-xl py-3 px-4 text-slate-400 cursor-not-allowed opacity-50"
                                placeholder="name@example.com" value="{{ $email ?? old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-blue-600 dark:text-slate-300 ml-1">New Password</label>
                            <input id="password" name="password" type="password" required 
                                class="w-full bg-slate-400 dark:bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="••••••••">
                            @error('password')
                                <p class="text-xs text-red-400 mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-medium text-blue-600 dark:text-slate-300 ml-1">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="w-full bg-slate-400 dark:bg-slate-950/50 border border-white/10 rounded-xl py-3 px-4 text-white placeholder-slate-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all duration-300"
                                placeholder="••••••••">
                        </div>

                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition-all duration-300 transform active:scale-95 shadow-lg shadow-indigo-600/20">
                            Update Password
                        </button>
                    </form>
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
