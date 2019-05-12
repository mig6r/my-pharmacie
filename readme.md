# ⚕ Manage your personal Pharmacy ⚕
My first Symfony 4 project.

Design with bootstrap and using webPack encore


## 🎨 Demo

<https://pharmacy.digimig.fr>

## 💊 Features

### Operating:
* Multi users
* Adding users to a family or create family
* Category drug management
* Groups drug management
* Symptoms drug management
* Filter drug

### Coming up
* Inventory management
* Date of expiry
* Location management
* Medicine Ordinance Management
* API
* Add drug with Open-medicaments.fr


## ⚙ Install

### 📐 Edit the .env file (or add an env.local)

* Link to the database
>DATABASE_URL=mysql://USERNAME:PASSWORD@127.0.0.1:3306/NEWDBNAME
* Configure mailer
>MAILER_URL=smtp://USERNAME:PASSWORD@SERVER_ADRESS:PORT?timeout=60&encryption=ENCRYPTION_METHOD&auth_mode=login
* Api keys for contact form
>GOOGLE_RECAPTCHA_KEY=your_key

>GOOGLE_RECAPTCHA_SECRET=your_secret_key

###  📦 Installing dependencies and build

```bash
composer install
```

```bash
yarn install
```

```bash
encore dev
```



###  🗃 Create the database


* Create your database with Doctrine :

```bash
php bin/console doctrine:database:create
```

* Fill in the database :

> Be carreful to remove files in src/migration folder before 

````bash
php bin/console make:migration
php bin/console migrate
php bin/console doctrine:fixtures:load --append

````

### 🎉 Start The application

```bash
php bin/console server:run

```

> Go to http://localhost:8000

> Create your account (No confirmation needed)

> Log In

## Copyright

This project is licensed under the MIT License - see the [license](LICENSE) file for details.