# Artemis
An Express.js like router for php



[![Packagist Version](https://img.shields.io/packagist/v/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![Packagist](https://img.shields.io/packagist/dt/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![GitHub Release Date](https://img.shields.io/github/release-date/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/releases)
[![GitHub issues](https://img.shields.io/github/issues/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/issues)
[![GitHub contributors](https://img.shields.io/github/contributors/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/graphs/contributors)
[![GitHub](https://img.shields.io/github/license/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/blob/master/LICENSE)



Get started:

```shell
mkdir example
cd example
code index.php
composer require  wdlndfx/artemis:dev-master
```

inside index.php ->

```php
<?php
require_once __DIR__ . '/vendor/wdlndfx/artemis/src/artemis.php';
$app = new Artemis();

$app->get("/", function($req,$res){
    $res->send("<h1>Hello World!</h1>");
    $res->status(200);
      
});

$app->listen("/", function(){
});

?>
```
Start local server in terminal

```shell
php -S localocalhost:8000
```
