
## Unit Conversion - Front End

### Overview

This front end app uses **Laravel 10x** with **Vue JS**.
Asynchronous processes use **axios**.
The databse is **MySql**.

#### Included Functionality

**A user is able:**

- **Register** for an account
- **Log in**
- **Update profile** information
- **Reset the account password**
- **View Unit Conversion History** Record listings
- **Use the Unit Conversion form**
- **Log out**

**To Do**
- **Verify and activate** the account
- **User Roles and Permissions** 

#### Routes

For the included functionality, the following routes have been added to **/routes/web.php**. Links to these are located on the header.
```
/convert        // Takes you to the Conversion form
/history        // Takes you to the View History paeg
/get-history    // Used to pull in the History asynchronously via axios
```
The Conversion Form makes an POST request to **/api/convert** located in **/routes/api.php**. The payload for the request is as follows:
```
{
    "from": "kilometer",
    "to": "mile",
    "value": 6.45
}
```

#### Views

The Convert and View history views embed Vue JS components located in the directory **/resources/js/components**

### System Requirements

The application was developed and test using the environment below:
- **Ubuntu Server 22.04**
- **MySQL Server**
- **Apache2** 
- **PHP 8.1**
- **Composer** 

### Installation and Setup Instructions

#### Clone Source code for local development

The commands provided below can be used as reference, but you will need to change where required to suit your environment and needs
- First, clone the package repository from my github account for local development:

```
cd /PATH/TO/PACKAGES
git clone git@github.com:sobambela/unit-conversion-objects.git
```

- Next, clone the application repository from my github account.

```
cd /PATH/TO/WEBAPPS
git clone git@github.com:sobambela/unit-conversion-app.git
```

Next, edit composer.json in the application root to instruct composer to load the package source from
a local path for development.
```
cd /PATH/TO/WEBAPPS/unit-conversion-app
nano composer.json
```

Locate the repository configuration which should look like this:
```
"repositories": [
    {
      "type": "path",
      "url": "../unit-conversion-objects",
      "options": {
          "symlink": true
       }
    }
]
```

And change it to look similar to this:
```
"repositories": [
    {
      "type": "path",
      "url": "/PATH/TO/YOUR/PACKAGES/unit-conversion-objects",
      "options": {
          "symlink": true
      }
    }
]
```

Run composer install. Then you will need to configure the database information before running the migrations. After you should be ready to serve the application.

```
composer install
cp .env.example .env
php artisan key:generate
```
In the **.env** update the database information to reflect your own.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rhino_sa
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan migrate
php artisan serve
```
