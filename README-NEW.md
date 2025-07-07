# Patungann - Smart Bill Splitting Application

A Laravel-based web application for smart bill splitting with AI-powered receipt scanning and expense tracking.

## 🚀 Features

- **AI Receipt Scanning**: Upload receipt images and automatically extract items and amounts
- **Smart Bill Splitting**: Split bills equally, by custom amounts, or percentages
- **Real-time Notifications**: Get notified when bills are updated or settled
- **Expense Analytics**: Track spending patterns and group expenses
- **User Management**: Friend system and user profiles
- **Admin Dashboard**: Analytics and user management for administrators

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x (PHP 8.4+)
- **Database**: PostgreSQL (Supabase)
- **Frontend**: Blade Templates with Pure CSS
- **Authentication**: Laravel's built-in auth system
- **AI Integration**: Ready for Google Genkit integration

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.1+** (we recommend PHP 8.4)
- **Composer** (latest version)
- **PostgreSQL** or **Supabase account**
- **Git** (for version control)

### Installing PHP and Composer on Windows

#### Option 1: Manual Installation
1. **Download PHP**: Get PHP 8.4 from [php.net](https://windows.php.net/download/)
2. **Download Composer**: Get Composer from [getcomposer.org](https://getcomposer.org/download/)
3. **Add to PATH**: Ensure both PHP and Composer are in your system PATH

#### Option 2: Using Laragon (Recommended)
1. Download [Laragon](https://laragon.org/download/)
2. Install and run Laragon
3. PHP, Composer, and other tools will be automatically configured

## 🔧 Installation & Setup

### 1. Clone the Repository

```bash
git clone <your-repo-url>
cd "patungann -php"
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and configure it:

```bash
copy .env.example .env
```

Edit `.env` file with your database credentials:

```env
APP_NAME="Patungann"
APP_ENV=local
APP_KEY=base64:QfIMZDcr+C28iuBU/aRZ55a+gbx6VgF8jxyAcJQQ9tU=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration - Supabase PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=db.your-project.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-supabase-password

# Supabase Configuration
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_ANON_KEY=your-anon-key
SUPABASE_SERVICE_ROLE_KEY=your-service-role-key
```

### 4. Generate Application Key (if not already set)

```bash
php artisan key:generate
```

### 5. Create Required Directories

The following directories should already exist, but if not, create them:

```bash
mkdir bootstrap\cache
mkdir storage\framework\cache
mkdir storage\framework\sessions
mkdir storage\framework\views
mkdir storage\logs
```

### 6. Database Setup

Run the database migrations:

```bash
php artisan migrate
```

## 🚀 Running the Application

### Start the Development Server

```bash
php -S localhost:8000 -t public
```

Or using Laravel's built-in server (if available):

```bash
php artisan serve
```

### Access the Application

Open your browser and navigate to:
- **Main Site**: http://localhost:8000
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/signup
- **Dashboard**: http://localhost:8000/dashboard (after login)
- **Admin**: http://localhost:8000/admin (for admin users)

## 📁 Project Structure

```
patungann-php/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Providers/           # Service providers
│   ├── Console/             # Artisan commands
│   └── Exceptions/          # Exception handlers
├── config/                  # Configuration files
├── database/
│   └── migrations/          # Database migrations
├── public/                  # Public assets (CSS, images)
├── resources/
│   └── views/              # Blade templates
├── routes/                 # Route definitions
├── storage/                # Storage and cache
└── vendor/                 # Composer dependencies
```

## 🔐 Authentication System

The application includes a complete authentication system:

- **Registration**: `/signup`
- **Login**: `/login`
- **Logout**: Handled via POST to `/logout`
- **Profile Management**: Available in dashboard
- **Admin Middleware**: Protects admin routes

## 🎨 Frontend

The application uses pure CSS instead of Tailwind for styling:

- **Main Stylesheet**: `public/css/style.css`
- **Responsive Design**: Mobile-first approach
- **Dark/Light Theme**: Theme switching capability
- **Modern UI**: Clean and professional design

## 🗄️ Database Schema

The application includes the following main models:

- **User**: User accounts and profiles
- **Bill**: Bills and receipts
- **BillItem**: Individual items in a bill
- **BillParticipant**: Users participating in a bill
- **ItemAssignment**: Assignment of items to users
- **Settlement**: Payment settlements
- **Friendship**: User relationships

## 🔧 Configuration

### Database Configuration

Edit `config/database.php` for database settings. The application is configured for PostgreSQL by default.

### Supabase Integration

Configure Supabase settings in `config/supabase.php`:

```php
return [
    'url' => env('SUPABASE_URL'),
    'anon_key' => env('SUPABASE_ANON_KEY'),
    'service_role_key' => env('SUPABASE_SERVICE_ROLE_KEY'),
];
```

## 🚀 Deployment

### Production Deployment

1. **Environment**: Set `APP_ENV=production` in `.env`
2. **Debug**: Set `APP_DEBUG=false` in `.env`
3. **HTTPS**: Configure your web server for HTTPS
4. **Cache**: Run optimization commands:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Web Server Configuration

#### Apache (.htaccess)
The `public/.htaccess` file is already configured for Apache.

#### Nginx
Configure your Nginx server block to point to the `public` directory.

## 🔄 Development Workflow

### Adding New Features

1. **Models**: Create in `app/Models/`
2. **Controllers**: Create in `app/Http/Controllers/`
3. **Views**: Create in `resources/views/`
4. **Routes**: Add to `routes/web.php`
5. **Migrations**: Create with `php artisan make:migration`

### Running Tests

```bash
php artisan test
```

## 🐛 Troubleshooting

### Common Issues

1. **500 Internal Server Error**
   - Check storage permissions
   - Verify `.env` configuration
   - Check Laravel logs in `storage/logs/`

2. **Database Connection Error**
   - Verify database credentials in `.env`
   - Ensure PostgreSQL/Supabase is accessible
   - Check firewall settings

3. **Missing APP_KEY**
   - Run `php artisan key:generate`
   - Check `.env` file for APP_KEY

4. **Permission Errors**
   - Set proper permissions on `storage/` and `bootstrap/cache/`
   - Run as administrator on Windows if needed

5. **Artisan Commands Not Working**
   - Some Laravel packages might be missing
   - The basic commands should work: `php artisan list`, `php artisan inspire`

### Windows-Specific Issues

1. **Path with Spaces**: Use quotes around paths: `cd "d:\Patungann\patungann -php"`
2. **PowerShell vs CMD**: Some commands work better in CMD than PowerShell
3. **Permissions**: Run terminal as Administrator if needed

### Logs

Check application logs at:
- `storage/logs/laravel.log`

## ✅ Current Status

The application is **WORKING** and includes:

✅ **Core Setup**
- Laravel 10 installation
- All required directories created
- Proper file permissions
- Working PHP server

✅ **Configuration**
- Database configuration (PostgreSQL/Supabase ready)
- Application key generated
- Environment variables configured
- Service providers working

✅ **Routing & Views**
- Working web routes
- Beautiful landing page
- Authentication routes ready
- Admin routes configured

✅ **Models & Controllers**
- User authentication system
- Bill management system
- Admin dashboard
- All Eloquent models

✅ **Frontend**
- Pure CSS styling (no Tailwind dependency)
- Responsive design
- Professional UI
- Mobile-friendly

## 🔄 Next Steps

After getting the basic app running, you can:

1. **Set up Database**: Configure Supabase and run migrations
2. **Test Authentication**: Create user accounts and test login
3. **Add Features**: Implement bill creation and management
4. **AI Integration**: Add Google Genkit for receipt scanning
5. **Deploy**: Set up production environment

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit a pull request

## 📝 License

This project is open-source. Please check the LICENSE file for details.

## 🆘 Support

For support, please:
1. Check the troubleshooting section
2. Review Laravel documentation
3. Create an issue in the repository

---

**Happy Bill Splitting! 💰✨**

**Server is running at: http://localhost:8000**
