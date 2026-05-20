# Alumni Portal — Setup Guide (macOS & Windows)

University of Agriculture Faisalabad Alumni Portal. Runs on XAMPP (Apache + MySQL + PHP).

## Prerequisites

- XAMPP installed (PHP 8.0+, MySQL 5.7+/MariaDB)
- A modern browser

---

## macOS Setup

1. **Place the project** in XAMPP's htdocs:
   ```
   /Applications/XAMPP/xamppfiles/htdocs/alumni_portal/
   ```

2. **Fix directory permissions** (Apache runs as `daemon` user on macOS XAMPP and needs read access):
   ```bash
   chmod -R 755 /Applications/XAMPP/xamppfiles/htdocs/alumni_portal
   ```
   Skipping this step results in **403 Access Forbidden**.

3. **Start XAMPP** services (Apache + MySQL) from XAMPP Control Panel.

4. **Import the database** (auto-creates on first request, or run manually):
   ```bash
   /Applications/XAMPP/xamppfiles/bin/mysql -u root < /Applications/XAMPP/xamppfiles/htdocs/alumni_portal/alumni_portal.sql
   ```

5. **Open the portal**:
   - Homepage: http://localhost/alumni_portal/
   - Admin/Auth: http://localhost/alumni_portal/admin/

---

## Windows Setup

1. **Place the project** in XAMPP's htdocs:
   ```
   C:\xampp\htdocs\alumni_portal\
   ```

2. **No permission fix needed** — Windows XAMPP doesn't have the macOS permission issue.

3. **Start XAMPP** services (Apache + MySQL) from XAMPP Control Panel.

4. **Import the database** (auto-creates on first request, or run manually):
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create database `alumni_portal` (utf8mb4_unicode_ci)
   - Import `alumni_portal.sql` from the project root

   Or via CLI:
   ```cmd
   C:\xampp\mysql\bin\mysql.exe -u root < C:\xampp\htdocs\alumni_portal\alumni_portal.sql
   ```

5. **Open the portal**:
   - Homepage: http://localhost/alumni_portal/
   - Admin/Auth: http://localhost/alumni_portal/admin/

---

## Database Configuration

Default credentials in [admin/config/database.php](admin/config/database.php):

| Setting   | Default         |
|-----------|-----------------|
| host      | `localhost`     |
| db_name   | `alumni_portal` |
| username  | `root`          |
| password  | *(empty)*       |

The database is auto-initialized on first request — tables (`users`, `alumni`, `admin`) are created automatically by `Database::initializeDatabase()`.

If your MySQL has a password, edit line 11 of [admin/config/database.php](admin/config/database.php#L11).

---

## Project Structure

```
alumni_portal/
├── index.php                   # Public homepage
├── about.php, contact.php, ... # Public pages
├── alumni_portal.sql           # DB schema export
├── .htaccess                   # Apache config (cross-platform)
├── admin/                      # MVC auth + dashboard
│   ├── index.php               # Router (action=login|register|...)
│   ├── config/database.php
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── assets/
│       └── images/profiles/    # Uploaded profile pictures
├── assets/                     # Public static assets
└── includes/                   # Header/footer/scripts partials
```

---

## Cross-Platform Notes

The PHP code is already cross-platform:
- Uses `__DIR__` and forward slashes (PHP normalizes these on Windows)
- No OS-specific shell calls
- Apache `.htaccess` works identically on both platforms

The **only** platform-specific gotcha is macOS file permissions — covered in step 2 above.

---

## Troubleshooting

**403 Access Forbidden (macOS)** — Run `chmod -R 755` on the project folder.

**Database connection error** — Ensure MySQL is running and credentials in `admin/config/database.php` match your XAMPP setup.

**Profile picture upload fails** — Ensure `admin/assets/images/profiles/` exists and is writable:
- macOS: `chmod 755 admin/assets/images/profiles`
- Windows: usually writable by default

**Page shows the test HTML instead of the homepage** — The `.htaccess` ensures `index.php` is served first. If you removed it, delete `index.html` from the root.
