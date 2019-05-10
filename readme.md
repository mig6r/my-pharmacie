# ⚕ Managing your personal Pharmacy ⚕
My first Symfony 4 project.

Design with bootstrap and using webPack encore


## 🎨 Demo

Coming soon

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

* Edit your ".env" file to populate your database login information (you can use an additional ".env.local" file)

* Create your database with Doctrine :

```bash
php bin/console doctrine:database:create
```

* Fill in the database :

> Be carreful to remove files in src/migration folder before 

````bash
php bin/console make:migration
php bin/console migrate

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