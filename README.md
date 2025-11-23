# Laravel 11 Task Manager

A simple, responsive Task Management application built with **Laravel 11**, **Tailwind CSS**, and **Alpine.js**.

## Features

- **Task CRUD**: Create, Read, Update, and Delete tasks.
- **Task Attributes**: Title, Description, Status (Pending, In Progress, Done), Due Date, Priority (Low, Medium, High).
- **Search & Filter**: Search tasks by title and filter by status.
- **Pagination**: Browse tasks easily.
- **Dark Mode**: Toggle between light and dark themes.
- **Responsive Design**: Mobile-first layout using Tailwind CSS.
- **Confirmation**: Deletion requires user confirmation.

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL (or SQLite)

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/muhamad-bari/laravel-task-management.git
    cd laravel-task-management
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies:**
    ```bash
    npm install
    ```

4.  **Configure Environment:**
    Copy `.env.example` to `.env`:
    ```bash
    cp .env.example .env
    ```
    
    Open `.env` and configure your database settings (for MySQL):
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_task_management
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    
    *If you prefer to use SQLite (easier for local testing), set `DB_CONNECTION=sqlite` and remove other DB_ lines. Then create the database file:*
    ```bash
    touch database/database.sqlite
    ```

5.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations:**
    This will create the necessary tables in your database.
    ```bash
    php artisan migrate
    ```

7.  **Seed Database (Optional):**
    Populate the database with dummy tasks.
    ```bash
    php artisan db:seed --class=TaskSeeder
    ```
    *Or just run `php artisan migrate --seed` in the previous step.*

8.  **Build Frontend Assets:**
    ```bash
    npm run build
    ```

## Usage

1.  **Start the development server:**
    ```bash
    php artisan serve
    ```

2.  **Access the application:**
    Open your browser and go to `http://localhost:8000`.

## Directory Structure

-   `app/Models/Task.php`: Eloquent model for Tasks.
-   `app/Http/Controllers/TaskController.php`: Handles request logic.
-   `database/migrations/*_create_tasks_table.php`: Database schema.
-   `resources/views/layouts/app.blade.php`: Main layout.
-   `resources/views/tasks/`: Blade views for Index, Create, Edit.
-   `routes/web.php`: Application routes.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
