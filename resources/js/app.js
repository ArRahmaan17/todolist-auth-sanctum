import './bootstrap';

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