<p align="center"><img src="https://i.postimg.cc/D0JpJJKg/Artemis.png" data-canonical-src="https://i.postimg.cc/D0JpJJKg/Artemis.png" width="250" height="200" align="center"/></p>

# Artemis->php
An Express.js like router for php


<div align="center">

    
[![Packagist Version](https://img.shields.io/packagist/v/wdlndfx/Artemis?cacheSeconds=3600)](https://packagist.org/packages/wdlndfx/artemis)
[![Packagist](https://img.shields.io/packagist/dt/wdlndfx/Artemis?cacheSeconds=3600)](https://packagist.org/packages/wdlndfx/artemis)
[![GitHub Release Date](https://img.shields.io/github/release-date/leonn00albert/Artemis?cacheSeconds=3600)](https://github.com/leonn00albert/Artemis/releases)
[![GitHub issues](https://img.shields.io/github/issues/leonn00albert/Artemis?cacheSeconds=3600)](https://github.com/leonn00albert/Artemis/issues)
    
![GitHub repo size](https://img.shields.io/github/repo-size/leonn00albert/Artemis)
[![GitHub contributors](https://img.shields.io/github/contributors/leonn00albert/Artemis?cacheSeconds=3600)](https://github.com/leonn00albert/Artemis/graphs/contributors)
[![GitHub](https://img.shields.io/github/license/leonn00albert/Artemis?cacheSeconds=3600)](MIT)

</div>

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

## Features
- Routing: Artemis provides a simple and intuitive routing mechanism. It allows you to define routes based on HTTP methods and URL patterns, making it easy to handle different endpoints and HTTP operations.
- Middleware: Artemis uses middleware functions to handle various aspects of request/response processing. Middleware functions can be used for tasks such as logging, authentication, error handling, parsing request bodies, and more. Express provides a rich ecosystem of built-in middleware as well as the ability to create custom middleware.
- Extensibility: Artemis is highly extensible, allowing you to add additional functionality through third-party middleware and librarie
## Installation
```shell
mkdir example
cd example
touch index.php
composer require  wdlndfx/artemis:dev-master
```

## Usage
Quick Start:


inside index.php ->

```php
<?php
require_once __DIR__.'/vendor/autoload.php';

use Artemis\Core\Router
$app = Router::getInstance();

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
## License 
MIT License

Copyright (c) 2023 leonn00albert
