# Blog Setup Checklist - Troubleshooting Guide

## Quick Fix: Automated Diagnostic Scripts

The theme includes two diagnostic scripts to help troubleshoot blog routing issues:

### 1. diagnose-production.php - Check Current Settings

**Usage:**
1. Upload `wp-content/themes/enhancethat/diagnose-production.php` to your WordPress root directory
2. Visit `https://yourdomain.com/diagnose-production.php` in your browser
3. Review the output to see current settings and recommendations
4. Delete the file when done

**What it checks:**
- Current reading settings (show_on_front, page_on_front, page_for_posts)
- Page existence and status
- Theme template files
- Permalink structure
- Provides specific recommendations for fixes

### 2. fix-production.php - Automatic Fix

**Usage:**
1. Upload `wp-content/themes/enhancethat/fix-production.php` to your WordPress root directory
2. Visit `https://yourdomain.com/fix-production.php` in your browser
3. Script will automatically configure correct settings
4. **IMPORTANT: Delete this file after running for security!**

**What it does:**
- Finds or creates "Homepage" and "Blog" pages
- Sets correct reading settings
- Flushes permalink rewrite rules
- Verifies configuration

---

## Issue: /blog/ not working or navigation stuck

### Problem 1: On Live Website - /blog/ reloads homepage

**Cause:** WordPress reading settings not configured on production site

**Solution:**

1. **Log into WordPress Admin** on your live site
2. **Go to Settings > Reading**
3. **Configure these settings:**
   - "Your homepage displays" → Select **"A static page"**
   - "Homepage" → Leave as "— Select —" OR select a specific page
   - "Posts page" → Click **"+ Select"** and create a new page:
     - Title: **Blog**
     - Content: Leave empty
     - Publish
     - Select this "Blog" page
4. **Click "Save Changes"**

5. **Flush Permalinks:**
   - Go to Settings > Permalinks
   - Click "Save Changes" (don't change anything, just save)

6. **Test:**
   - Visit `yourdomain.com/blog/` - should show blog listing
   - Visit `yourdomain.com/` - should show homepage

---

### Problem 2: On Localhost - Logo link stuck showing blog

**Cause:** Browser caching the wrong page

**Solution A: Clear Browser Cache**

**Chrome/Edge:**
1. Press `Ctrl + Shift + Delete` (Windows) or `Cmd + Shift + Delete` (Mac)
2. Select "Cached images and files"
3. Click "Clear data"
4. Refresh page with `Ctrl + F5` (hard refresh)

**Firefox:**
1. Press `Ctrl + Shift + Delete`
2. Select "Cache"
3. Click "Clear Now"
4. Refresh with `Ctrl + F5`

**Solution B: Test in Incognito/Private Mode**

1. Open incognito window: `Ctrl + Shift + N` (Chrome) or `Ctrl + Shift + P` (Firefox)
2. Visit http://localhost:8080
3. Navigate to /blog/ and back
4. Check if navigation works correctly

**Solution C: Force Refresh**

1. On homepage: Press `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac)
2. On blog page: Press `Ctrl + F5`
3. Try navigating again

---

### Problem 3: Both URLs show the same content

**Check WordPress Settings:**

Run this in terminal:

```bash
docker compose exec -T wordpress bash -c "php -r \"
define('WP_USE_THEMES', false);
require('/var/www/html/wp-load.php');
echo 'Homepage setting: ' . get_option('show_on_front') . PHP_EOL;
echo 'Page on front: ' . get_option('page_on_front') . PHP_EOL;
echo 'Posts page ID: ' . get_option('page_for_posts') . PHP_EOL;
\""
```

**Expected output:**
```
Homepage setting: page
Page on front: 0
Posts page ID: 5
```

If different, run the fix:

```bash
cat > /tmp/fix-blog.php << 'EOFPHP'
<?php
define('WP_USE_THEMES', false);
require('/var/www/html/wp-load.php');

// Get or create Blog page
$blog_page = get_page_by_path('blog');
if (!$blog_page) {
    $page_id = wp_insert_post([
        'post_title' => 'Blog',
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_content' => ''
    ]);
} else {
    $page_id = $blog_page->ID;
}

// Configure settings
update_option('show_on_front', 'page');
update_option('page_on_front', 0); // No specific front page = use front-page.php
update_option('page_for_posts', $page_id);

// Flush permalinks
flush_rewrite_rules(true);

echo "Settings fixed!\n";
echo "Homepage: Will use front-page.php template\n";
echo "Blog page: ID $page_id (/blog/)\n";
EOFPHP

docker compose exec -T wordpress bash -c "cat > /tmp/fix.php && php /tmp/fix.php" < /tmp/fix-blog.php
```

---

## Quick Test Commands

**Check if templates are different:**
```bash
# Homepage should show "Simplified and integrated digital design workflow"
curl -s http://localhost:8080/ | grep "Simplified and integrated"

# Blog should show "Blog"
curl -s http://localhost:8080/blog/ | grep -o '<h1[^>]*>Blog<'
```

**Test navigation links:**
```bash
# Check logo link
curl -s http://localhost:8080/ | grep 'logo-link' | grep -o 'href="[^"]*"'

# Check blog button
curl -s http://localhost:8080/ | grep 'button-yellow.*Blog' | grep -o 'href="[^"]*"'
```

---

## For Production/Live Website

**After uploading the theme ZIP:**

1. **Activate theme** (Appearance > Themes)

2. **Set Permalinks:**
   - Settings > Permalinks
   - Select "Post name"
   - Save

3. **Configure Reading Settings:**
   - Settings > Reading
   - Your homepage displays: "A static page"
   - Posts page: Create new page "Blog" and select it
   - Save

4. **Flush .htaccess** (if needed):
   - Settings > Permalinks > Save again

5. **Clear any caching plugins:**
   - WP Super Cache: Delete cache
   - W3 Total Cache: Empty all caches
   - Cloudflare: Purge cache

6. **Test URLs:**
   - yoursite.com/ = Homepage (front-page.php)
   - yoursite.com/blog/ = Blog listing (home.php)

---

## Still Not Working?

**Check .htaccess file** (on production server):

Your WordPress root should have this in `.htaccess`:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

If missing or different, go to Settings > Permalinks and click Save to regenerate it.

---

## Debug Mode

Enable WordPress debug to see errors:

Edit `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Check `/wp-content/debug.log` for errors.
