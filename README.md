# Mensa-API
This project is a Symfony4 based open source API for crawling different canteen menus on the internet and return the content as JSON Responses.

## Installation
* Checkout this repository
* Run `composer install` in the root directory of the project
* Run `php bin/console server:run` in the root directory of the project

Make sure you have Composer installed: https://getcomposer.org/

Make sure you set up the correct file permissions for `bin/console` and the `var/` directory.

## Use
Call:
`{url}?university={universityTag}`

`url` = Your Url

`universityTag` = The Tag to specify which crawler you want to use.


### Implemented Universities:
* `NAK` (https://www.nordakademie.de) meals for the current week and the next week

## Working Exmaple:
`https://mensa-api.bogdanfinn.de?university=NAK`

## Contribution
Feel free to contribute a crawler implementation for your own university:
* Implement a crawler which extends the AbstractMensaCrawler.php` class
* Àdd your crawler in the `services.yaml` file with the correct tag
* Submit a Pull Request with your changes.


## Authors:
@bogdanfinn
