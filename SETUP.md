# BlogHub - Quick Setup Guide

Get BlogHub running on your local machine in 5 minutes!

## Quick Start (Without Docker)

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js (optional)

### Steps

```bash
# 1. Clone and install
git clone <repository-url>
cd blog-system
composer install

# 2. Configure environment
cp .env.example .env
php artisan key:generate

# 3. Setup database in .env
# Edit .env and set:
# DB_DATABASE=bloghub
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Run migrations and seed
php artisan migrate
php artisan db:seed

# 5. Create storage link
php artisan storage:link

# 6. Start server
php artisan serve
```

Visit: **http://localhost:8000**

### Admin Login
- Email: `admin@bloghub.com`
- Password: `password123`

---

## Quick Start (With Docker)

### Prerequisites
- Docker
- Docker Compose

### Steps

```bash
# 1. Clone and setup
git clone <repository-url>
cd blog-system

# 2. Build and run containers
docker-compose up -d

# 3. Install PHP dependencies
docker-compose exec app composer install

# 4. Setup environment
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan key:generate

# 5. Run migrations
docker-compose exec app php artisan migrate

# 6. Seed sample data
docker-compose exec app php artisan db:seed

# 7. Create storage link
docker-compose exec app php artisan storage:link
```

Visit: **http://localhost**

### Admin Login
- Email: `admin@bloghub.com`
- Password: `password123`

---

## Database Credentials (Docker)

- **Host**: `db` (or `127.0.0.1`)
- **Port**: 3306
- **Database**: bloghub
- **Username**: bloghub_user
- **Password**: bloghub_password
- **Root Password**: root_password

---

## Useful Commands

### Development
```bash
# Clear cache
php artisan cache:clear

# Re-run migrations
php artisan migrate:refresh

# Seed data
php artisan db:seed

# Reset everything
php artisan migrate:fresh --seed
```

### Docker Commands
```bash
# View logs
docker-compose logs -f app

# SSH into container
docker-compose exec app bash

# Artisan command
docker-compose exec app php artisan [command]

# Restart containers
docker-compose restart

# Stop containers
docker-compose down

# Remove all (including volumes)
docker-compose down -v
```

---

## File Locations

- **Frontend Views**: `resources/views/`
- **Admin Views**: `resources/views/admin/`
- **Controllers**: `app/Http/Controllers/`
- **Routes**: `routes/web.php`
- **Database**: `database/migrations/` & `database/seeders/`
- **Public Assets**: `public/`
- **Storage**: `storage/`

---

## Common Issues

### Port 8000 Already in Use
```bash
php artisan serve --port 8001
```

### Database Connection Error
Check `.env` database settings, ensure MySQL is running

### Storage Link Error
```bash
php artisan storage:link --force
```

### Permission Denied
```bash
chmod -R 775 storage bootstrap/cache
```

### Class Not Found
```bash
composer dump-autoload
```

---

## Next Steps

1. ✅ Access http://localhost:8000
2. ✅ Create test blog posts
3. ✅ Test filtering and search
4. ✅ Modify designs in `resources/views/`
5. ✅ Deploy to Render (see DEPLOYMENT.md)

---

**Happy blogging! 🚀**
