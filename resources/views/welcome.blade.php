<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'Todo List') }}</title>
    @include('components.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-full antialiased text-slate-400 mesh-gradient selection:bg-indigo-500/30 selection:text-indigo-200">
    <nav class="bg-white/70 dark:bg-slate-900/60 backdrop-blur-3xl border-b border-slate-200 dark:border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                         <div class="h-10 w-10 bg-indigo-600/20 rounded-xl flex items-center justify-center ring-1 ring-indigo-500/30 shadow-lg shadow-indigo-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="ml-3 font-bold text-xl text-slate-900 dark:text-white tracking-tight">Todo App</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 sm:gap-4">
                    <span class="hidden sm:block text-sm text-slate-500 dark:text-slate-400">
                        Hello, <span class="font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()->name }}</span>
                    </span>
                    
                    <!-- Theme Switcher -->
                    <div class="relative">
                        <button id="theme-toggle" type="button" class="group relative inline-flex items-center justify-center p-2 rounded-xl bg-white/5 text-slate-400 hover:text-white ring-1 ring-inset ring-white/10 hover:bg-white/10 transition-all duration-300">
                            <svg id="theme-sun" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M3 12h2.25m.386-6.364l1.591 1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M3 12h2.25m.386-6.364l1.591 1.591M12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9z" />
                            </svg>
                            <svg id="theme-moon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                            <svg id="theme-system" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12H3V5.25" />
                            </svg>
                        </button>
                        
                        <div id="theme-menu" class="absolute right-0 mt-3 w-36 rounded-2xl bg-slate-900/90 backdrop-blur-3xl border border-white/10 shadow-2xl hidden z-50 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                            <button onclick="setTheme('light')" class="w-full text-left px-4 py-3 text-sm text-slate-300 hover:bg-white/10 flex items-center gap-3 transition-colors">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Light
                            </button>
                            <button onclick="setTheme('dark')" class="w-full text-left px-4 py-3 text-sm text-slate-300 hover:bg-white/10 flex items-center gap-3 transition-colors">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                Dark
                            </button>
                            <button onclick="setTheme('system')" class="w-full text-left px-4 py-3 text-sm text-slate-300 hover:bg-white/10 flex items-center gap-3 transition-colors">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                System
                            </button>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="group relative inline-flex items-center gap-x-1.5 rounded-xl bg-slate-100 dark:bg-white/5 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white shadow-sm ring-1 ring-inset ring-slate-200 dark:ring-white/10 hover:bg-slate-200 dark:hover:bg-white/10 transition-all duration-300">
                            <svg class="-ml-0.5 h-4 w-4 text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span class="hidden xs:inline">Sign out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10 animate-in fade-in duration-1000">
        <header class="mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
                <h1 class="text-4xl font-bold tracking-tight text-slate-600 dark:text-white mb-2">Dashboard</h1>
                <p class="text-slate-600 dark:text-slate-400">Manage your daily tasks and stay productive.</p>
            </div>
        </header>

        <main>
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Main Content -->
                <div class="space-y-6">
                    
                    @if(session('success'))
                    <div class="animate-in slide-in-from-top-4 duration-500 rounded-2xl bg-emerald-500/10 p-4 border border-emerald-500/20 backdrop-blur-xl">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-emerald-400">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Create Task Card -->
                    <div class="relative group animate-in zoom-in-95 duration-700">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl blur opacity-10 group-hover:opacity-25 transition duration-1000"></div>
                        <div class="relative bg-white dark:bg-slate-900/60 backdrop-blur-3xl p-6 shadow-2xl rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden">
                            <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                                Create New Task
                            </h2>
                            <form action="{{ route('lists.store') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                                @csrf
                                <div class="flex-grow">
                                    <label for="name" class="sr-only">Task Item</label>
                                    <input type="text" name="name" id="name" required autofocus
                                        class="w-full bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-white/10 rounded-xl py-3 px-4 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all duration-300" 
                                        placeholder="What needs to be done?">
                                </div>
                                <button type="submit" 
                                    class="flex-none rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 hover:bg-indigo-500 transition-all duration-300 active:scale-95">
                                    Add Task
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Todo List Card -->
                    <div class="relative animate-in zoom-in-95 duration-700 delay-150">
                        <div class="relative bg-white dark:bg-slate-900/60 backdrop-blur-3xl shadow-2xl rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden">
                            <div class="bg-slate-50 dark:bg-white/5 px-6 py-4 border-t border-slate-200 dark:border-white/5">
                                <p class="text-sm text-slate-500 flex items-center gap-2">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                   Your Task
                                </p>
                            </div>
                            <ul role="list" class="divide-y divide-white/5 max-h-[30vh] overflow-y-auto">
                                @forelse($todos as $todo)
                                    <li class="flex items-center justify-between p-5 hover:bg-white/5 transition-all duration-300 group/item">
                                        <div class="flex items-center gap-4 flex-1">
                                            <div class="relative flex items-center">
                                                <input type="checkbox" onchange="toggleTodo({{ $todo->id }})" {{ $todo->is_done ? 'checked' : '' }} 
                                                    class="h-5 w-5 rounded-lg border-slate-300 dark:border-white/10 bg-slate-50 dark:bg-slate-950/50 text-indigo-600 focus:ring-indigo-500/50 cursor-pointer transition-all">
                                            </div>
                                            
                                            <div class="flex-1">
                                                 <form action="{{ route('lists.update', $todo->id) }}" method="POST" class="w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" id="todo-input-{{ $todo->id }}" name="name" value="{{ $todo->name }}" 
                                                        class="block w-full border-0 p-0 text-slate-800 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:ring-0 sm:text-sm bg-transparent transition-all {{ $todo->is_done ? 'line-through text-slate-400 dark:text-slate-500' : '' }}" 
                                                        onblur="this.form.submit()">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex items-center gap-2 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300">
                                             <form action="{{ route('lists.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg p-2 text-slate-500 hover:text-red-400 hover:bg-red-400/10 transition-all duration-300">
                                                    <span class="sr-only">Delete</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="p-10 text-center text-slate-500 flex flex-col items-center gap-3">
                                        <div class="h-12 w-12 rounded-2xl bg-white/5 flex items-center justify-center text-slate-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p>No tasks yet. Add one above!</p>
                                    </li>
                                @endforelse
                            </ul>
                            
                            <div class="bg-slate-50 dark:bg-white/5 px-6 py-4 border-t border-slate-200 dark:border-white/5">
                                <p class="text-sm text-slate-500 flex items-center gap-2">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                    You have {{ $todos->where('is_done', false)->count() }} pending tasks.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
 const themeToggle = document.getElementById('theme-toggle');
        const themeMenu = document.getElementById('theme-menu');
        const sunIcon = document.getElementById('theme-sun');
        const moonIcon = document.getElementById('theme-moon');
        const systemIcon = document.getElementById('theme-system');

        function updateThemeUI() {
            const theme = localStorage.theme || 'system';
            
            // Hide all icons first
            sunIcon.classList.add('hidden');
            moonIcon.classList.add('hidden');
            systemIcon.classList.add('hidden');

            // Show relevant icon
            if (theme === 'light') {
                sunIcon.classList.remove('hidden');
            } else if (theme === 'dark') {
                moonIcon.classList.remove('hidden');
            } else {
                systemIcon.classList.remove('hidden');
            }
        }

        window.setTheme = function(theme) {
            if (theme === 'system') {
                localStorage.removeItem('theme');
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } else {
                localStorage.theme = theme;
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
            updateThemeUI();
            themeMenu.classList.add('hidden');
        }

        themeToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            themeMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!themeMenu.contains(e.target) && e.target !== themeToggle) {
                themeMenu.classList.add('hidden');
            }
        });

        // Initialize UI
        updateThemeUI();

        function toggleTodo(id) {
            fetch(`/lists/${id}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const input = document.getElementById(`todo-input-${id}`);
                    if (data.is_done) {
                         input.classList.add('line-through', 'text-slate-400', 'dark:text-slate-500');
                         input.classList.remove('text-slate-800', 'dark:text-slate-200');
                    } else {
                         input.classList.remove('line-through', 'text-slate-400', 'dark:text-slate-500');
                         input.classList.add('text-slate-800', 'dark:text-slate-200');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
</script>
</body>
</html>

