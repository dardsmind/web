# Mindworksoft-CMS-source-code
I build my website from free templates at styleshout.com with laravel 5.2, and CMS panel using Metronic admin template, you are free to use it for your own personal website you may edit or improve it but don't forget to put a link back to this repository as a simple appreciation of my work.
> If you get something for free share it also for free, the world only advances when sharing

## Installation
1. go to your website home folder (same level of public_html) and download the code from github, all the codes will be downloaded on the "web" folder.
```bash
git clone https://github.com/dardsmind/web.git
```
2. go inside the "web" folder and initialize laravel dependencies files, it will create a vendor folder with all dependencies on it.
```bash
composer update
```
3. copy all the files from the public folder to your website public_html (important: this will overwrite any files on the public_html folder so make sure to back up all your files there)
4. create a database on your website and write the database name, username and password on the web/config/database.php
5. import the sql file to your database, the sql file is located on the web/database folder.
6. generate a key for your website
```bash
php artisan key:generate
```
7. Modify the public_html/index.php file to adjust the paths to point to the directory containing the Laravel core files. Refer to the following code block. Again, adjust the paths as needed if you are deploying the application on a subdomain.
```php
require __DIR__.'/../web/bootstrap/autoload.php';
```
```php
$app = require_once __DIR__.'/../web/bootstrap/app.php';
```
>note: if open_basedir error: edit /home/account/conf/web/[webdomain].httpd.conf and add the path of laravel app folder to the open_basedir value or depend on your hosting panel, in my case I use vestacp hosting panel



## Security Vulnerabilities

If you discover a security vulnerability within this CMS, please write a comments. All security vulnerabilities will be promptly addressed whenever I got time.

## License

* The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
* Styleshout templates are released under the [Creative Commons Attribution 3.0](https://creativecommons.org/licenses/by/3.0/) License

