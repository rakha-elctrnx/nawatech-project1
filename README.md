
# Nawatech Test

This application is made to complete the test given on the application requirements.




## Installation

Install Package

```bash
  composer install
  npm install
```

Setup .env

```bash
//Database Connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

//Mail Server Setup
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
```

Migration & Seeding

```bash
php artisan migrate --seed
```

Running App

```bash
npm run dev
php artisan key:generate
php artisan serve
```

    
## User Account

| Role             | Email                        | Password |
| ----------------- | ------------------------------------- | --------------------------- |
| Admin | admin@admin.com | 12345678 |
| User | user@user.com | 12345678 |


## Information

**Tech Stack:** Laravel 10, VueJS 3, Inertia

**Database Documentation:** is in the root folder '**database-doc.pdf**'

