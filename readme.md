#LaravelCP
#####A modular control panel written in PHP using Laravel 4, jQuery 2, Bootstrap 3 & FontAwesome 4. (starter site)
[![Build Status](https://travis-ci.org/gcphost/laravelcp.png)](https://travis-ci.org/gcphost/laravelcp)
Follow us  [@laravelcp](https://twitter.com/laravelcp), [laravelcp.com](http://laravelcp.com), original fork from [laravel4-starter-kit](https://github.com/andrewelkins/Laravel-4-Bootstrap-Starter-Site)


![ScreenShot](http://i.imgur.com/DduoG9F.png)

[More Screenshots](https://github.com/gcphost/l4-bootstrap-admin/wiki/Screenshots)


# Features
- jQuery 2.1.1, Bootstrap 3.1.1, FontAwesome 4.0.3
- Drag & Drop dashboard
- [Extendable](https://github.com/gcphost/l4-bootstrap-admin/wiki/Extending-LaravelCP), make it how you want without editing the core!
- [BootSwatch Themed](http://bootswatch.com/)
- User notes,profiles, suspending, cancellation ( instant, timed and reversal )
- To-do list
- Smart search, search as you type, searches multiple tables, prepend search string with table name (users example) will search that table only
- User e-mailing, single and mass w/ attachments
- [RESTful API](https://github.com/gcphost/l4-bootstrap-admin/wiki/API), extreamly easy to use!

## Including jQuery/Bootstrap packages:
- [jQuery SparkLines](https://github.com/gwatts/jquery.sparkline/), all those bootstrap themes had em
- [bootstrap wysiwyg](https://github.com/mindmup/bootstrap-wysiwyg), sexy, light weight
- [BootBox Dialogs](https://github.com/makeusabrew/bootbox), nice modal wrapper
- [jQuery poller](https://github.com/gcphost/jquery.poller), my own work to reduce ajax querys
- [Gridster Responsive](https://github.com/gcphost/gridster-responsive), used with gridster for the dashboard (buggie)
- [Select2](https://github.com/ivaynberg/select2), used for user lists (or any select you need with 100+ of rows)
- [bootstrap growl](https://github.com/ifightcrime/bootstrap-growl), used for notifications
- [bootstrap datetime picker](http://tarruda.github.io/bootstrap-datetimepicker/)


## Including L4 packages:
- oAuth logins thanks to [Anvard](https://bitbucket.org/atticmedia/anvard/overview) & [HybridAuth](http://hybridauth.sourceforge.net/), every site should have 0Auth
- [L4-Settings](https://github.com/anlutro/laravel-settings), settings? of course
- [L4-DataTables](https://github.com/bllim/laravel4-datatables-package), jquery datatables, the best
- [LavaCharts](http://kevinkhill.github.io/LavaCharts/), google charts, gotta have em
- [ActivityLog](https://github.com/Regulus343/ActivityLog), gotta know whats goin on!
- [L4-honeypot](https://github.com/msurguy/Honeypot), stop spammers!
- [Profane Filter](https://github.com/rtablada/profane)
- [l4-gravatar](https://github.com/thomaswelton/laravel-gravatar)
- [bootstrap3 forms](https://github.com/gcphost/Laravel4-Bootstrap3/)

## Available Plugins
- [l4cp-support plugin](https://github.com/gcphost/l4cp-support) beta



# BEFORE YOU BEGIN!

We hope users will extend the application instead of modifying its core components. This will allow the application to grow depending on community support. If you do make changes to the core components consider forking and and making pull requests with your changes.
[Read more here](https://github.com/gcphost/l4-bootstrap-admin/wiki/Extending-LaravelCP)


#Quick install (the short install is not valid for this package):

Add the following to your Lavavel conposer.json:

    "repositories": [
        {
            "url": "https://github.com/that0n3guy/laravelcp-package.git",
            "type": "git"
        },
        {
            "url": "https://github.com/that0n3guy/confide.git",
            "type": "git"
        },
        {
            "url": "https://that0n3guy@bitbucket.org/that0n3guy/anvard.git",
            "type": "git"
        }
    ],
    "require": {
        "laravel/framework": "4.2.*",
        "gcphost/laravelcp": "dev-master"
     },

and

    "prefer-stable": true,
    "minimum-stability": "dev"

Run composer update

Add this to your config/app.php 
    
    'Gcphost\Laravelcp\LaravelcpServiceProvider'

create app/storage/settings.json with something like:

    {"site":{"name":"LaravelCP","bootswatch":"cerulean","theme":"default","contact_email":"gcphost@gmail.com","contact_address":"<strong>Twitter, Inc.<\/strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br><abbr title='Phone'>P:<\/abbr>(123) 456-7890"},"users":{"default_role_id":"2"},"login":{"login_url":"","logout_url":""}}

run the following commands:

    php artisan asset:publish gcphost/laravelcp
    php artisan migrate --path="vendor/gcphost/laravelcp/src/database/migrations"

    #@todo php artisan db:seed

    php artisan command:install_laravelcp


# Short install
###Want more detail? Review the original directions at the bottom

- Download the latest release
- Extract the archive in your web-based folder (that is ready to host a laravel app)
-- LaravelCP comes with .htaccess and a web.config to route your urls properly
- Edit app/config - database.php, mail.php, packages/atticmedia/anvard/hybridauth.php - add your settings
- Install, migrate and seed

```
    composer install --dev
    php artisan migrate
    php artisan db:seed
    php artisan optimize --force
```

- Install your user(s):

You can run the command directly:

```
    php artisan command:install_laravelcp
```

Or inline:

```
    php artisan command:install_laravelcp "Admin User" admin@example.org admin admin yes
    php artisan command:install_laravelcp "Site User" user@example.org site site_user yes
    php artisan command:install_laravelcp "Manager User" manager@example.org manager manager yes
    php artisan command:install_laravelcp "Client User" client@example.org client client yes
```

With options:
```
    php artisan command:install_laravelcp "<full name>" <email> <password> <group> <confirm>
```


### You're done!
Browse to your folder, /public/ and click login!
Default login is admin@example.org with the password admin

### Please note
This is not a vendor application so you must replace the files each time you want to update. You can use a git manager to assist with that.
We will be moving to a vendor package shortly.



## How you can help!
If you like the project I really need help with the phpunit testing stuff, so feel free to contribute there first :D

Have a suggestion? Post it in the 'issues'.


# Association
LaravelCP is not directly associated with Laravel or Taylor Otwell (creator of Laravel).




# From the forked repo:
@[laravel4-starter-kit](https://github.com/andrewelkins/Laravel-4-Bootstrap-Starter-Site)


Laravel 4 Bootstrap Starter Site is a sample application for beginning development with Laravel 4.

It began as a fork of [laravel4-starter-kit](https://github.com/brunogaspar/laravel4-starter-kit) taking the starter kit changing the included modules and adding a few as well.


## Features

* Bootstrap 3.0.0
* Custom Error Pages
	* 403 for forbidden page accesses
	* 404 for not found pages
	* 500 for internal server errors
* [Confide](#confide) for Authentication and Authorization
* Back-end
	* User and Role management
	* Manage blog posts and comments
	* WYSIWYG editor for post creation and editing.
    * DataTables dynamic table sorting and filtering.
    * Colorbox Lightbox jQuery modal popup.
* Front-end
	* User login, registration, forgot password
	* User account area
	* Simple Blog functionality
* Packages included:
	* [Confide](#confide)
	* [Entrust](#entrust)
	* [Ardent](#ardent)
	* [Carbon](#carbon)
	* [Basset](#basset) -- removed
	* [Presenter](#presenter)
	* [Generators](#generators)

## Issues
See [github issue list](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site/issues) for current list.

## Wiki
[Roadmap](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site/wiki/Roadmap)

-----

##Requirements

	PHP >= 5.4.0 (Entrust requires 5.4, this is an increase over Laravel's 5.3.7 requirement)
	MCrypt PHP Extension

##How to install
### Step 1: Get the code
#### Option 1: Git Clone

	git clone git://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site.git laravel

#### Option 2: Download the repository

    https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site/archive/master.zip

### Step 2: Use Composer to install dependencies
#### Option 1: Composer is not installed globally

    cd laravel
	curl -s http://getcomposer.org/installer | php
	php composer.phar install --dev
#### Option 2: Composer is installed globally

    cd laravel
	composer install --dev

If you haven't already, you might want to make [composer be installed globally](http://andrewelkins.com/programming/php/setting-up-composer-globally-for-laravel-4/) for future ease of use.

Please note the use of the `--dev` flag.

Some packages used to preprocess and minify assests are required on the development environment.

When you deploy your project on a production environment you will want to upload the ***composer.lock*** file used on the development environment and only run `php composer.phar install` on the production server.

This will skip the development packages and ensure the version of the packages installed on the production server match those you developped on.

NEVER run `php composer.phar update` on your production server.

### Step 3: Configure Environments

Laravel 4 will load configuration files depending on your environment. Basset will also build collections depending on this environment setting.

Open ***bootstrap/start.php*** and edit the following lines to match your settings. You want to be using your machine name in Windows and your hostname in OS X and Linux (type `hostname` in terminal). Using the machine name will allow the `php artisan` command to use the right configuration files as well.

    $env = $app->detectEnvironment(array(

        'local' => array('your-local-machine-name'),
        'staging' => array('your-staging-machine-name'),
        'production' => array('your-production-machine-name'),

    ));

Now create the folder inside ***app/config*** that corresponds to the environment the code is deployed in. This will most likely be ***local*** when you first start a project.

You will now be copying the initial configuration file inside this folder before editing it. Let's start with ***app/config/app.php***. So ***app/config/local/app.php*** will probably look something like this, as the rest of the configuration can be left to their defaults from the initial config file:

    <?php

    return array(

        'url' => 'http://myproject.local',

        'timezone' => 'UTC',

        'key' => 'YourSecretKey!!!',

        'providers' => array(

        [... Removed ...]

        /* Uncomment for use in development */
    //     'Way\Generators\GeneratorsServiceProvider', // Generators
    //     'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helpers

        ),

    );

### Step 4: Configure Database

Now that you have the environment configured, you need to create a database configuration for it. Copy the file ***app/config/database.php*** in ***app/config/local*** and edit it to match your local database settings. You can remove all the parts that you have not changed as this configuration file will be loaded over the initial one.

### Step 5: Configure Mailer

In the same fashion, copy the ***app/config/mail.php*** configuration file in ***app/config/local/mail.php***. Now set the `address` and `name` from the `from` array in ***config/mail.php***. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

### Step 6: Populate Database
Run these commands to create and populate Users table:

	php artisan migrate
	php artisan db:seed

### Step 7: Set Encryption Key
***In app/config/app.php***

```
/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| This key is used by the Illuminate encrypter service and should be set
| to a random, long string, otherwise these encrypted values will not
| be safe. Make sure to change it before deploying any application!
|
*/
```

	'key' => 'YourSecretKey!!!',

You can use artisan to do this

    php artisan key:generate --env=local

The `--env` option allows defining which environment you would like to apply the key generation. In our case, artisan generates your key in ***app/config/local/app.php*** and leaves ***'YourSecretKey!!!'*** in ***app/config/app.php***. Now it can be generated again when you move the project to another environment.

### Step 8: Make sure app/storage is writable by your web server.

If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage


### Step 10: Start Page

### User login with commenting permission
Navigate to your Laravel 4 website and login at /user/login:

    username : user@example.org
    password : user

Create a new user at /user/create

### Admin login
Navigate to /admin

    username: admin@example.org
    password: admin

-----
## Application Structure

The structure of this starter site is the same as default Laravel 4 with one exception.
This starter site adds a `library` folder. Which, houses application specific library files.
The files within library could also be handled within a composer package, but is included here as an example.

### Development

For ease of development you'll want to enable a couple useful packages. This requires editing the `app/config/app.php` file.

```
    'providers' => array(

        [...]

        /* Uncomment for use in development */
//        'Way\Generators\GeneratorsServiceProvider', // Generators
//        'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helpers

    ),
```
Uncomment the Generators and IDE Helpers. Then you'll want to run a composer update with the dev flag.

```
php composer.phar update
```
This adds the generators and ide helpers.
To make it build the ide helpers automatically you'll want to modify the post-update-cmd in `composer.json`

```
		"post-update-cmd": [
			"php artisan ide-helper:generate",
			"php artisan optimize"
		]
```

### Production Launch

By default debugging is enabled. Before you go to production you should disable debugging in `app/config/app.php`

```
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,
```

## Troubleshooting

### Styles are not displaying

You may need to recompile the assets for basset. This is easy to with one command.

```
php artisan basset:build
```

### Site loading very slow

Are you running Windows??

Please try adjusting the basset configuration as show in this [comment](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site/issues/148#issuecomment-22995288)

In app/config/packages/jasonlewis/basset/config.php:

```
 $collection->directory('assets/js', function($collection)
            {
                $collection->javascript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
                //$collection->add('bootstrap/bootstrap.js');
                $collection->requireDirectory('../../../vendor/twbs/bootstrap/js');
            })->apply('JsMin');
```
to:
```
 $collection->directory('assets/js', function($collection)
            {
                $collection->javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
                $collection->add('bootstrap/bootstrap.js');
                $collection->requireDirectory('../../../vendor/twbs/bootstrap/js');
            })->apply('JsMin');
```

-----
## Included Package Information
<a name="confide"></a>
## Confide Authentication Solution

Used for the user auth and registration. In general for user controllers you'll want to use something like the following:

    <?php

    use Zizaco\Confide\ConfideUser;

    class User extends ConfideUser {

    }

For full usage see [Zizaco/Confide Documentation](https://github.com/zizaco/confide)

<a name="entrust"></a>
## Entrust Role Solution

Entrust provides a flexible way to add Role-based Permissions to Laravel4.

    <?php

    use Zizaco\Entrust\EntrustRole;

    class Role extends EntrustRole
    {

    }

For full usage see [Zizaco/Entrust Documentation](https://github.com/zizaco/entrust)

<a name="ardent"></a>
## Ardent - Used for handling repetitive validation tasks.

Self-validating, secure and smart models for Laravel 4's Eloquent ORM

For full usage see [Ardent Documentation](https://github.com/laravelbook/ardent)

<a name="carbon"></a>
## Carbon

A fluent extension to PHPs DateTime class.

```php
<?php
printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2012)->addYears(4);

$officialDate = Carbon::now()->toRFC2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$worldWillEnd = Carbon::createFromDate(2012, 12, 21, 'GMT');
```

For full usage see [Carbon](https://github.com/briannesbitt/Carbon)

<a name="basset"></a>
## Basset

A Better Asset Management package for Laravel.

Adding assets in the configuration file `config/packages/jasonlewis/basset/config.php`
```php
'collections' => array(
        'public-css' => function($collection)
        {
            $collection->add('assets/css/bootstrap.min.css');
            $collection->add('assets/css/bootstrap-responsive.min.css');
        },
    ),
```

Compiling assets

    $ php artisan basset:build

I would recommend using development collections for development instead of compiling .

For full usage see [Using Basset by Jason Lewis](http://jasonlewis.me/code/basset/4.0)

<a name="presenter"></a>
## Presenter

Simple presenter to wrap and render objects. Think of it of a way to modify an asset for the view layer only.
Control the presentation in the presentation layer not in the model.

The core idea is the relationship between two classes: your model full of data and a presenter which works as a sort of wrapper to help with your views.
For instance, if you have a `User` object you might have a `UserPresenter` presenter to go with it. To use it all you do is `$userObject = new UserPresenter($userObject);`.
The `$userObject` will function the same unless a method is called that is a member of the `UserPresenter`. Another way to think of it is that any call that doesn't exist in the `UserPresenter` falls through to the original object.

For full usage see [Presenter Readme](https://github.com/robclancy/presenter)

<a name="generators"></a>
## Laravel 4 Generators

Laravel 4 Generators package provides a variety of generators to speed up your development process. These generators include:

- `generate:model`
- `generate:seed`
- `generate:test`
- `generate:view`
- `generate:migration`
- `generate:resource`
- `generate:scaffold`
- `generate:form`
- `generate:test`

For full usage see [Laravel 4 Generators Readme](https://github.com/JeffreyWay/Laravel-4-Generators/blob/master/readme.md)


-----
## License

This is free software distributed under the terms of the MIT license

## Additional information

Inspired by and based on [laravel4-starter-kit](https://github.com/brunogaspar/laravel4-starter-kit)

Any questions, feel free to [contact me](http://twitter.com/andrewelkins).
