AdvertSite
==========

A Symfony project created on May 19, 2018, 9:07 pm.

Steps to reproduce :
------------
Download the git file

Install assetic bundle : execute $ composer require symfony/assetic-bundle

Run $ composer install

Run $ composer dump-autoload

Run the project : php bin/console server:run

If you have an error like The path "fos_user.from_email.address" cannot contain an empty value, but got null.
> In the app/config/parameters.yml set a value to mailer_user
