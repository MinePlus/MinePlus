MinePlus
========

MinePlus is a web panel that enhances your minecraft gameservers with social features.

## Installation ##
*This describes the installation for a developer, the installation of a production-ready release will be easier.*

1. Download a version of MinePlus from GitHub, choose either the [bleeding-edge version][1] or [a specific release][2].
2. Use [composer][3] to install all dependencies needed: `$ php composer.phar update`.
3. Go to `app/config/` and create a `parameters.yml` from the existing `parameters.yml.dist` and configure it to fit your needs.
4. Run all new migrations: `$ php app/console doctrine:migrations:migrate`.

[1]: https://github.com/MinePlus/MinePlus/archive/develop.zip
[2]: https://github.com/MinePlus/MinePlus/releases
[3]: http://getcomposer.org/
