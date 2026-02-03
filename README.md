<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Todo List App with Authentication

A modern Todo List application built with Laravel and Tailwind CSS, featuring secure authentication and a responsive user interface.

## 🚀 Features

### ✅ Authentication
- **Secure Login & Registration**: Full auth flow using Laravel session-based authentication.
- **Protected Routes**: Middleware ensures only authenticated users can access their data.
- **Guest Access**: Login and Register pages are only accessible to guests.

### 📝 Todo Management
- **Dashboard**: A clean, modern dashboard to view all your tasks.
- **Create Tasks**: Add new tasks quickly.
- **Update Tasks**: Inline editing for task names.
- **Toggle Status**: Mark tasks as complete/incomplete with a single click.
- **Delete Tasks**: Remove tasks you no longer need.
- **Data Isolation**: Users can only see and manage their own tasks.

### 🎨 Modern UI/UX
- **Tailwind CSS v4**: Built with the latest version of Tailwind for rapid UI development.
- **Responsive Design**: Looks great on desktop and mobile.
- **Interactive Elements**: Hover effects, smooth transitions, and instant feedback (success messages).

## 🛠 Tech Stack

- **Framework**: Laravel 9.x
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS v4
- **Bundler**: Vite
- **Database**: MySQL

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ArRahmaan17/todolist-auth-sanctum.git
   cd todolist-auth-sanctum
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database settings in `.env`*

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Start Development Server**
   You need to run both the Laravel server and Vite for assets:
   ```bash
   # Terminal 1
   php artisan serve

   # Terminal 2
   npm run dev
   ```

7. **Build for Production** (Optional)
   ```bash
   npm run build
   ```
