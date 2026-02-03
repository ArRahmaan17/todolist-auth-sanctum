<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'Todo List') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-slate-600 font-sans antialiased">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                         <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="ml-3 font-bold text-xl text-slate-800 tracking-tight">Todo App</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                         <span class="mr-4 text-sm text-slate-500">
                            Hello, <span class="font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="relative inline-flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-all">
                                <svg class="-ml-0.5 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight tracking-tight text-slate-900">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Main Content -->
                <div class="px-4 py-8 sm:px-0">
                    
                    @if(session('success'))
                    <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white shadow-sm rounded-lg border border-slate-200 overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-medium leading-6 text-slate-900 mb-4">Create New Task</h2>
                            <form action="{{ route('lists.store') }}" method="POST" class="flex gap-4">
                                @csrf
                                <div class="flex-grow">
                                    <label for="name" class="sr-only">Task Item</label>
                                    <input type="text" name="name" id="name" class="block w-full pl-2 rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all" placeholder="What needs to be done?" required autofocus>
                                </div>
                                <button type="submit" class="flex-none rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                                    Add Task
                                </button>
                            </form>
                        </div>
                        
                        <div class="border-t border-slate-200">
                            <ul role="list" class="divide-y divide-slate-200">
                                @forelse($todos as $todo)
                                    <li class="flex items-center justify-between p-6 hover:bg-slate-50 transition-colors group">
                                        <div class="flex items-center gap-4 flex-1">
                                            <input type="checkbox" onchange="toggleTodo({{ $todo->id }})" {{ $todo->is_done ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer transition-all">
                                            
                                            <div class="flex-1">
                                                 <form action="{{ route('lists.update', $todo->id) }}" method="POST" class="w-full">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" id="todo-input-{{ $todo->id }}" name="name" value="{{ $todo->name }}" class="block w-full border-0 p-0 text-slate-900 placeholder:text-slate-400 focus:ring-0 sm:text-sm sm:leading-6 bg-transparent {{ $todo->is_done ? 'line-through text-slate-400' : '' }}" onblur="this.form.submit()">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                             <form action="{{ route('lists.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded p-1 text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                                    <span class="sr-only">Delete</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                      <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="p-6 text-center text-slate-500">
                                        No tasks yet. Add one above!
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                            <p class="text-sm text-slate-500">
                                You have {{ $todos->where('is_done', false)->count() }} pending tasks.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
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
                         input.classList.add('line-through', 'text-slate-400');
                    } else {
                         input.classList.remove('line-through', 'text-slate-400');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
