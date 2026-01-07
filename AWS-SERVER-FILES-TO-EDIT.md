# AWS Server Configuration Files for 50MB Upload Support

## File 1: /etc/php.ini (or your php.ini location)

Find these settings and update them to:

```ini
upload_max_filesize = 50M
post_max_size = 50M
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
max_input_vars = 5000
```

---

## File 2: /etc/nginx/nginx.conf (Global)

In the `http` block, add or update:

```nginx
http {
    client_max_body_size 50M;
    
    # ... rest of config
}
```

---

## File 3: /etc/nginx/sites-available/your-site.conf (Site-Specific)

In the `server` block, add:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    
    root /var/www/your-app/public;
    
    # Increase body size limit for uploads
    client_max_body_size 50M;
    
    # Custom error pages
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
    
    # Laravel routing
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

---

## Quick Edit Commands for AWS Server

```bash
# 1. Edit PHP config
sudo nano /etc/php.ini

# Find and update (Ctrl+W to search):
# upload_max_filesize = 50M
# post_max_size = 50M
# memory_limit = 256M

# Save: Ctrl+X, Y, Enter

# 2. Edit Nginx global config
sudo nano /etc/nginx/nginx.conf

# Add to http block: client_max_body_size 50M;
# Save: Ctrl+X, Y, Enter

# 3. Edit site config
sudo nano /etc/nginx/sites-available/default
# or
sudo nano /etc/nginx/sites-available/your-site.conf

# Add the server block settings above
# Save: Ctrl+X, Y, Enter

# 4. Test Nginx
sudo nginx -t

# 5. Reload services
sudo systemctl reload nginx
sudo systemctl restart php-fpm

# 6. Verify
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL;"
```

