# FitFlex Gym Management System

A modern, professional gym management system built with Symfony 6. Features member management, subscriptions, class bookings, equipment tracking, events, and e-commerce functionality with a responsive Bootstrap 5 interface.

## Features

### Member Management
- User registration and authentication with bcrypt password hashing
- Role-based access control (Admin/User)
- User profile management
- Member activity tracking

### Subscription Management
- Multiple subscription types
- SMS verification via Twilio integration
- QR code generation for subscriptions
- Subscription statistics and analytics

### Class & Activity Management
- Activity categories and scheduling
- Class reservations with coach availability validation
- Calendar view for class schedules
- Activity search and filtering

### Equipment Management
- Equipment inventory tracking
- Equipment categories
- Maintenance scheduling
- Excel export functionality

### Events Management
- Event creation and management
- Event types and categories
- Participant registration
- Event calendar integration

### E-Commerce
- Product catalog with categories
- Shopping cart functionality
- Order management
- Product search and filtering

### Offers & Promotions
- Special offers management
- Offer reservations
- PDF generation for offers
- Statistics and analytics

### Blog & Content
- Blog post management
- Comments system
- Content categorization

## Technology Stack

- **Framework**: Symfony 6.x
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5, jQuery, FontAwesome
- **Authentication**: Symfony Security with bcrypt
- **SMS**: Twilio API
- **PDF Generation**: KnpSnappy (wkhtmltopdf)
- **QR Codes**: Endroid QR Code
- **Email**: SwiftMailer
- **Captcha**: Google reCAPTCHA

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL 8.0 or higher
- Node.js & npm (for asset compilation)
- wkhtmltopdf (for PDF generation)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/hamayari/itflex-gym-management.git
cd itflex-gym-management
```

2. Install PHP dependencies:
```bash
composer install
```

3. Configure environment variables:
```bash
cp .env.example .env
```

Edit `.env` and configure:
- Database connection (DATABASE_URL)
- Twilio credentials (TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_PHONE_NUMBER)
- Mailer settings (MAILER_DSN)
- Google reCAPTCHA keys
- App secret (APP_SECRET)

4. Create database and run migrations:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Load fixtures (optional):
```bash
php bin/console doctrine:fixtures:load
```

6. Start the development server:
```bash
symfony server:start
```

Or use PHP built-in server:
```bash
php -S localhost:8000 -t public
```

## Default Access

### Admin Account
- Email: admin@fitflex.com
- Password: admin123

### User Account
- Email: user@fitflex.com
- Password: user123

**Important**: Change these credentials in production!

## Project Structure

```
├── config/              # Configuration files
├── migrations/          # Database migrations
├── public/              # Public assets
│   ├── BackOffice/     # Admin panel assets
│   └── FrontOffice/    # Frontend assets
├── src/
│   ├── Controller/     # Application controllers
│   ├── Entity/         # Doctrine entities
│   ├── Form/           # Form types
│   ├── Repository/     # Database repositories
│   └── Service/        # Business logic services
├── templates/          # Twig templates
│   ├── backend/        # Admin templates
│   └── frontend/       # Public templates
└── tests/              # Unit and functional tests
```

## Key Routes

### Frontend
- `/` - Homepage
- `/login` - User login
- `/register` - User registration
- `/forgot-password` - Password reset
- `/activites` - Activities listing
- `/event` - Events listing
- `/abonnement` - Subscriptions

### Backend (Admin)
- `/admin` - Admin dashboard
- `/admin/user` - User management
- `/admin/event` - Event management
- `/admin/equipement` - Equipment management
- `/admin/activites` - Activities management
- `/admin/offer` - Offers management
- `/admin/type_abonn` - Subscription types
- `/admin/produit` - Product management
- `/admin/commande` - Order management

## Security

- CSRF protection enabled
- Password hashing with bcrypt
- Role-based access control
- SQL injection prevention via Doctrine ORM
- XSS protection via Twig auto-escaping
- Environment variables for sensitive data

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please open an issue in the GitHub repository.

## Acknowledgments

- Symfony framework and community
- Bootstrap team
- All open-source contributors

---

**Note**: This is a development version. For production deployment, ensure proper security configurations, change default credentials, and follow Symfony deployment best practices.
