# HWPweb Admin Template for CodeIgniter 4 with Datatables and Axios CRUD

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation

1. Clone this repostiory.
2. Navigate into cloned repository folder.
3. Open terminal app and run `composer install`.

## Setup

1. Copy `.env.example` to `.env` and tailor for your app, specifically the `requestURL` and any database settings.
2. Create MySQL database match with database name specified in `.env` file.
3. Run `php spark migrate` to migrate database.
4. Run `php spark db:seed UserSeeder` to seed the database items.
5. For use with PHP development server, run `php spark serve` to start the server. Usually [http://localhost:8080](http://localhost:8080). You can use different port by using `php spark serve --port 8081`. Replace `8081` with the desired port number. You need to modify `requestURL` in `.env` to match with the desired port number.
6. For use without PHP development server such as Apache or Nginx, just open it from URL like [http://localhost/hwpweb-admin-template](http://localhost/hwpweb-admin-template) or others based on your web server's configuration. You need to modify `requestURL` in `.env` to match with the desired URL address.
   > The base URL is based on PHP's `$_SERVER['SERVER_NAME']` value. You just need to change the `requestURL` which consists of the port and the subfolder (if the app is stored in a subfolder).
7. Sign in using username `administrator` and password `administrator`. You need to change the password from `{your_base_url}/settings/changepassword` and we recommend using a strong password for better security.

## Progressive Web App (PWA) Setup

The `manifest.json` file contains the application configuration for the PWA located in the public folder.

PWA contents:

- In `app/Views/auth/templates/login.php` and `app/Views/dashboard/templates/dashboard.php`, there's is a `<link rel="manifest" href="<?= base_url(); ?>/manifest.json">` tag to initiate `manifest.json`.
- If the PWA located in subfolder, add the subfolder in the `start_url` and `src` values in `manifest.json`.

To set up PWA application:

1. Check or modify PWA configuration above based on your needs.
2. Run `php spark serve` or `php spark serve --port 8081`. Replace `8081` with the desired port number.
3. Open the browser's development tools to check manifest information and service worker status.
4. If the configuration meets the PWA requirement, you can install the PWA. You can launch it from applications menu or list. Don't forget to run `php spark serve` (or `php spark serve --port 8081` if you use different port) before launching an application.
5. If not using `localhost` served using or not using `php spark serve` such as your server's domain or IP address, you must use HTTPS.

> [!WARNING]
>
> You will need to reinstall the PWA if the port or URL is changed. Make sure the port or URL used for the PWA does not conflict with another project.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the _public_ folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's _public_ folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter _public/..._, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
>
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
