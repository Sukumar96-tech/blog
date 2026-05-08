# BlogHub - Render Deployment Guide

This guide provides step-by-step instructions for deploying BlogHub to Render.

## Prerequisites

- Render account (free or paid)
- GitHub account with repository pushed
- MySQL database
- Basic command-line knowledge

## Step 1: Prepare Your Repository

1. **Ensure .env is not committed**
   ```bash
   git status | grep .env
   # Should show no .env file
   ```

2. **Push all changes to GitHub**
   ```bash
   git add .
   git commit -m "Final: Complete blog system implementation"
   git push origin main
   ```

## Step 2: Create Database on Render

1. Go to [Render Dashboard](https://dashboard.render.com/)
2. Click **New +** → **MySQL Database**
3. Fill in:
   - **Name**: `bloghub-db`
   - **Database**: `bloghub`
   - **Username**: `bloghub_user`
   - **Password**: Generate strong password
4. Note the internal/external connection strings
5. Click **Create Database**
6. Wait for database to be ready (2-3 minutes)

## Step 3: Create Web Service on Render

1. From Dashboard, click **New +** → **Web Service**
2. Connect your GitHub repository
3. Fill in configuration:
   - **Name**: `bloghub`
   - **Environment**: `Docker`
   - **Region**: Choose closest to you
   - **Branch**: `main`

4. Click **Create Web Service**

## Step 4: Configure Environment Variables

In the Web Service settings, go to **Environment**:

Add the following environment variables:

```
APP_NAME=BlogHub
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.onrender.com
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXX

DB_CONNECTION=mysql
DB_HOST=[MySQL service host from Render]
DB_PORT=3306
DB_DATABASE=bloghub
DB_USERNAME=bloghub_user
DB_PASSWORD=[Your MySQL password]

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_DRIVER=file
FILESYSTEM_DISK=public

LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### To generate APP_KEY:

If your repository doesn't have APP_KEY set, run locally:

```bash
php artisan key:generate --show
# Copy the output (after "base64:")
```

## Step 5: Configure Build and Start Commands

In Web Service settings, go to **Build Command**:

```bash
composer install && \
cp .env.example .env || true && \
php artisan key:generate --force && \
php artisan migrate --force && \
php artisan storage:link || true
```

In **Start Command**:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## Step 6: Deploy

1. Click **Manual Deploy** or wait for auto-deploy on push
2. Watch the logs for any errors
3. Wait for "Service is live at" message

## Step 7: Initialize Data

Once deployed, you can seed data:

1. Go to Web Service **Shell**
2. Run:
   ```bash
   php artisan db:seed
   ```

This creates admin users:
- Email: `admin@bloghub.com` | Password: `password123`
- Email: `test@bloghub.com` | Password: `test123`

## Step 8: Verify Deployment

1. Visit your URL (e.g., `https://bloghub.onrender.com`)
2. Check homepage loads correctly
3. Try admin login: `admin@bloghub.com` / `password123`
4. Create a test blog post
5. Verify filtering and search work

## Troubleshooting

### Sessions Not Persisting

**Problem**: User logs out randomly or session data lost

**Solution**:
1. Set `SESSION_DRIVER=file` in environment
2. Ensure `/storage` directory is writable
3. Check storage/framework/sessions exists
4. Restart Web Service

### Database Connection Failed

**Problem**: "Can't connect to MySQL"

**Solution**:
1. Verify DB credentials in Environment variables
2. Check database is in "Available" status on Render
3. Ensure DB_HOST is the internal host (not external)
4. Manually run migration:
   ```bash
   # In Shell
   php artisan migrate --force
   ```

### Images Not Uploading

**Problem**: Images upload but don't display

**Solution**:
1. Run from Shell:
   ```bash
   php artisan storage:link
   ```
2. Upload fresh image
3. Check `/storage/uploads` directory exists
4. Verify permissions: `chmod -R 775 storage`

### Static Assets (CSS/JS) Not Loading

**Problem**: Page loads but unstyled

**Solution**:
1. Set `APP_DEBUG=false` in production
2. Clear cache:
   ```bash
   # In Shell
   php artisan cache:clear
   ```
3. Rebuild and redeploy

### 500 Error After Deploy

**Problem**: Application crash

**Solution**:
1. Check logs from Render Dashboard
2. SSH into Web Service Shell
3. Run:
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```
4. If still failing, restore from backup and check build command

## Performance Optimization

### Enable Caching

Add to environment:
```
CACHE_DRIVER=redis
REDIS_URL=redis://[host]:[port]
```

### Database Optimization

Add database index for categories:
```bash
# In Shell
php artisan tinker
DB::statement('CREATE INDEX idx_category ON blogs(category)');
```

## Monitoring & Maintenance

### View Logs

From Web Service, view real-time logs:
- Application errors appear automatically
- Check for 500 errors, warnings

### Monitor Database

From MySQL service:
- Check connections
- Monitor storage usage
- View query stats

### Backup Database

Regular automated backups available in Render dashboard:
1. Go to MySQL service
2. Check **Backups** tab
3. Enable automatic backups (recommended)

## Updating Your Application

1. Make changes locally
2. Test thoroughly
3. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Update: [description]"
   git push origin main
   ```
4. Render automatically redeploys
5. Monitor logs to ensure successful deployment

## Custom Domain

1. From Web Service settings, go to **Custom Domain**
2. Add your domain
3. Follow Render's DNS instructions
4. Update APP_URL in environment variables:
   ```
   APP_URL=https://yourdomain.com
   ```
5. Restart Web Service

## SSL/TLS Certificate

Automatically provided by Render for:
- `*.onrender.com` domains
- Custom domains via Let's Encrypt

## Security Checklist

- [ ] APP_DEBUG=false in production
- [ ] Strong database password
- [ ] APP_KEY is set and unique
- [ ] CSRF protection enabled
- [ ] Sessions over HTTPS
- [ ] Database backups enabled
- [ ] Admin credentials changed from defaults
- [ ] Content Security Policy headers configured

## Support & Resources

- [Render Documentation](https://render.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/deployment)
- [MySQL on Render](https://render.com/docs/deploy-mysql)
- [Environment Variables](https://render.com/docs/configure-environment-variables)

## Emergency: Rollback

If deployment fails:

1. From Web Service, click **Suspend Service**
2. Fix the issue locally
3. Push fix to repository
4. Click **Resume**
5. Manual redeploy if needed

---

**Deployment by BlogHub Team**
Last Updated: 2024
