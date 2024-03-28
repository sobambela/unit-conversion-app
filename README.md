
## Unit Conversion - Front End

---
Framework Skeleton:
https://github.com/rasrecruits/unit-conversion-app  <-- You are here

Composer Package: https://github.com/rasrecruits/unit-conversion-objects


### Overview

This repository forms part of a practical assessment that is split into two parts (and two repositories), a bare Laravel Application where you
must add application logic explained below, and a composer based library package that is part of the application dependencies and
loaded from repository for development. You will be working in both these to successfully complete the assessment.

#### Part One
The first part requires you to create the views with the required forms and controller logic to enable the application
for user authentication and access to the system. You are required to create and define the database migrations to create the database structure that will be used to authenticate users and allow access to protected pages within and throughout the application. You must define and create the required model objects and configure the model object relationship mappings,
based on the database structure, and also configure the environment file to enable MySQL Database support.

Front-end work is not super important, but should also not be completely neglected. You are free to make use of front-end libraries such as bootstrap and
jquery. Minified production ready assets and techniques to reduce front end load time will count in your favour.

For backend challenges and requirements you are also free to use any supporting open-source composer based packages to accomplish the requirements, but the
more code you use that is not your own, the less your skills will be visible and the lower your chances of successfully
completing the practical assessment.

#### Functional Requirements

**A user should be able to:**

- **Register** for an account
- **Verify and activate** the account
- **Log in**
- **Update profile** information
- **Reset the account password**
- **View Unit Conversion History** Record listings
- **Use the Unit Conversion form**
- **Log out**

The fields and data that you decide to capture is at your own discretion, but must at a minimum capture First Name,
Last Name and Email Address (used as username when logging in). Field and data validation is imperative, and proper
error handling must be correctly implemented.

**User Roles and Permissions:**

- **User roles** must be implemented and assignable to user accounts.
- A user can be assigned to **multiple roles.**
- A role can contain **one or more permissions**.
- A minimum of **two User roles must be created** for **Administrators** and **Users** respectively.
- An administrator can **view/modify/register/activate and deactivate** other user accounts.
- An administrator **cannot modify other administrator accounts**.
- An administrator **can create and manage roles and permissions**.

All CRUD operations should be clearly defined and thoroughly documented.

The final stage of the first part requires an additional view containing a form that can be used to convert units using AJAX where unit conversions can be done and by making use of the API endpoint noted in part 2 of this documentation. The view must contain a data table that uses pagination to display a history log of conversions. Every successful unit conversion request made to the server must be stored in the database, and displayed in the history log listing containing the source and target unit details and audit field values.

#### Part Two

This repository was created using the composer based Laravel installer. Aside from the composer dependency requirements
listed in the composer.json file, the installation is bare as if you've just installed Laravel for the first time, except
for the following changes that's been added:

- In routes/api.php, we've added a single route that provides an API endpoint to convert units. The route is not
  protected, and can remain unprotected for the purpose of this exercise. You can make use of an API Client such
  as Postman to test the endpoint, and the following data can be added to the request body to receive a successful
  response. This route should be available at **/api/convert** as soon as the application has been installed, with, or without functionality
  noted above, however, the package will produce error output until the package logic has been added as required.
```
{
    "from": "kilometer",
    "to": "mile",
    "value": 6.45
}
```

- A controller has been added in app/Http/Controllers/ConversionServiceApiController, used by the route above to
  handle logic on the API Endpoint.
- The logic and functionality in the controller is dependent on the Composer Package that
  you need to install from repository. See the installation instructions below for details. Once you have the
  composer library package configured for local development, you must follow the information provided in the
  package README.md for an understanding of the requirements. API Controller logic must then be amended to accomodate any
  changes made to the package.


### System Requirements

- You can do the development work in any compatible environment, but it is important to understand that
  the code committed for review must conform to a production ready, deployable system that will run effortlessly on **Ubuntu Server 22.04**, **MySQL Server** and **Apache2** (Or Ngnix should your prefer). **PHP 8.1** is a dependency requirement in composer.json, and at the time of development, **Composer 2.5.5** was used. It is for this reason also important to understand the instructions provided
  in this documentation is based on this environment, and where things may not work as expected during setup for
  local development, it is up to you to find alternative ways to get the job done.

### Installation and Setup Instructions

This repository and the Composer Package library repository has both been configured as GitHub Template Repositories. To successfully execute installation commands below, you should first create repositories in your own github account, using GitHub's built in "Use this Template" functionality. You can do this by clicking the "Use this template" button at the top of the page. Follow the instructions for both repositories, and once they both exist on your account you can continue below. We advise that you keep the repository names the same to ease setup.

#### Clone Source code for local development

The commands provided below can be used as reference, but you will need to change where required to suit your environment and needs
- First, clone the package repository from your github account for local development:

```
cd /PATH/TO/PACKAGES
git clone git@github.com:YOUR_USER/unit-conversion-objects.git
```

- Next, clone the skeleton application base repository from your github account.

```
cd /PATH/TO/WEBAPPS
git clone git@github.com:YOUR_USER/unit-conversion-app.git
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
        "type": "vcs",
        "url": "git@github.com:RhinoAfrica/unit-conversion-objects.git"
    }
]
```

And change it to look similar to this:
```
"repositories": [
    {
      "type": "path",
      "url": "/PATH/TO/PACKAGES/unit-conversion-objects",
      "options": {
          "symlink": true
       }
     }
]
```

Finally, run composer install and if everything went smoothly, you should be ready to get hacking! Optionally, also run php artisan serve to confirm that the application is running without error.

```
composer install
cp .env.example .env
php artisan key:generate
```

The application should be accessible immediately by running the **artisan serve** command, but you will be welcomed by the default Laravel front page when launched in your web browser. At this point, this really just serves as additional confirmation of a functional installation.

```
php artisan serve
```

### Next

Once installation and development setup has completed, you can continue with the assessment requirements outlined above. Once you're happy, you can commit your code and provide us with access to your code for review.

To jump straight into package development, for details about the requirements for the composer library handling unit conversions, please see the README.md included in the source or go here: https://github.com/rasrecruits/unit-conversion-objects

### Support
While we hope you are in the position to face a challenge and to figure things out when they
don't work according to how you would expect, we understand that tasks like these can take
time. If you struggle with installation, setup or anything in documentation is confusing you,
please feel free to reach out at us directly at quintin@rhinoafrica.com. I will be happy to
assist to keep you moving.

### Final Guidelines and Considerations

- We've estimated the assessment to take anything between 6 - 8 hours to complete. You should understand that we do not expect more of your time than that and if you're done in 3 hours, then great! But if you choose to complete it over a period of 2 to 4 days, we're not going to be breathing down your neck, so
  take your time, and put in the effort.
- A lot of emphasis have been put on having to create unit tests for application and library functional tests. While we're more interested in your code than watching test cases run, in a real world scenario, such things are but a nice to have. We will not hate you if you didn't get around to it.
- The amount of effort you put in would provide a great level of understanding of your abilities in using Laravel, and keeping it to the bare minimum may reduce your chances, however you should also keep it as simple as possible with extensive documentation that should prove a fluent understanding of the code you write. Follow the SOLID and KISS design principals where and when possible.
