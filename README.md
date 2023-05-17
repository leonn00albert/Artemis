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
[![GitHub](https://img.shields.io/github/license/leonn00albert/Artemis?cacheSeconds=3600)](https://github.com/leonn00albert/Artemis/blob/master/LICENSE)

</div>
## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

## Features
- List the key features or functionalities of the project.

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
