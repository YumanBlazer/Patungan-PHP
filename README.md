# Patungann - Laravel Edition

Patungann adalah aplikasi bill splitting dan expense tracking yang dibangun dengan Laravel dan PostgreSQL (Supabase).

## Features

- 📄 **Bill Management**: Buat dan kelola tagihan bersama
- 👥 **Friend System**: Tambah te4. Update `.env` with Supabase credentials
4. Run migrations to create tables

## Troubleshooting

### Common Issues & Solutions

1. **"php: command not found"**
   - Install Laragon/XAMPP first
   - Restart terminal after installation
   - Check if PHP is in PATH: `echo $env:PATH`

2. **"composer: command not found"**
   - Download Composer from: https://getcomposer.org/
   - Or use Laragon which includes Composer

3. **Database connection error**
   - Check your .env database credentials
   - For Supabase: Verify project URL and password
   - For local MySQL: Ensure MySQL service is running in Laragon

4. **"Key does not exist" error**
   - Run: `php artisan key:generate`
   - Make sure .env file exists

5. **Migration errors**
   - Check database connection first
   - For MySQL: Create database manually
   - For Supabase: Database should exist automatically

6. **Port 8000 already in use**
   - Use different port: `php artisan serve --port=8001`
   - Or stop other Laravel/PHP processes

### Quick Health Check
```bash
# Check if everything is working
php --version          # Should show PHP 8.x
composer --version     # Should show Composer version
php artisan --version  # Should show Laravel version
```n dan kelola kontak
- 💰 **Expense Splitting**: Bagi tagihan secara otomatis atau manual
- 📱 **Receipt Scanning**: Scan receipt dengan OCR (AI-powered)
- 📊 **Analytics**: Lihat laporan pengeluaran dan statistik
- 🔔 **Notifications**: Notifikasi real-time untuk update tagihan
- 👨‍💼 **Admin Panel**: Dashboard admin untuk mengelola users dan system

## Tech Stack

- **Backend**: Laravel 10.x
- **Database**: PostgreSQL (via Supabase)
- **Frontend**: Blade Templates + Pure CSS
- **Authentication**: Laravel built-in auth
- **AI/OCR**: Integration ready for OpenAI/Google Vision

## Installation

### Prerequisites (Download These First)

1. **Laragon (Recommended)** or **XAMPP**
   - Download: https://laragon.org/download/
   - Includes: PHP 8.3, MySQL, Apache, Composer
   - Install as Administrator

2. **Composer** (if not included in Laragon)
   - Download: https://getcomposer.org/Composer-Setup.exe

3. **Database Options:**
   - **Supabase (Cloud)**: https://supabase.com (Free tier available)
   - **PostgreSQL Local**: https://www.postgresql.org/download/windows/
   - **MySQL**: Already included in Laragon/XAMPP

### Setup Steps

1. **Start Laragon/XAMPP**
   - Open Laragon application
   - Click "Start All" (Apache, MySQL should turn green)

2. **Verify PHP & Composer**
   ```bash
   php --version
   composer --version
   ```

3. **Clone/Copy the project**
   ```bash
   git clone <repository-url>
   cd patungann-php
   ```

4. **Install dependencies**
   ```bash
   composer install
   ```

5. **Environment setup**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

6. **Configure your .env file**
   
   For **Supabase** (Recommended):
   ```env
   # Database (Supabase PostgreSQL)
   DB_CONNECTION=pgsql
   DB_HOST=db.xxx.supabase.co
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres
   DB_PASSWORD=your_supabase_password

   # Supabase Integration
   SUPABASE_URL=https://xxx.supabase.co
   SUPABASE_ANON_KEY=your_anon_key
   SUPABASE_SERVICE_ROLE_KEY=your_service_role_key
   ```

   For **Local MySQL** (Laragon/XAMPP):
   ```env
   # Database (Local MySQL)
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=patungann
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Create database** (if using local MySQL)
   ```sql
   CREATE DATABASE patungann;
   ```

8. **Run migrations**
   ```bash
   php artisan migrate
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

