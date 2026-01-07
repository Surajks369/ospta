# AWS Server Configuration for Large File Uploads

## Quick Setup (Recommended)

If you have EC2 SSH access, run this automated script:

```bash
# SSH into your EC2 instance
ssh -i your-key.pem ec2-user@your-server-ip

# Download and run setup script
curl -O https://your-domain/aws-server-setup.sh
chmod +x aws-server-setup.sh
./aws-server-setup.sh
```

---

## Manual Setup (If Automated Script Doesn't Work)

### Step 1: Update PHP Configuration

```bash
# SSH into your server
ssh -i your-key.pem ec2-user@your-server-ip

# Find your php.ini file
php -r "echo php_ini_loaded_file();"

# Edit php.ini (replace path if different)
sudo nano /etc/php.ini
# or
sudo nano /etc/php/8.1/fpm/php.ini

# Update these values:
upload_max_filesize = 50M
post_max_size = 50M
memory_limit = 256M

# Save and exit (Ctrl+X, then Y, then Enter)
```

### Step 2: Update Nginx Configuration

**Option A: Global Nginx Setting**
```bash
# Edit main nginx config
sudo nano /etc/nginx/nginx.conf

# In the 'http' block, add:
http {
    client_max_body_size 50M;
    # ... rest of config
}
```

**Option B: Site-Specific Setting**
```bash
# Edit your site config
sudo nano /etc/nginx/sites-available/your-site.conf
# or
sudo nano /etc/nginx/conf.d/your-site.conf

# In the 'server' block, add:
server {
    listen 80;
    server_name your-domain.com;
    
    client_max_body_size 50M;
    
    root /var/www/your-app/public;
    
    error_page 413 /errors/413.html;
    error_page 500 502 503 504 /errors/500.html;
    
    location = /errors/413.html {
        internal;
        root /var/www/your-app/public;
    }
    location = /errors/500.html {
        internal;
        root /var/www/your-app/public;
    }
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### Step 3: Validate and Reload Nginx

```bash
# Test configuration
sudo nginx -t

# If OK, reload
sudo systemctl reload nginx

# Check status
sudo systemctl status nginx
```

### Step 4: Restart PHP-FPM

```bash
# Find which PHP version
php -v

# Restart (pick one based on version)
sudo systemctl restart php-fpm
# or
sudo systemctl restart php8.1-fpm
# or
sudo systemctl restart php8.0-fpm
```

### Step 5: Verify Error Pages Exist

Make sure these files are in your project's `public/errors/` directory on the server:
- `/var/www/your-app/public/errors/413.html`
- `/var/www/your-app/public/errors/500.html`

If they don't exist, create them:

```bash
sudo mkdir -p /var/www/your-app/public/errors

# Create 413.html
sudo tee /var/www/your-app/public/errors/413.html > /dev/null <<'EOF'
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>413 Request Entity Too Large</title>
  <style>body{font-family:Arial,sans-serif;background:#f8f9fa;color:#212529;text-align:center;padding:60px}a{color:#0d6efd}</style>
</head>
<body>
  <h1 style="color:#c00">413 — Request Entity Too Large</h1>
  <p>The file you tried to upload exceeds the server's allowed size. Maximum allowed size is 50 MB.</p>
  <p>Please reduce the file size and try again, or contact your administrator.</p>
  <p><a href="/">Return Home</a></p>
</body>
</html>
EOF

# Create 500.html
sudo tee /var/www/your-app/public/errors/500.html > /dev/null <<'EOF'
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>500 Server Error</title>
  <style>body{font-family:Arial,sans-serif;background:#f8f9fa;color:#212529;text-align:center;padding:60px}a{color:#0d6efd}</style>
</head>
<body>
  <h1 style="color:#c00">500 — Server Error</h1>
  <p>Something went wrong on the server. Please try again later or contact support.</p>
  <p><a href="/">Return Home</a></p>
</body>
</html>
EOF
```

---

## Elastic Beanstalk Deployment

If you're using AWS Elastic Beanstalk, the configuration files are already in your project:
- `.platform/nginx/conf.d/client_max_body_size.conf`
- `.platform/nginx/conf.d/error_pages.conf`

Just commit and deploy:
```bash
git add .
git commit -m "Update Nginx and PHP config for large file uploads"
git push
eb deploy
```

---

## Verification

After applying changes, test:

```bash
# 1. Upload a test file >2MB through the admin gallery
# Expected: Either validation message or friendly error page (not raw 413)

# 2. Check logs
tail -f /var/log/nginx/error.log
tail -f /path/to/laravel/storage/logs/laravel.log

# 3. Verify configuration
sudo nginx -s reload  # Reload config
php -i | grep -E "upload_max_filesize|post_max_size"  # Check PHP settings
```

---

## If You Still Get 413 Errors

1. **AWS ALB/NLB** - Check if your load balancer has request limits:
   - Go to Target Group → Edit attributes
   - Check `deregistration_delay.timeout_seconds` and other connection settings

2. **Security Groups** - Ensure your security group allows HTTP/HTTPS traffic

3. **Nginx error log** - Check for specific errors:
   ```bash
   sudo tail -50 /var/log/nginx/error.log
   ```

4. **Check Laravel logs** - If request reached Laravel:
   ```bash
   tail -50 /path/to/laravel/storage/logs/laravel.log
   ```

---

## File Locations Reference

| Item | Path |
|------|------|
| Nginx main config | `/etc/nginx/nginx.conf` |
| Nginx site config | `/etc/nginx/sites-available/your-site.conf` or `/etc/nginx/conf.d/your-site.conf` |
| PHP ini | `/etc/php.ini` or `/etc/php/8.1/fpm/php.ini` |
| PHP-FPM config | `/etc/php-fpm.d/` or `/etc/php/8.1/fpm/pool.d/` |
| Laravel app | `/var/www/your-app/` or `/home/ec2-user/your-app/` |
| Error pages | `/var/www/your-app/public/errors/` |
| Laravel logs | `/var/www/your-app/storage/logs/laravel.log` |

---

## Support

If you encounter issues:
1. Check server logs (see above)
2. Verify error page files exist at `/var/www/your-app/public/errors/`
3. Test Nginx config: `sudo nginx -t`
4. Ensure Laravel middleware and client-side validation are enabled
