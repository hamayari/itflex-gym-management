# 🏋️ FitFlex - Complete Gym Management Solution

> A modern, enterprise-grade gym management platform built with Symfony 6. Streamline your fitness center operations with powerful member management, automated subscriptions, class scheduling, and integrated e-commerce.

[![Symfony](https://img.shields.io/badge/Symfony-6.x-000000?style=flat&logo=symfony)](https://symfony.com)
[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat&logo=bootstrap)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 🎯 Overview

FitFlex is a comprehensive gym management system designed to digitalize and optimize fitness center operations. From member onboarding to subscription management, class scheduling to equipment tracking, FitFlex provides everything you need to run a modern fitness facility.

### 🌟 Key Highlights

- **All-in-One Platform**: Manage members, subscriptions, classes, equipment, and sales from a single dashboard
- **Mobile-First Design**: Responsive interface that works seamlessly on all devices
- **Automated Workflows**: SMS notifications, automated billing, and smart scheduling
- **Secure & Scalable**: Built on Symfony framework with enterprise-grade security
- **Multi-Language Ready**: French interface with easy localization support
- **Professional UI/UX**: Modern, intuitive design for both staff and members

---

## ✨ Core Features

### 👥 Member Management
- **Digital Registration**: Streamlined member onboarding with form validation
- **Profile Management**: Complete member profiles with photos and activity history
- **Role-Based Access**: Granular permissions for admins, staff, and members
- **Activity Tracking**: Monitor member engagement and attendance

### 💳 Subscription System
- **Flexible Plans**: Create unlimited subscription types (monthly, quarterly, annual)
- **SMS Verification**: Secure subscription activation via Twilio integration
- **QR Code Generation**: Digital membership cards with QR codes
- **Auto-Renewal**: Automated subscription management and reminders
- **Analytics Dashboard**: Real-time subscription metrics and revenue tracking

### 📅 Class & Activity Management
- **Smart Scheduling**: Visual calendar with drag-and-drop scheduling
- **Category System**: Organize activities by type (Yoga, CrossFit, Cardio, etc.)
- **Capacity Management**: Set limits and track attendance
- **Coach Assignment**: Validate coach availability and prevent conflicts
- **Member Reservations**: Online booking system with instant confirmation
- **Waitlist Management**: Automatic notifications when spots open up

### 🏋️ Equipment Tracking
- **Inventory Management**: Complete equipment database with categories
- **Maintenance Scheduling**: Track service dates and maintenance history
- **Status Monitoring**: Real-time equipment availability
- **Excel Export**: Generate inventory reports

### 🎉 Events & Promotions
- **Event Management**: Create and manage special events, workshops, and competitions
- **Participant Registration**: Online sign-ups with capacity limits
- **Event Calendar**: Integrated calendar view
- **Special Offers**: Time-limited promotions with automated expiration
- **PDF Generation**: Professional offer documents and certificates

### 🛒 E-Commerce Integration
- **Product Catalog**: Sell supplements, merchandise, and equipment
- **Shopping Cart**: Full-featured cart with session management
- **Order Management**: Track orders from placement to delivery
- **Category System**: Organize products for easy browsing
- **Search & Filters**: Help members find products quickly

### 📊 Analytics & Reporting
- **Revenue Dashboard**: Real-time financial metrics
- **Member Statistics**: Growth trends and retention rates
- **Activity Reports**: Popular classes and peak hours
- **Export Capabilities**: Excel and PDF report generation

### 📱 Communication Tools
- **SMS Notifications**: Automated messages via Twilio (class reminders, subscription alerts)
- **Email System**: Transactional emails with SwiftMailer
- **Blog Platform**: Share fitness tips, news, and updates
- **Comment System**: Member engagement and feedback

---

## 🛠️ Technology Stack

### Backend
- **Framework**: Symfony 6.x (PHP 8.0+)
- **ORM**: Doctrine for database management
- **Security**: Symfony Security component with bcrypt hashing
- **Validation**: Symfony Validator with custom constraints

### Frontend
- **UI Framework**: Bootstrap 5
- **JavaScript**: jQuery, Chart.js for analytics
- **Icons**: FontAwesome 5
- **Responsive**: Mobile-first design approach

### Database
- **RDBMS**: MySQL 8.0
- **Migrations**: Doctrine Migrations for version control

### Integrations
- **SMS**: Twilio API for notifications
- **PDF**: KnpSnappy (wkhtmltopdf) for document generation
- **QR Codes**: Endroid QR Code Bundle
- **Email**: SwiftMailer
- **Security**: Google reCAPTCHA v2

---

## 📋 Requirements

- **PHP**: 8.0 or higher
- **Composer**: Latest version
- **MySQL**: 8.0 or higher
- **Web Server**: Apache/Nginx with mod_rewrite
- **wkhtmltopdf**: For PDF generation
- **Node.js & npm**: For asset compilation (optional)

---

## 🚀 Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/hamayari/itflex-gym-management.git
cd itflex-gym-management
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the environment template:
```bash
cp .env.example .env
```

Edit `.env` and configure the following:

```env
# Database Configuration
DATABASE_URL="mysql://username:password@127.0.0.1:3306/fitflex_db?serverVersion=8.0"

# Application Secret (generate a random string)
APP_SECRET=your_random_secret_key_here

# Twilio SMS Configuration (optional - for SMS features)
TWILIO_ACCOUNT_SID=your_twilio_account_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_PHONE_NUMBER=+1234567890

# Email Configuration
MAILER_DSN=smtp://user:password@smtp.example.com:587

# Google reCAPTCHA (optional - for form protection)
GOOGLE_RECAPTCHA_SITE_KEY=your_site_key
GOOGLE_RECAPTCHA_SECRET_KEY=your_secret_key

# PDF Generation
WKHTMLTOPDF_PATH=/usr/local/bin/wkhtmltopdf
WKHTMLTOIMAGE_PATH=/usr/local/bin/wkhtmltoimage
```

### 4. Create Database

```bash
php bin/console doctrine:database:create
```

### 5. Run Migrations

```bash
php bin/console doctrine:migrations:migrate
```

### 6. Create Admin User

```bash
php bin/console app:create-admin
```

Follow the prompts to create your first administrator account.

### 7. Load Sample Data (Optional)

```bash
php bin/console doctrine:fixtures:load
```

### 8. Start Development Server

Using Symfony CLI (recommended):
```bash
symfony server:start
```

Or using PHP built-in server:
```bash
php -S localhost:8000 -t public
```

### 9. Access the Application

- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin

---

## 📁 Project Structure

```
├── config/              # Application configuration
│   ├── packages/       # Bundle configurations
│   └── routes/         # Routing definitions
├── migrations/         # Database migrations
├── public/             # Web root
│   ├── BackOffice/    # Admin panel assets
│   └── FrontOffice/   # Public website assets
├── src/
│   ├── Controller/    # Application controllers
│   ├── Entity/        # Doctrine entities
│   ├── Form/          # Form types
│   ├── Repository/    # Database repositories
│   └── Service/       # Business logic services
├── templates/         # Twig templates
│   ├── backend/       # Admin templates
│   └── frontend/      # Public templates
├── tests/             # Unit and functional tests
├── var/               # Cache and logs
└── vendor/            # Composer dependencies
```

---

## 🔐 Security Features

- **Password Hashing**: Bcrypt algorithm with salt
- **CSRF Protection**: Token-based form protection
- **SQL Injection Prevention**: Doctrine ORM parameterized queries
- **XSS Protection**: Twig auto-escaping
- **Role-Based Access Control**: Symfony Security voters
- **Session Security**: Secure session handling
- **Environment Variables**: Sensitive data stored securely

---

## 🌐 Key Routes

### Public Routes
- `/` - Homepage
- `/login` - User authentication
- `/register` - New member registration
- `/activites` - Browse activities and classes
- `/event` - Upcoming events
- `/abonnement` - Subscription plans

### Admin Routes (requires authentication)
- `/admin` - Dashboard with analytics
- `/admin/user` - Member management
- `/admin/event` - Event management
- `/admin/equipement` - Equipment inventory
- `/admin/activites` - Activity scheduling
- `/admin/offer` - Promotions management
- `/admin/type_abonn` - Subscription types
- `/admin/produit` - Product catalog
- `/admin/commande` - Order management


## Project Structure

```
├── config/              # Application configuration
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


---

## 🧪 Testing

Run the test suite:
```bash
php bin/phpunit
```

Run specific tests:
```bash
php bin/phpunit tests/Controller/UserControllerTest.php
```

---

## 🚢 Deployment

### Production Checklist

- [ ] Set `APP_ENV=prod` in `.env`
- [ ] Set `APP_DEBUG=0` in `.env`
- [ ] Generate a strong `APP_SECRET`
- [ ] Configure production database
- [ ] Set up SSL certificate (HTTPS)
- [ ] Configure email service
- [ ] Set up SMS service (Twilio)
- [ ] Configure backup strategy
- [ ] Set up monitoring and logging
- [ ] Review and update security settings
- [ ] Clear cache: `php bin/console cache:clear --env=prod`
- [ ] Warm up cache: `php bin/console cache:warmup --env=prod`

### Recommended Hosting

- **VPS**: DigitalOcean, Linode, AWS EC2
- **Shared Hosting**: Compatible with most PHP hosting providers
- **Platform as a Service**: Platform.sh, Heroku (with buildpacks)

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on:
- Code of conduct
- Development workflow
- Pull request process
- Coding standards

### Quick Start for Contributors

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes
4. Run tests: `php bin/phpunit`
5. Commit: `git commit -m 'feat: Add amazing feature'`
6. Push: `git push origin feature/amazing-feature`
7. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- [Symfony](https://symfony.com) - The PHP framework for web applications
- [Bootstrap](https://getbootstrap.com) - Frontend toolkit
- [FontAwesome](https://fontawesome.com) - Icon library
- [Doctrine](https://www.doctrine-project.org) - PHP ORM
- [Twilio](https://www.twilio.com) - SMS API
- All open-source contributors

---

## 📞 Support

- **Issues**: [GitHub Issues](https://github.com/hamayari/itflex-gym-management/issues)
- **Discussions**: [GitHub Discussions](https://github.com/hamayari/itflex-gym-management/discussions)
- **Documentation**: Check the `/docs` folder for detailed guides

---

## 🗺️ Roadmap

### Upcoming Features
- [ ] Mobile app (React Native)
- [ ] Payment gateway integration (Stripe, PayPal)
- [ ] Advanced analytics dashboard
- [ ] Multi-gym support (franchise management)
- [ ] Member mobile app
- [ ] Biometric check-in
- [ ] Nutrition tracking
- [ ] Personal trainer scheduling
- [ ] Video streaming for online classes
- [ ] API for third-party integrations

---

## 📸 Screenshots

### Admin Dashboard
![Admin Dashboard](docs/screenshots/admin-dashboard.png)

### Member Portal
![Member Portal](docs/screenshots/member-portal.png)

### Class Scheduling
![Class Scheduling](docs/screenshots/class-scheduling.png)

---

## 💡 Use Cases

### Fitness Centers
Complete management solution for traditional gyms and fitness centers

### Yoga Studios
Class scheduling and membership management for yoga and pilates studios

### CrossFit Boxes
WOD scheduling, member tracking, and equipment management

### Sports Clubs
Multi-activity management with event organization

### Personal Training Studios
Client management and session scheduling

---

<div align="center">

**Built with ❤️ using Symfony**

[⬆ Back to Top](#-fitflex---complete-gym-management-solution)

</div>