10. **Access the application**
    - Open browser: http://localhost:8000

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   ├── DashboardController.php # Dashboard and user app
│   │   ├── BillController.php      # Bill management
│   │   └── AdminController.php     # Admin panel
│   ├── Middleware/
│   │   └── AdminMiddleware.php     # Admin access control
│   └── Kernel.php                  # HTTP kernel
├── Models/
│   ├── User.php                    # User model
│   ├── Bill.php                    # Bill model
│   ├── BillItem.php               # Bill items
│   ├── BillParticipant.php        # Bill participants
│   ├── Settlement.php             # Settlement records
│   ├── ItemAssignment.php         # Item assignments
│   └── Friendship.php             # Friend relationships
└── Providers/
    └── AppServiceProvider.php     # Application services

config/
├── app.php                        # App configuration
├── database.php                   # Database configuration
├── session.php                    # Session configuration
└── supabase.php                   # Supabase integration

resources/views/
├── layouts/
│   └── app.blade.php              # Master layout
├── components/
│   └── navigation.blade.php       # Navigation component
├── auth/
│   ├── login.blade.php            # Login page
│   └── register.blade.php         # Registration page
├── dashboard/
│   └── index.blade.php            # Dashboard
├── admin/
│   └── index.blade.php            # Admin dashboard
├── app/
│   ├── index.blade.php            # User app interface
│   └── profile.blade.php          # User profile
└── welcome.blade.php              # Landing page

public/
├── css/
│   └── style.css                  # Converted from Tailwind
├── background.jpg                 # Background image
└── logo.png                       # App logo
```

## API Endpoints

### Authentication
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Registration page
- `POST /register` - Process registration
- `POST /logout` - Logout

### Dashboard
- `GET /dashboard` - Main dashboard
- `GET /app` - User application interface
- `GET /profile` - User profile
- `PUT /profile` - Update profile

### Bills
- `GET /bills` - List bills
- `POST /bills` - Create bill
- `GET /bills/{id}` - View bill
- `PUT /bills/{id}` - Update bill
- `DELETE /bills/{id}` - Delete bill

### Admin (requires admin role)
- `GET /admin` - Admin dashboard
- `GET /admin/users` - Manage users
- `GET /admin/analytics` - View analytics
- `GET /admin/revenue` - Revenue reports

## Database Schema

### Users Table
- id, name, email, password, role, phone, created_at, updated_at

### Bills Table
- id, user_id, title, description, total_amount, status, created_at, updated_at

### Bill Items Table
- id, bill_id, name, price, quantity, category

### Bill Participants Table
- id, bill_id, user_id, amount_owed, paid_amount, status

### Settlements Table
- id, bill_id, payer_id, payee_id, amount, status, settled_at

### Friendships Table
- id, user_id, friend_id, status, created_at

### Item Assignments Table
- id, bill_item_id, user_id, assigned_amount

## Development

### Adding New Features

1. Create migration: `php artisan make:migration create_feature_table`
2. Create model: `php artisan make:model FeatureName`
3. Create controller: `php artisan make:controller FeatureController`
4. Add routes in `routes/web.php`
5. Create views in `resources/views/`

### CSS Styling

The project uses pure CSS converted from Tailwind configuration. Main styles are in `public/css/style.css`.

### AI/OCR Integration

The app is ready for AI integration. Configure your API keys in `.env`:
```env
OPENAI_API_KEY=your_openai_key
GOOGLE_VISION_API_KEY=your_google_vision_key
```

## Deployment

### Production Setup

1. Set environment to production in `.env`
2. Configure proper database credentials
3. Set up SSL certificate
4. Configure web server (Apache/Nginx)
5. Run optimizations:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Supabase Setup

1. Create new project in Supabase
2. Get connection details from Settings > Database
3. Update `.env` with Supabase credentials
4. Run migrations to create tables

## Contributing

1. Fork the repository
2. Create feature branch: `git checkout -b feature-name`
3. Commit changes: `git commit -am 'Add feature'`
4. Push to branch: `git push origin feature-name`
5. Submit pull request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support and questions, please contact the development team or create an issue in the repository.
