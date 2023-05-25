<?php
require_once "vendor/autoload.php";

use Artemis\Core\Router\Router;

$app = Router::getInstance();


// request routes

$app->get("/test",function($req,$res){
    $res->send("test");

});

$app->get("/protocol",function($req,$res){
    $res->send($req->protocol());

});

$app->get("/path",function($req,$res){
    $res->send($req->path());

});
$app->get("/method",function($req,$res){
    $res->send($req->method());

});

$app->get("/secure",function($req,$res){
    $res->send((string) $req->secure());

});

$app->post("/body",function($req,$res){
    $_SERVER['CONTENT_TYPE'] = 'application/x-www-form-urlencoded';
    $res->json($req->body());

});

$app->get("/ip",function($req,$res){

    $res->send($req->ip()["ip"]);

});

$app->get("/params/:id/test",function($req,$res){
    $res->send($req->params()["id"]?? "");

});

$app->get("/params/:id",function($req,$res){
    $res->send($req->params()["id"]?? "");

});



$app->get("/test/hostname",function($req,$res){

    $res->send($req->hostname());

});



$app->get("/test/:id",function($req,$res){
    $res->json($req->params());

});

// response routes
$app->get("/send",function($req,$res){
    $res->send("test");

});

$app->get("/json",function($req,$res){
    $res->json(array("test" => true));

});


// app routes

$app->get("/get",function($req,$res){
    $res->send("200");

});
$app->post("/post",function($req,$res){
    $content = $req->body();
    $res->send($content["test"]);

});

$app->put("/put",function($req,$res){
    $res->send("updated");

});

$app->delete("/delete",function($req,$res){
    $res->send("delete");

});





$app->listen("",function(){ });

?>