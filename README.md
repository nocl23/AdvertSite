#AdvertSite


A Symfony project created on May 19, 2018, 9:07 pm.

## Steps to reproduce 

* Download the git file

* Install assetic bundle : execute `$composer require symfony/assetic-bundle`
* Run `$composer install`

* Run `$composer dump-autoload`

* Run the project : `$php bin/console server:run`

If the database doesn't generate automatically, run the script advertSiteDatabase.sql to generate the database.

If you have an error like The path "fos_user.from_email.address" cannot contain an empty value, but got null.
In the _app/config/parameters.yml_ set a value to _mailer_user_
