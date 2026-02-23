========================================
  FITFLEX - GYM MANAGEMENT SYSTEM
========================================

A modern, professional gym management system built with Symfony 6

GitHub: https://github.com/hamayari/fitflex-gym-management
Author: Hamayari
License: MIT

========================================
ABOUT THE PROJECT
========================================

FitFlex is a comprehensive gym management system designed to streamline 
operations for fitness centers. It provides a complete solution for managing 
members, subscriptions, classes, equipment, events, and more.

KEY HIGHLIGHTS:
- Modern UI/UX with professional, responsive design
- Secure authentication with role-based access control (Admin/User)
- Real-time dashboard analytics and insights
- Mobile responsive - works seamlessly on all devices
- French interface with easy localization
- Fast & efficient - optimized with Symfony best practices

========================================
FEATURES
========================================

USER MANAGEMENT:
- Complete CRUD operations for users
- Role-based permissions (Admin/User)
- Profile management with avatar upload
- User statistics and analytics

GYM OPERATIONS:
- Equipment Management - Track and manage gym equipment
- Activity Management - Create and schedule fitness activities
- Class Reservations - Members can book classes online
- Event Management - Organize gym events and competitions

SUBSCRIPTION & BILLING:
- Multiple subscription types
- Subscription management
- Payment tracking
- Offer management with special deals

E-COMMERCE:
- Product catalog for gym merchandise
- Shopping cart functionality
- Order management
- Invoice generation (PDF)

COMMUNITY:
- Forum/Blog system for posts
- Comments and discussions
- Member interactions

ADMIN DASHBOARD:
- Real-time statistics
- User analytics
- Revenue tracking
- Activity monitoring

========================================
TECH STACK
========================================

BACKEND:
- Framework: Symfony 6.x
- Language: PHP 8.1+
- Database: MySQL 8.0
- ORM: Doctrine
- Authentication: Symfony Security Component

FRONTEND:
- CSS Framework: Bootstrap 5.3
- Icons: Font Awesome 6
- JavaScript: Vanilla JS + jQuery
- Charts: Chart.js
- DataTables: Simple DataTables

ADDITIONAL LIBRARIES:
- PDF Generation: KnpSnappy
- QR Codes: Endroid QR Code
- Email: SwiftMailer
- Forms: Symfony Forms with custom themes

========================================
INSTALLATION
========================================

PREREQUISITES:
- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Node.js & npm (optional)

STEP 1: Clone the Repository
git clone https://github.com/hamayari/fitflex-gym-management.git
cd fitflex-gym-management

STEP 2: Install Dependencies
composer install

STEP 3: Configure Environment
cp .env .env.local
# Edit .env.local and configure your database
DATABASE_URL="mysql://username:password@127.0.0.1:3306/fitflex_db"

STEP 4: Create Database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

STEP 5: Start the Server
# Using Symfony CLI (recommended)
symfony server:start

# Or using PHP built-in server
php -S localhost:8000 -t public

STEP 6: Access the Application
- Frontend: http://localhost:8000
- Login: http://localhost:8000/login
- Admin Dashboard: http://localhost:8000/user

DEFAULT CREDENTIALS:
Admin Account:
  Email: admin@fitflex.com
  Password: admin123

User Account:
  Email: user@fitflex.com
  Password: user123

========================================
PROJECT STRUCTURE
========================================

fitflex-gym-management/
├── config/              # Configuration files
├── public/              # Public assets
│   ├── BackOffice/     # Admin panel assets
│   └── FrontOffice/    # Frontend assets
├── src/
│   ├── Controller/     # Application controllers
│   ├── Entity/         # Doctrine entities
│   ├── Form/           # Form types
│   └── Repository/     # Database repositories
├── templates/          # Twig templates
│   ├── backend/        # Admin templates
│   ├── frontend/       # Frontend templates
│   └── security/       # Authentication templates
├── var/                # Cache and logs
└── vendor/             # Composer dependencies

========================================
CONFIGURATION
========================================

DATABASE CONFIGURATION:
Edit .env.local:
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0"

EMAIL CONFIGURATION:
MAILER_DSN=smtp://user:pass@smtp.example.com:587

SECURITY:
The application uses Symfony's security component with bcrypt password 
hashing. Configuration is in config/packages/security.yaml.

========================================
USAGE
========================================

CREATING A NEW USER:
1. Navigate to Admin Dashboard
2. Click "Users" in the sidebar
3. Click "Add New User"
4. Fill in the form and submit

MANAGING SUBSCRIPTIONS:
1. Go to "Type Abonnements"
2. Create subscription types with pricing
3. Users can subscribe from the frontend

BOOKING CLASSES:
1. Users log in to their account
2. Navigate to "Reservations"
3. Select a class and book

========================================
SECURITY FEATURES
========================================

- CSRF Protection enabled
- Password hashing with bcrypt
- SQL Injection prevention via Doctrine ORM
- XSS Protection with Twig auto-escaping
- Role-based access control
- Secure session management

========================================
MODULES
========================================

1. User Management - Complete user CRUD with roles
2. Equipment Management - Track gym equipment
3. Activity Management - Fitness activities and classes
4. Event Management - Gym events and competitions
5. Subscription Management - Multiple subscription types
6. Reservation System - Class booking system
7. Offer Management - Special deals and promotions
8. Product Catalog - Gym merchandise
9. Order Management - E-commerce orders
10. Blog/Forum - Posts and comments
11. Category Management - Organize content
12. Dashboard Analytics - Real-time statistics

========================================
API DOCUMENTATION
========================================

The application provides RESTful endpoints for:
- User management
- Subscription handling
- Reservation system
- Product catalog

Documentation available at /api/doc when in dev mode.

========================================
CONTRIBUTING
========================================

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (git checkout -b feature/AmazingFeature)
3. Commit your changes (git commit -m 'Add some AmazingFeature')
4. Push to the branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

CODING STANDARDS:
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

========================================
BUG REPORTS
========================================

If you discover a bug, please create an issue on GitHub with:
- Clear description of the bug
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)
- Environment details (PHP version, OS, etc.)

========================================
LICENSE
========================================

This project is licensed under the MIT License.

Copyright (c) 2026 Hamayari

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.

========================================
AUTHOR
========================================

Hamayari
GitHub: https://github.com/hamayari

========================================
ACKNOWLEDGMENTS
========================================

- Symfony Framework Team
- Bootstrap Team
- Font Awesome
- All contributors and supporters

========================================
SUPPORT
========================================

For support, create an issue on GitHub:
https://github.com/hamayari/fitflex-gym-management/issues

========================================

Made with ❤️ and Symfony

⭐ Star this repo if you find it helpful!

========================================
