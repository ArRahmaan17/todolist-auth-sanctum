<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-600">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="mx-auto h-20 w-20 bg-indigo-600 rounded-full flex items-center justify-center shadow-lg transform transition hover:scale-105 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h2 class="mt-8 text-center text-3xl font-extrabold leading-9 tracking-tight text-slate-900">
                Sign in to {{ $app_name ?? 'Your Account' }}
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Welcome back! Please enter your details.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-white px-6 py-10 shadow-xl rounded-2xl border border-slate-100/50">
                <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Email address</label>
                        <div class="mt-2 relative">
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 ease-in-out" value="{{ old('email') }}">
                            @error('email')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                         @error('email')
                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="text-sm">
                                <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">Forgot password?</a>
                            </div>
                        </div>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-lg border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 ease-in-out">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-300 transform active:scale-95">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-10 text-center text-sm text-slate-500">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 transition-colors">Create an account</a>
            </p>
        </div>
    </div>
</body>
</html>
