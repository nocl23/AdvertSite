
# AdvertSite

A Symfony project created on May 19, 2018, 9:07 pm.

## Steps to reproduce -

* Download the git file

* Move into the extracted repository after unzip the zip file

* Install assetic bundle : execute `$composer require symfony/assetic-bundle`

* Run `$composer install`

* Run `$composer dump-autoload`

* Create database `$php bin/console doctrine:database:create`

* Create schema of database : `$php bin/console doctrine:schema:create`

* Run `php bin/console doctrine:schema:update --force`

* Run the project : `$php bin/console server:run`

If the database doesn't generate automatically, run the script advertSiteDatabase.sql to generate the database.

If you have an error like The path "fos_user.from_email.address" cannot contain an empty value, but got null.
In the _app/config/parameters.yml_ set a value to _mailer_user_
