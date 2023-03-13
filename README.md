# Artemis
An Express.js like router for php

Get started:

`
mkdir example
cd example
code . index.php
'

inside index.php ->

`
<?php
require_once('Artemis/artemis.php');

$app = new Artemis();

$app->get("/", function($req,$res){
    $res->send("<h1>Hello World!</h1>");
    $res->status(200);
      
});

?>
`
Start local server in terminal

`
php -S localocalhost:8000
`
