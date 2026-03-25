<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Todo List App with Sanctum Authentication

A modern Todo List and Library management application built with Laravel 10, featuring secure Sanctum-based API authentication and a responsive user interface.

## 🚀 Features

### ✅ Authentication
- **Sanctum-based API Auth**: Secure token-based authentication for API requests.
- **Secure Login & Registration**: Full authentication flow for both Web and API.
- **Protected Routes**: Middleware ensures only authenticated users can access their data.

### 📝 Todo Management
- **Dashboard**: A clean, modern dashboard to view all your tasks.
- **Full CRUD Support**: Create, read, update, and delete tasks.
- **Toggle Status**: Mark tasks as complete/incomplete instantly.
- **Data Isolation**: Users only see and manage their own tasks.

### 📚 Library & Books Management
- **Library API**: Manage libraries and search by name or address.
- **Books & Authors**: Organize books with dedicated categories and author management.

### 🎨 Modern UI/UX
- **Tailwind CSS**: Built with modern Tailwind for rapid UI development.
- **Responsive Design**: Optimized for both desktop and mobile.
- **Interactive Elements**: Smooth transitions and instant feedback.

### 📖 API Documentation
- **Swagger Integration**: Interactive API documentation available at `/api/documentation`.

## 🛠 Tech Stack

- **Framework**: Laravel 10.x
- **Authentication**: Laravel Sanctum
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS
- **Bundler**: Vite
- **Database**: MySQL
- **API Docs**: L5-Swagger

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ArRahmaan17/todolist-auth-sanctum.git
   cd todolist-auth-sanctum
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database settings in `.env`*

4. **Run Migrations**
   ```bash
   php artisan migrate:fresh
   ```

5. **Start Development Server**
   ```bash
   # Terminal 1
   php artisan serve

   # Terminal 2
   npm run dev
   ```

## 🧪 Testing

The project includes comprehensive feature tests for Authentication and Todo management.

Run tests using Artisan:
```bash
php artisan test
```

Or using PHPUnit:
```bash
./vendor/bin/phpunit
```

## 📜 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST   | `/api/registration` | Register a new user |
| POST   | `/api/login` | Login and get Bearer Token |
| POST   | `/api/logout` | Revoke current token |
| GET    | `/api/todos` | List all user todos |
| POST   | `/api/todos` | Create a new todo |
| GET    | `/api/todos/{id}` | Show specified todo |
| PUT    | `/api/todos/{id}` | Update specified todo |
| DELETE | `/api/todos/{id}` | Delete specified todo |
| GET    | `/api/library` | List all libraries |
| GET    | `/api/author` | List all authors |
| GET    | `/api/books` | List all books |
