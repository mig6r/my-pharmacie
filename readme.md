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

###  📦 Installing dependencies 

```bash
composer install
```

###  🗃 Create the database

* Edit your ".env" file to populate your database login information (you can use an additional ".env.local" file)

* Create your database with Doctrine :

```bash
php bin/console doctrine:database:create
```

* Fill in the database :

> Be carreful to remove files in Migration folder before 

````bash
php bin/console make:migration
php bin/console migrate

````
## Copyright

This project is licensed under the MIT License - see the [license](LICENSE) file for details.