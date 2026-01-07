#!/bin/bash
set -e

echo "======================================"
echo "AWS Laravel Upload Fix Setup Script"
echo "======================================"

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Step 1: Update PHP settings
echo -e "${BLUE}[1/4] Updating PHP configuration...${NC}"

# Find php.ini
PHP_INI=$(php -r "echo php_ini_loaded_file();")
echo "Found php.ini at: $PHP_INI"

# Backup original
sudo cp "$PHP_INI" "$PHP_INI.backup.$(date +%s)"

# Update PHP settings
sudo sed -i 's/^upload_max_filesize.*/upload_max_filesize = 50M/' "$PHP_INI"
sudo sed -i 's/^post_max_size.*/post_max_size = 50M/' "$PHP_INI"
sudo sed -i 's/^memory_limit.*/memory_limit = 256M/' "$PHP_INI"

echo -e "${GREEN}✓ PHP settings updated${NC}"
echo "  upload_max_filesize = 50M"
echo "  post_max_size = 50M"
echo "  memory_limit = 256M"

# Step 2: Update Nginx configuration
echo -e "${BLUE}[2/4] Updating Nginx configuration...${NC}"

NGINX_CONF="/etc/nginx/nginx.conf"
SITES_AVAILABLE="/etc/nginx/sites-available"
SITES_ENABLED="/etc/nginx/sites-enabled"

if [ -f "$NGINX_CONF" ]; then
    sudo cp "$NGINX_CONF" "$NGINX_CONF.backup.$(date +%s)"
    
    # Add client_max_body_size to http block if not already present
    if ! sudo grep -q "client_max_body_size" "$NGINX_CONF"; then
        sudo sed -i '/^http {/a\    client_max_body_size 50M;' "$NGINX_CONF"
        echo -e "${GREEN}✓ Added client_max_body_size to nginx.conf${NC}"
    fi
fi

# Step 3: Update site-specific Nginx config
echo -e "${BLUE}[3/4] Updating site-specific Nginx configuration...${NC}"

if [ -d "$SITES_AVAILABLE" ]; then
    for site in $(ls "$SITES_AVAILABLE" 2>/dev/null); do
        SITE_CONF="$SITES_AVAILABLE/$site"
        
        # Backup
        sudo cp "$SITE_CONF" "$SITE_CONF.backup.$(date +%s)"
        
        # Add error page directives if not present
        if ! sudo grep -q "error_page 413" "$SITE_CONF"; then
            # Add before closing brace
            sudo sed -i '/^}/i\    error_page 413 \/errors\/413.html;\n    error_page 500 502 503 504 \/errors\/500.html;' "$SITE_CONF"
            echo -e "${GREEN}✓ Added error_page directives to $site${NC}"
        fi
        
        # Add error page location blocks if not present
        if ! sudo grep -q "location = /errors/413.html" "$SITE_CONF"; then
            sudo sed -i '/^}/i\    location = \/errors\/413.html {\n        internal;\n        root \/var\/www\/your-app\/public;\n    }\n    location = \/errors\/500.html {\n        internal;\n        root \/var\/www\/your-app\/public;\n    }' "$SITE_CONF"
            echo -e "${GREEN}✓ Added error page location blocks to $site${NC}"
        fi
    done
fi

# Step 4: Restart services
echo -e "${BLUE}[4/4] Restarting services...${NC}"

# Test Nginx config
echo "Testing Nginx configuration..."
sudo nginx -t

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Nginx configuration is valid${NC}"
    sudo systemctl reload nginx
    echo -e "${GREEN}✓ Nginx reloaded${NC}"
else
    echo -e "${RED}✗ Nginx configuration has errors. Check above for details.${NC}"
    exit 1
fi

# Restart PHP-FPM
if systemctl is-active --quiet php-fpm; then
    sudo systemctl restart php-fpm
    echo -e "${GREEN}✓ PHP-FPM restarted${NC}"
elif systemctl is-active --quiet php8.1-fpm; then
    sudo systemctl restart php8.1-fpm
    echo -e "${GREEN}✓ PHP 8.1-FPM restarted${NC}"
elif systemctl is-active --quiet php8.0-fpm; then
    sudo systemctl restart php8.0-fpm
    echo -e "${GREEN}✓ PHP 8.0-FPM restarted${NC}"
fi

echo ""
echo -e "${GREEN}======================================"
echo "Setup Complete!"
echo "=====================================${NC}"
echo ""
echo "Next steps:"
echo "1. Deploy your Laravel project (public/errors/*.html files must be present)"
echo "2. Test upload of a file >2MB"
echo "3. Check logs:"
echo "   - Nginx errors: tail -f /var/log/nginx/error.log"
echo "   - Laravel logs: tail -f /path/to/your/app/storage/logs/laravel.log"
echo ""
