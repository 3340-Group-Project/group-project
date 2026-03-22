

# Project Setup Instructions

## Project overview
This project is a Laravel 12 web application for a student marketplace / service platform. Based on the current code in this folder, the main features include:

- user sign up and login
- UWindsor email restriction for registration (`@uwindsor.ca`)
- textbook listing creation and management
- image upload for book covers
- service request submission with optional file attachment
- admin dashboard pages for users, books, requests, theme settings, and simple monitoring
- system status page for simple online/offline checks

This README section is written from the actual files in this folder so the setup steps match the current project structure.

## Tech stack
- PHP 8.2 or newer
- Composer
- Laravel 12
- Node.js + npm
- Vite
- MySQL or SQLite
- Laravel public storage for uploaded files

## Database Documentation
- **`users`**: Stores registered user account information, including authentication details and role-based access flags.
- **`books`**: Contains detailed listings of textbooks uploaded by users for sale, including condition, pricing, and course information.
- **`service_requests`**: Holds customer support tickets or inquiries submitted by users, optionally including file attachments.
- **`sessions`**: Manages active user session data, tracking browser information and last activity timestamps for security and session handling.
- **`settings`**: Stores global application configuration key-value pairs, such as theme preferences or site-wide toggles.

erDiagram
    USERS ||--o{ BOOKS : "has many"
    USERS ||--o{ SERVICE_REQUESTS : "has many"
    USERS ||--o{ SESSIONS : "has many (nullable)"

    USERS {
        bigint id PK "unique identifier"
        string name "required"
        string email "unique, required"
        string phone "unique, nullable"
        string password "required"
        boolean is_admin "default false"
        boolean is_disabled "default false"
        timestamp created_at 
        timestamp updated_at
    }

    BOOKS {
        bigint id PK "unique identifier"
        bigint user_id FK "constrained, cascade on delete"
        string title "required"
        string course_code "required"
        string author "nullable"
        string isbn "nullable"
        string format "required"
        string condition "required"
        integer price_cents "required"
        text description "nullable"
        string cover_image_path "required"
        boolean is_sold "default false"
        timestamp created_at 
        timestamp updated_at
    }

    SERVICE_REQUESTS {
        bigint id PK "unique identifier"
        bigint user_id FK "constrained, cascade on delete"
        string subject "required"
        text message "required"
        string attachment_path "nullable"
        timestamp created_at 
        timestamp updated_at
    }

    SESSIONS {
        string id PK "unique session identifier"
        bigint user_id FK "indexed, nullable"
        string ip_address "length 45, nullable"
        text user_agent "nullable"
        longText payload "required"
        integer last_activity "indexed"
    }

    SETTINGS {
        bigint id PK "unique identifier"
        string key "unique"
        string value "nullable"
        timestamp created_at
        timestamp updated_at
    }

## Installation Steps

### 1. Install Required Software 
Make sure these are installed on your machine:
1. **PHP 8.2+**
2. **Composer**
3. **Node.js and npm**
4. **A database system**
   - MySQL is a common choice
   - SQLite also works for simple local testing
5. **Git** if you are cloning/pulling the project from GitHub

#### Check versions
Run these commands in a terminal to confirm your setup:

```bash
php -v
composer --version
node -v
npm -v
```

### 2. Clone or open the project folder
If you already have the folder, open a terminal inside the project root.

Example:

```bash
cd path/to/group-project-master-clean
```

The project root is the folder containing files such as:
- `artisan`
- `composer.json`
- `package.json`
- `.env.example`

### 3. Install backend dependencies
Install the PHP / Laravel packages first:

```bash
composer install
```

This reads `composer.json` and installs all required Laravel dependencies into the `vendor` folder.

### 4. Install frontend dependencies
Install the Node/Vite packages:

```bash
npm install
```

This reads `package.json` and installs the frontend build tools used by the project.

### 5. Create the environment file
If `.env` does not exist yet, copy the example file:

```bash
cp .env.example .env
```

On Windows Command Prompt, use:

```bash
copy .env.example .env
```

Then generate the Laravel application key:

```bash
php artisan key:generate
```

### 6. Configure the database
Open the `.env` file and set your database connection.

#### Option A: MySQL
Example `.env` values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=group_project
DB_USERNAME=root
DB_PASSWORD=
```

Before running migrations, make sure the database named above already exists in MySQL.

#### Option B: SQLite
If you want a simple local setup, SQLite is fine.

1. Make sure the file exists:

```bash
mkdir -p database
```

2. Create the SQLite file if needed:

```bash
type nul > database/database.sqlite
```

If you are not on Windows, you can use:

```bash
touch database/database.sqlite
```

3. Update `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 7. Run database migrations
This project uses Laravel migrations to create the required tables.

Run:

```bash
php artisan migrate
```

Based on the current files in `database/migrations`, this should create tables for:
- users
- books
- sessions
- settings
- service requests
- admin / disabled user flags on users

#### Important note
Your current project already includes a migration for:
- `is_admin`
- `is_disabled`

So make sure migration runs successfully, otherwise admin role toggling and disabling users will not work correctly.

### 8. Seed sample data (optional but helpful)
This project includes a `BookSeeder` that inserts sample book listings.

Run:

```bash
php artisan db:seed
```

This helps you test the book listing pages faster after setup.

### 9. Create the storage symlink
This project stores uploaded files on the `public` disk. That includes items like:
- book cover images
- request attachments
- simple storage checks used by the monitoring page

Run:

```bash
php artisan storage:link
```

This creates the `public/storage` link so uploaded files can be accessed correctly from the browser.

### 10. Build frontend assets
For a one-time production-style build:

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

Keep `npm run dev` running in its own terminal while developing.

### 11. Start the Laravel server
In another terminal, run:

```bash
php artisan serve
```

Then open the local URL shown in the terminal, usually:

```text
http://127.0.0.1:8000
```

### 12. Full quick-start command order
If you want the basic setup in order, these are the main commands:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
php artisan serve
```

For Windows Command Prompt, replace `cp` with `copy`.

### 13. How to log in and test the project
#### Register a user
The registration code currently requires a **UWindsor email address**, so use an email ending with:

```text
@uwindsor.ca
```

If you try to register with another domain, the form validation will reject it.

#### Test normal user features
After signing in, you can test:
1. creating a book listing
2. editing your own listing
3. marking a listing as sold
4. deleting your own listing
5. creating a service request
6. viewing your own listings and requests

### 14. How to set an admin user
This project includes admin pages under `/admin`.

The cleanest way to make a user an admin in a local setup is to update the `is_admin` field in the database after that user registers.

#### Option A: Use Laravel Tinker
Run:

```bash
php artisan tinker
```

Then run something like:

```php
$user = App\Models\User::where('email', 'yourname@uwindsor.ca')->first();
$user->is_admin = true;
$user->save();
```

Then visit:

```text
/admin
```

#### Option B: Update directly in your database tool
You can also manually set:

```text
is_admin = 1
```

for the user row you want to use as admin.

### 15. Admin features currently in the project
Based on the files in this folder, the admin area includes pages for:
- dashboard
- user listings / user management
- book listings moderation
- service request review / response
- theme settings
- simple system monitoring

### 16. Monitoring / website status
This project now includes a simple monitoring feature.

#### Admin dashboard monitoring
The admin dashboard shows whether the website is considered:
- **ONLINE**
- **OFFLINE**

This is based on simple checks such as:
- database connection
- public storage availability

#### Public status page
There is also a status page route:

```text
/status
```

This page reports the result of simple checks such as:
- database connection
- public storage write/delete test
- theme setting access

### 17. Common setup issues and fixes
#### Problem: `Class ... not found` or autoload issues
Run:

```bash
composer dump-autoload
```

#### Problem: migrations fail
Check:
1. your `.env` database settings
2. your database actually exists
3. your database service is running

Then retry:

```bash
php artisan migrate
```

#### Problem: images or attachments do not load
Make sure you ran:

```bash
php artisan storage:link
```

#### Problem: Vite/CSS/JS does not load
Make sure you either:
- run `npm run dev` during development, or
- run `npm run build` for built assets

#### Problem: login/registration does not work for your email
Make sure the email ends with:

```text
@uwindsor.ca
```

#### Problem: disabled/admin toggle does not seem to work
Make sure the latest migrations were run:

```bash
php artisan migrate
```

This is required so the `users` table includes the `is_admin` and `is_disabled` columns used by the current code.

### 18. Useful Laravel commands for this project
```bash
php artisan serve
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
npm install
npm run dev
npm run build
```

### 19. Suggested first-time setup checklist
Use this checklist when setting up on a new machine:

1. clone/download the project
2. open terminal in project root
3. run `composer install`
4. run `npm install`
5. create `.env`
6. run `php artisan key:generate`
7. configure database in `.env`
8. run `php artisan migrate`
9. run `php artisan db:seed`
10. run `php artisan storage:link`
11. run `npm run build` or `npm run dev`
12. run `php artisan serve`
13. register a user with an `@uwindsor.ca` email
14. promote that user to admin if admin testing is needed
15. test `/admin` and `/status`

### 20. Notes for teammates
- Do not commit your personal `.env` file.
- Make sure everyone runs migrations before testing features.
- If someone pulls new migration files, they should run `php artisan migrate` again.
- If uploaded images/files are missing, check the storage link.
- If the admin pages behave strangely, confirm the test account has `is_admin = 1` in the database.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>