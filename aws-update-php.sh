#!/bin/bash
# This script automatically updates php.ini on your AWS server

set -e

echo "========================================"
echo "AWS PHP Configuration Update"
echo "========================================"

# Step 1: Find php.ini
echo "[1] Finding php.ini location..."
PHP_INI=$(php -r "echo php_ini_loaded_file();" 2>/dev/null || echo "")

if [ -z "$PHP_INI" ]; then
    # Try common locations
    if [ -f "/etc/php.ini" ]; then
        PHP_INI="/etc/php.ini"
    elif [ -f "/etc/php/8.1/fpm/php.ini" ]; then
        PHP_INI="/etc/php/8.1/fpm/php.ini"
    elif [ -f "/etc/php/8.0/fpm/php.ini" ]; then
        PHP_INI="/etc/php/8.0/fpm/php.ini"
    else
        echo "ERROR: Could not find php.ini. Please locate it manually."
        exit 1
    fi
fi

echo "Found php.ini at: $PHP_INI"

# Step 2: Backup original
echo "[2] Creating backup..."
BACKUP_FILE="$PHP_INI.backup.$(date +%s)"
sudo cp "$PHP_INI" "$BACKUP_FILE"
echo "Backup created at: $BACKUP_FILE"

# Step 3: Update settings using sed
echo "[3] Updating PHP settings..."

# Function to update or add a setting
update_setting() {
    local key=$1
    local value=$2
    local file=$3
    
    if sudo grep -q "^$key\s*=" "$file"; then
        # Setting exists, update it
        sudo sed -i "s/^$key\s*=.*/$key = $value/" "$file"
        echo "  ✓ Updated $key = $value"
    elif sudo grep -q "^;$key\s*=" "$file"; then
        # Setting is commented, uncomment and update
        sudo sed -i "s/^;$key\s*=.*/;$key = $value/" "$file"
        echo "  ✓ Uncommented and updated $key = $value"
    else
        # Setting doesn't exist, add it
        sudo bash -c "echo '$key = $value' >> '$file'"
        echo "  ✓ Added $key = $value"
    fi
}

# Update settings
update_setting "upload_max_filesize" "50M" "$PHP_INI"
update_setting "post_max_size" "50M" "$PHP_INI"
update_setting "memory_limit" "256M" "$PHP_INI"
update_setting "max_execution_time" "300" "$PHP_INI"
update_setting "max_input_time" "300" "$PHP_INI"
update_setting "max_input_vars" "5000" "$PHP_INI"

# Step 4: Verify changes
echo ""
echo "[4] Verifying changes..."
echo "Current settings in $PHP_INI:"
sudo grep -E "upload_max_filesize|post_max_size|memory_limit|max_execution_time|max_input_time|max_input_vars" "$PHP_INI" | grep -v "^;" || true

# Step 5: Restart PHP
echo ""
echo "[5] Restarting PHP-FPM..."

if sudo systemctl is-active --quiet php-fpm 2>/dev/null; then
    sudo systemctl restart php-fpm
    echo "  ✓ Restarted php-fpm"
elif sudo systemctl is-active --quiet php8.1-fpm 2>/dev/null; then
    sudo systemctl restart php8.1-fpm
    echo "  ✓ Restarted php8.1-fpm"
elif sudo systemctl is-active --quiet php8.0-fpm 2>/dev/null; then
    sudo systemctl restart php8.0-fpm
    echo "  ✓ Restarted php8.0-fpm"
elif sudo systemctl is-active --quiet php7.4-fpm 2>/dev/null; then
    sudo systemctl restart php7.4-fpm
    echo "  ✓ Restarted php7.4-fpm"
else
    echo "  ! Could not detect PHP-FPM service. Please restart manually:"
    echo "    sudo systemctl restart php-fpm"
fi

echo ""
echo "========================================"
echo "✓ PHP Configuration Updated Successfully!"
echo "========================================"
echo ""
echo "Settings updated:"
echo "  • upload_max_filesize = 50M"
echo "  • post_max_size = 50M"
echo "  • memory_limit = 256M"
echo "  • max_execution_time = 300"
echo "  • max_input_time = 300"
echo "  • max_input_vars = 5000"
echo ""
echo "Backup location: $BACKUP_FILE"
echo ""
