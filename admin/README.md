# University Alumni Portal - MVC Project

## Project Structure

```
web/
│── index.php                 # Main router/entry point
│── config/
│   └── database.php         # Database configuration and connection
│── controllers/
│   ├── LoginController.php  # Handles login (FR02)
│   ├── RegisterController.php # Handles registration (FR01)
│   └── ProfileController.php  # Handles profile management (FR03)
│── models/
│   ├── Alumni.php          # Alumni model with database operations
│   └── Admin.php           # Admin model
│── views/
│   ├── auth/
│   │   ├── login.php       # Login view
│   │   └── register.php    # Registration view
│   ├── profile/
│   │   ├── view.php        # View profile
│   │   └── edit.php        # Edit profile
│   └── dashboard/
│       └── alumni_dashboard.php # Alumni dashboard
│── assets/                  # CSS, JS, images (copied from template)
```

## Setup Instructions

1. **Database Configuration**
   - Open `config/database.php`
   - Update database credentials if needed:
     - `$host = 'localhost'`
     - `$db_name = 'alumni_portal'`
     - `$username = 'root'`
     - `$password = ''` (set your MySQL password)

2. **Database Initialization**
   - The database and tables are automatically created on first run
   - Database name: `alumni_portal`
   - Tables created:
     - `users` - User accounts
     - `alumni` - Alumni profiles
     - `admin` - Admin profiles

3. **Access the Application**
   - Start XAMPP (Apache and MySQL)
   - Navigate to: `http://localhost/rahat/web/`
   - Default action is login page

## Functional Requirements Implemented

### FR01 - User Registration (Alumni)
- ✅ Registration form with validation
- ✅ Email uniqueness check
- ✅ Password hashing using `password_hash()`
- ✅ Input sanitization and validation
- ✅ Stores user in database

### FR02 - Login Functionality (Admin + Alumni)
- ✅ Login form for both roles
- ✅ Password verification using `password_verify()`
- ✅ Session creation and management
- ✅ Role-based redirection to dashboards
- ✅ Secure session handling

### FR03 - Alumni Profile Management
- ✅ View profile information
- ✅ Edit profile (name, contact, job, etc.)
- ✅ Upload profile picture
- ✅ Update database with changes
- ✅ File upload validation (type and size)

## Usage

### Registration
1. Navigate to: `index.php?action=register`
2. Fill in required fields (Name, Email, Password)
3. Optional fields: Graduation Year, Department, etc.
4. Submit form

### Login
1. Navigate to: `index.php?action=login`
2. Enter email and password
3. System redirects to appropriate dashboard based on role

### Profile Management
1. Login as alumni
2. Navigate to: `index.php?action=profile` (view)
3. Navigate to: `index.php?action=profile_edit` (edit)
4. Update information and upload profile picture
5. Save changes

## Security Features

- ✅ Password hashing (bcrypt)
- ✅ Prepared statements (SQL injection prevention)
- ✅ Input sanitization
- ✅ File upload validation
- ✅ Session management
- ✅ Role-based access control

## Notes

- Profile pictures are stored in `assets/images/profiles/`
- Maximum file upload size: 5MB
- Allowed image types: JPG, PNG, GIF
- Session timeout: Default PHP session timeout

## Next Steps

To extend the project:
1. Add Alumni Directory search functionality
2. Implement Event Management
3. Add News/Announcements module
4. Create Admin Dashboard
5. Add password reset functionality

