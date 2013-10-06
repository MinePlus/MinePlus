MinePlus ![Travis Status](https://api.travis-ci.org/MinePlus/MinePlus.png?branch=master)![Total Downloads](https://poser.pugx.org/mineplus/standard-edition/downloads.png)
========

MinePlus is a web panel that enhances your minecraft gameservers with social features.

## Installation ##
*Note: As longs as there is no stable release, you have to append `--stability=dev to the command.`*

1. Download [composer][1] to create a new MinePlus project: `php composer.phar create-project mineplus/standard-edition <path>`
2. Aftert following the instructions, and creating the db, run all new migrations: `$ php app/console doctrine:migrations:migrate`.

[1]: http://getcomposer.org/
