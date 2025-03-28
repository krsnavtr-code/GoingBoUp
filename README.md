# GoingBo.com

A Laravel-based web application.

## Project Overview

This is a Laravel-based web application designed to provide [insert brief description of the application's purpose].

## Technologies Used

- Laravel Framework ^10.10
- PHP ^8.1
- Vite for asset compilation
- RazorPay for payment processing
- Reliese for database migrations
- Laravel Sanctum for API authentication
- Vue.js (via Vite)
- Axios for HTTP requests

## Key Features

- Payment integration with RazorPay
- RESTful API with Laravel Sanctum
- Modern frontend with Vue.js and Vite
- Database migrations and seeding
- API documentation
- User authentication and authorization

## Requirements

- PHP >= 8.1
- Composer
- Node.js and npm
- MySQL/MariaDB
- Apache/Nginx web server

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd goingbo_com
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file and configure it:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Compile assets:
```bash
npm run dev
```

8. Start the development server:
```bash
php artisan serve
```

## Project Structure

```
goingbo_com/
├── app/                 # Core application code
├── bootstrap/           # Application bootstrap
├── config/             # Configuration files
├── database/           # Database migrations and seeds
├── public/             # Public assets and entry point
├── resources/          # Views, assets, and translations
├── routes/             # Route definitions
├── storage/            # Application storage
├── tests/              # Test suite
└── vendor/             # Composer dependencies
```

## Configuration

The main configuration file is located at `.env`. Key settings include:

- Database connection details
- Application key
- Mail settings
- Cache configuration
- Queue configuration

## Additional Configuration

### Payment Gateway

- RazorPay integration requires API keys in the `.env` file:
```env
RAZORPAY_KEY_ID=your_key_id
RAZORPAY_KEY_SECRET=your_key_secret
```

### Database

- The project uses MySQL/MariaDB
- Database migrations are located in `database/migrations`
- Seeders are available in `database/seeders`

### API Documentation

API documentation is available at `/api/documentation` after installation.

### Environment Variables

Additional important environment variables:

```env
APP_URL=http://localhost
APP_DEBUG=true
APP_LOG_LEVEL=debug

DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

## Development

### Running Tests

```bash
php artisan test
```

### Running Development Server

```bash
php artisan serve
```

### Compiling Assets

```bash
npm run dev
```

For production:
```bash
npm run build
```

## Troubleshooting

### Common Issues

1. **Database Connection**
   - Ensure MySQL/MariaDB is running
   - Verify database credentials in `.env`
   - Run migrations: `php artisan migrate`

2. **Asset Compilation**
   - Ensure Node.js and npm are installed
   - Run `npm install` first
   - Use `npm run dev` for development
   - Use `npm run build` for production

3. **Payment Gateway**
   - Verify RazorPay API keys
   - Check payment logs in storage/logs
   - Ensure proper SSL configuration

## Security

- All sensitive data should be stored in the `.env` file
- Never commit your `.env` file to version control
- Regular security updates are recommended

## License

[Insert license information here]

## Support

For support, please contact [support email] or open an issue in the repository.

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Acknowledgments

- Laravel Framework
- Composer
- npm
- All contributors and users
