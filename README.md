# BlogHub - Blog Management System

A complete, production-ready Blog Management System built with Laravel 9+, MySQL, Bootstrap 5, and jQuery AJAX.

![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)
![Laravel 9+](https://img.shields.io/badge/Laravel-9%2B-redD)
![PHP 8.1+](https://img.shields.io/badge/PHP-8.1%2B-blue)

## Features

### Frontend Features
- **Responsive Homepage** - Display all blogs with beautiful cards
- **Blog Detail Page** - View complete blog content with related blogs
- **Dynamic Filtering** - Filter blogs by category without page reload
- **Date Range Filtering** - Filter blogs by date range
- **Search Functionality** - Search blogs by title, description, or content
- **Mobile Optimized** - Fully responsive design using Bootstrap 5
- **AJAX-Powered** - jQuery AJAX for seamless filtering and searching

### Admin Panel Features
- **Secure Login System** - Session-based authentication
- **Blog Management** - Create, read, update, delete blogs
- **Image Upload** - Upload and manage blog images
- **Dashboard** - View all blogs at a glance
- **Form Validation** - Server-side validation with user feedback
- **Responsive Admin Interface** - Modern admin dashboard

### Technical Features
- **Laravel 9+** - Latest Laravel framework
- **Blade Templating** - Elegant template engine
- **Eloquent ORM** - Database abstraction layer
- **CSRF Protection** - Built-in security
- **Session Management** - Secure session handling
- **Docker Support** - Deployment-ready Dockerfile
- **Docker Compose** - Local development setup
- **MySQL Database** - Reliable data storage

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js (optional, for Vite)

## Installation

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd blog-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bloghub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed sample data**
   ```bash
   php artisan db:seed
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit http://localhost:8000

### Docker Setup

1. **Build and run with Docker Compose**
   ```bash
   docker-compose up -d
   ```

2. **Run migrations inside container**
   ```bash
   docker-compose exec app php artisan migrate
   ```

3. **Seed data**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

4. **Create storage symlink**
   ```bash
   docker-compose exec app php artisan storage:link
   ```

Visit http://localhost in your browser

## Default Admin Credentials

**Email:** `admin@bloghub.com`
**Password:** `password123`

Or use:
**Email:** `test@bloghub.com`
**Password:** `test123`

## Project Structure

```
blog-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomePageController.php
│   │   │   └── Admin/
│   │   │       ├── AuthController.php
│   │   │       └── AdminBlogController.php
│   │   ├── Middleware/
│   │   │   └── CheckAdminSession.php
│   │   └── Kernel.php
│   └── Models/
│       ├── Blog.php
│       └── Admin.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── AdminSeeder.php
│   │   ├── BlogSeeder.php
│   │   └── DatabaseSeeder.php
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── admin.blade.php
│   │   ├── admin/
│   │   │   ├── blog/
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── form.blade.php
│   │   │   ├── dashboard.blade.php
│   │   │   └── login.blade.php
│   │   ├── partials/
│   │   │   └── blog_cards.blade.php
│   │   ├── home.blade.php
│   │   └── blog_detail.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php
│   └── api.php
├── public/
│   ├── js/
│   │   └── blog-ajax.js
│   └── storage/
├── config/
├── storage/
├── tests/
├── composer.json
├── phpunit.xml
├── Dockerfile
├── docker-compose.yml
├── .dockerignore
├── .env.example
├── .gitignore
└── README.md
```

## Routes

### Frontend Routes
- `GET /` - Home page (all blogs)
- `GET /blog/{id}` - Blog detail page
- `GET /filter-category` - Filter by category (AJAX)
- `GET /filter-date` - Filter by date (AJAX)
- `GET /search` - Search blogs (AJAX)

### Admin Routes
- `GET /admin/login` - Admin login page
- `POST /admin/login` - Handle login
- `GET /admin/dashboard` - Admin dashboard (protected)
- `GET /admin/blog/create` - Create blog form (protected)
- `POST /admin/blog/store` - Store new blog (protected)
- `GET /admin/blog/{id}/edit` - Edit blog form (protected)
- `POST /admin/blog/{id}/update` - Update blog (protected)
- `DELETE /admin/blog/{id}` - Delete blog (protected)
- `GET /admin/logout` - Logout (protected)

## Database Schema

### admins table
```sql
id (Primary Key)
name (String)
email (String, Unique)
password (String)
created_at (Timestamp)
updated_at (Timestamp)
```

### blogs table
```sql
id (Primary Key)
title (String)
short_description (Text)
content (Long Text)
category (String)
image (String, Nullable)
created_at (Timestamp)
updated_at (Timestamp)
```

## AJAX Features

### Category Filtering
```javascript
// Triggered by category select change
$.ajax({
    url: '/filter-category',
    data: { category: categoryValue },
    success: function(response) {
        $('#blogContainer').html(response);
    }
});
```

### Date Range Filtering
```javascript
// Triggered by date input change
$.ajax({
    url: '/filter-date',
    data: { start_date: date, end_date: date },
    success: function(response) {
        $('#blogContainer').html(response);
    }
});
```

### Search Functionality
```javascript
// Triggered with debounce on search input
$.ajax({
    url: '/search',
    data: { q: searchQuery },
    success: function(response) {
        $('#blogContainer').html(response);
    }
});
```

## Deployment on Render

### Prerequisites
- Render account
- GitHub repository

### Deployment Steps

1. **Push to GitHub**
   ```bash
   git add .
   git commit -m "Initial commit"
   git push origin main
   ```

2. **Create Web Service on Render**
   - Connect GitHub repository
   - Set Environment:
     - `APP_NAME`: BlogHub
     - `APP_ENV`: production
     - `APP_DEBUG`: false
     - `APP_KEY`: (generate new)
     - `APP_URL`: your-site.onrender.com
     - Database credentials

3. **Configure Build Command**
   ```bash
   composer install && php artisan migrate --force && php artisan storage:link
   ```

4. **Configure Start Command**
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

### Database Setup on Render
1. Create MySQL database on Render
2. Update `.env` with database credentials
3. Run migrations after deployment

## Security Features

- **CSRF Protection** - Laravel CSRF token middleware
- **Session-based Authentication** - Secure session handling
- **Password Hashing** - Bcrypt password hashing
- **Input Validation** - Server-side form validation
- **SQL Injection Prevention** - PDO prepared statements (Eloquent)
- **XSS Protection** - Blade template escaping

## Performance Optimization

- **Database Pagination** - Efficient data loading
- **AJAX Filtering** - No page reloads
- **Image Optimization** - Responsive images
- **Caching** - Laravel cache driver
- **Query Optimization** - Eloquent relationships

## Troubleshooting

### Sessions not persisting on Render
- Ensure `SESSION_DRIVER` is set to `file` or use `cookie`
- Check storage permissions: `chmod -R 775 storage`

### Images not uploading
- Verify `storage/app/public` directory exists
- Run: `php artisan storage:link`
- Check file permissions

### Database connection errors
- Verify database credentials in `.env`
- Ensure database exists
- Run: `php artisan migrate`

### CSRF token mismatch
- Clear browser cookies
- Ensure forms include `@csrf` directive
- Check session.php config

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-source software licensed under the [MIT license](LICENSE).

## Support

For support, email support@bloghub.com or create an issue in the repository.

## Credits

Built with:
- **Laravel 9+** - Web framework
- **Bootstrap 5** - CSS framework
- **jQuery** - JavaScript library
- **MySQL** - Database

## Changelog

### Version 1.0.0 (Initial Release)
- Complete blog management system
- Frontend with AJAX filtering
- Admin panel with CRUD operations
- Docker deployment ready
- Session-based authentication

---

**Created with ❤️ by the BlogHub Team**


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
