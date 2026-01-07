# Complete Setup Guide: 50MB File Upload Support

## Summary of Changes Made

Your project has been updated to support uploading files up to **50MB** with proper validation and error messages displayed inline on the form.

---

## Files Modified

| File | Change |
|------|--------|
| [config/gallery.php](config/gallery.php) | Changed max_upload_mb from 10 to 50 |
| [app/Http/Controllers/Admin/GalleryController.php](app/Http/Controllers/Admin/GalleryController.php) | Updated validation: max:51200 (50MB) |
| [resources/views/admin/galleries/create.blade.php](resources/views/admin/galleries/create.blade.php) | Enhanced form with real-time file validation |
| [resources/views/admin/galleries/edit.blade.php](resources/views/admin/galleries/edit.blade.php) | Enhanced form with real-time file validation |

---

## Local Setup (XAMPP)

### Step 1: Update php.ini

1. **Find php.ini:**
   ```bash
   php -r "echo php_ini_loaded_file();"
   ```
   Output: `C:\xampp\php\php.ini`

2. **Open in Notepad or VS Code:**
   - Right-click → Edit with Code

3. **Find and update these settings:**
   ```ini
   upload_max_filesize = 50M
   post_max_size = 50M
   memory_limit = 256M
   max_execution_time = 300
   max_input_time = 300
   max_input_vars = 5000
   ```

4. **Save the file**

5. **Restart Apache from XAMPP Control Panel**

### Step 2: Test Locally

1. Go to: `http://localhost/ospta/admin/galleries/create`
2. Try uploading an image > 2MB
3. Expected: Real-time validation message appears below file input with file size info
4. Expected: No form page reload, just validation message

---

## AWS Server Setup

### **Option A: Automated Setup (Recommended)**

SSH into your AWS server:

```bash
# Download and run the setup script
curl -O https://your-domain/aws-update-php.sh
chmod +x aws-update-php.sh
sudo bash aws-update-php.sh
```

Then manually update Nginx (see Option B).

### **Option B: Manual Setup**

#### Step 1: Update PHP

```bash
# Find php.ini
php -r "echo php_ini_loaded_file();"

# Edit php.ini (usually /etc/php.ini or /etc/php/8.1/fpm/php.ini)
sudo nano /etc/php.ini

# Update these 6 settings:
upload_max_filesize = 50M
post_max_size = 50M
memory_limit = 256M
max_execution_time = 300
max_input_time = 300
max_input_vars = 5000

# Save: Ctrl+X → Y → Enter

# Restart PHP
sudo systemctl restart php-fpm
# or: sudo systemctl restart php8.1-fpm
```

#### Step 2: Update Nginx

```bash
# Find and edit your Nginx config
sudo nano /etc/nginx/nginx.conf
# or
sudo nano /etc/nginx/sites-available/default
# or
sudo nano /etc/nginx/conf.d/your-site.conf
```

**In the `http` or `server` block, add:**
```nginx
client_max_body_size 50M;

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
```

**Save: Ctrl+X → Y → Enter**

#### Step 3: Test and Reload Nginx

```bash
# Test config
sudo nginx -t

# Should output:
# nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
# nginx: configuration file /etc/nginx/nginx.conf test is successful

# Reload
sudo systemctl reload nginx

# Check status
sudo systemctl status nginx
```

---

## For Elastic Beanstalk Users

The configuration files are already in your project:
- `.platform/nginx/conf.d/client_max_body_size.conf`
- `.platform/nginx/conf.d/error_pages.conf`

Just deploy:
```bash
git add .
git commit -m "Update: 50MB file upload support"
git push
eb deploy
```

---

## Testing the Changes

### Local (XAMPP)

1. Open: `http://localhost/ospta/admin/galleries/create`
2. Select "Image" type
3. Try uploading:
   - **Small file (< 50MB):** Should upload successfully
   - **Large file (> 50MB):** Should show validation error: "⚠️ File size exceeds limit! File is X MB, maximum allowed is 50 MB."

### AWS Server

Same as above but with your domain: `https://your-domain.com/admin/galleries/create`

### What You'll See

**Before selecting file:**
```
No file selected
```

**After selecting file (valid):**
```
✓ File: my-image.jpg (2.5 MB)
```

**After selecting file (too large):**
```
⚠️ File size exceeds limit! File is 55 MB, maximum allowed is 50 MB.
[Submit button disabled]
```

---

## Troubleshooting

### Still getting "form keeps loading" when uploading > 2MB?

1. **Local:** 
   - Ensure XAMPP Apache is restarted after php.ini changes
   - Check XAMPP error logs: `C:\xampp\apache\logs\error.log`

2. **AWS:**
   - Verify PHP changes:
     ```bash
     php -i | grep -E "upload_max_filesize|post_max_size"
     ```
   - Check Nginx error log:
     ```bash
     sudo tail -20 /var/log/nginx/error.log
     ```
   - Check Laravel error log:
     ```bash
     tail -20 /path/to/storage/logs/laravel.log
     ```

### Getting raw 413/500 error page instead of validation message?

- This means the request is being blocked before reaching Laravel
- **Causes:**
  - Nginx `client_max_body_size` not set
  - PHP `post_max_size` too small
  - Reverse proxy limits (ALB, CLB)

- **Solution:**
  - Set Nginx `client_max_body_size 50M;` globally
  - Ensure all PHP settings match above
  - Check if using AWS load balancer and increase its limits

---

## Configuration Reference

### Max Upload Limits

| Setting | Value | Purpose |
|---------|-------|---------|
| Nginx `client_max_body_size` | 50M | Max request body size |
| PHP `upload_max_filesize` | 50M | Max uploaded file size |
| PHP `post_max_size` | 50M | Max POST data size |
| PHP `memory_limit` | 256M | Script memory limit |
| Laravel validation `max:51200` | 51200 KB | Laravel validation (51200 KB = 50 MB) |

### Form Validation Features

✅ **Real-time file size check** - Prevents submission if file > 50MB  
✅ **File size display** - Shows selected file size in human-readable format  
✅ **Visual feedback** - Green checkmark for valid, red alert for invalid  
✅ **Inline error messages** - Errors appear below file input, not on separate page  
✅ **Progress indication** - Status updates as user selects file  

---

## Support

If you encounter issues:

1. Check logs (paths listed above)
2. Verify all configuration files are updated
3. Restart all services (PHP, Nginx, Apache)
4. Clear browser cache and refresh
5. Test with a small file first (< 5MB)

---

## Quick Command Reference

### Local (XAMPP)
```bash
# Find php.ini
php -r "echo php_ini_loaded_file();"

# Restart Apache (Windows)
# Use XAMPP Control Panel: Stop → Start
```

### AWS
```bash
# Update PHP
sudo nano /etc/php.ini
sudo systemctl restart php-fpm

# Update Nginx
sudo nano /etc/nginx/nginx.conf
sudo nginx -t
sudo systemctl reload nginx

# Check logs
tail -20 /var/log/nginx/error.log
tail -20 /path/to/laravel/storage/logs/laravel.log
```

---

## Security Notes

✅ File type validation (JPG, PNG, GIF only)  
✅ File size validation (both client & server)  
✅ Middleware protection (CheckUploadSize)  
✅ Laravel validation rules applied  
✅ Proper error handling without exposing system paths  

---

**Last Updated:** January 7, 2026  
**Upload Limit:** 50MB  
**Supported Formats:** JPG, PNG, GIF  
