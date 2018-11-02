# Mensa-API
This project is an open source API for crawling different canteen menus on the internet and return the content as JSON Responses.

## Use
Call:
`{url}?university={universityTag}`

`url` = The API Url

`universityTag` = The Tag to specify which crawler you want to use.

###Implemented Universities:
* `NAK` (https://www.nordakademie.de)

## Working Exmaple:
`https://mensa-api.bogdanfinn.de?university=NAK`

## Contribution
Feel free to contribute a crawler implementation for your own university:
* Implement a crawler which extends the AbstractMensaCrawler.php` class
* Àdd your crawler in the `services.yaml` file with the correct tag
* Submit a Pull Request with your changes.

##Authors:
@bogdanfinn