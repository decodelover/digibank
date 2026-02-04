# DigiBank - Digital Banking Platform

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

A comprehensive digital banking solution built with Laravel, offering secure online banking services including deposits, withdrawals, transfers, loans, and more.

## 🚀 Features

### Core Banking
- **Multi-Currency Wallet** - Support for multiple currencies with real-time exchange rates
- **Fund Transfers** - Send money to other users or external bank accounts
- **Wire Transfers** - International wire transfer capabilities
- **Deposits** - Multiple deposit methods with automatic and manual gateways
- **Withdrawals** - Flexible withdrawal options with configurable limits

### Investment Products
- **Fixed Deposit (FDR)** - Fixed deposit plans with competitive interest rates
- **Deposit Pension Scheme (DPS)** - Regular savings plans with maturity benefits
- **Loans** - Personal and business loan applications with approval workflow

### Payment Services
- **Bill Payments** - Pay utility bills (electricity, internet, cable, etc.)
- **Airtime & Data** - Mobile recharge and data bundle purchases
- **Virtual Cards** - Issue and manage virtual debit cards

### Security Features
- **Two-Factor Authentication (2FA)** - Google Authenticator support
- **Email OTP Verification** - Secure email verification during registration
- **KYC Verification** - Know Your Customer document verification
- **Transaction PIN** - Additional security layer for transactions

### Admin Panel
- **User Management** - Complete user administration
- **Transaction Monitoring** - Real-time transaction tracking
- **Gateway Management** - Configure payment gateways
- **Email Templates** - Customizable email notifications
- **Multi-Language Support** - Internationalization ready
- **Role-Based Access Control** - Granular permission management

## 📋 Requirements

- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer 2.x
- Node.js 16+ (for asset compilation)
- Apache/Nginx web server
- SSL Certificate (recommended for production)

### Required PHP Extensions
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- cURL
- GD

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/decodelover/digibank.git
cd digibank
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digibank
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Start the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## ⚙️ Configuration

### Email Configuration
Configure your email settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="DigiBank"
```

### Payment Gateways
The platform supports multiple payment gateways:
- Stripe
- PayPal
- Flutterwave
- Paystack
- Razorpay
- Mollie
- Coinbase
- And many more...

Configure each gateway through the Admin Panel under **Settings > Payment Gateways**.

### SMS Configuration
Enable SMS notifications by configuring Twilio in `.env`:
```env
TWILIO_SID=your_account_sid
TWILIO_AUTH_TOKEN=your_auth_token
TWILIO_FROM=your_twilio_number
```

## 📱 User Panel Features

- Dashboard with account overview
- Deposit funds via multiple gateways
- Withdraw to bank accounts
- Transfer money to other users
- Apply for loans
- Open FDR/DPS accounts
- Pay bills and buy airtime
- Manage virtual cards
- View transaction history
- Submit support tickets
- KYC document submission
- Profile and security settings

## 🔧 Admin Panel Features

- Comprehensive dashboard with analytics
- User management and verification
- Transaction monitoring and approval
- Loan/FDR/DPS management
- Payment gateway configuration
- Email and SMS template management
- Website content management
- Language and localization
- System settings and configuration
- Role and permission management

## 🎨 Themes

DigiBank includes multiple frontend themes:
- **Corporate** - Professional banking theme
- **Default** - Clean and modern design
- **DigiVault** - Modern fintech design

Switch themes from **Admin Panel > Settings > Theme**.

## 📧 Email Notifications

Automatic email notifications for:
- Account registration & verification
- Deposit confirmations
- Withdrawal requests & approvals
- Transfer confirmations
- Loan status updates
- Password reset
- Security alerts

## 🔐 Security Best Practices

1. Always use HTTPS in production
2. Enable 2FA for all admin accounts
3. Regularly update dependencies
4. Configure proper file permissions
5. Use strong database passwords
6. Enable KYC verification
7. Set appropriate transaction limits

## 📂 Project Structure

```
digibank/
├── app/                    # Application logic
│   ├── Http/Controllers/   # Controllers
│   ├── Models/             # Eloquent models
│   ├── Observers/          # Model observers
│   └── Services/           # Business logic services
├── config/                 # Configuration files
├── database/               # Migrations & seeders
├── modules/                # Payment & card modules
├── public/                 # Public assets
├── resources/              # Views & assets
│   └── views/
│       ├── backend/        # Admin panel views
│       └── frontend/       # User-facing views
├── routes/                 # Route definitions
└── storage/                # File storage
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and inquiries:
- **Email**: support@digibank.com
- **Website**: https://digibank.com

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap
- jQuery
- All payment gateway providers
- Open source community

---

**DigiBank** - Secure, Fast, and Reliable Digital Banking

© 2026 DigiBank. All Rights Reserved.
