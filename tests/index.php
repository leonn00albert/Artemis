<?php
require_once "vendor/autoload.php";
require_once "Core/TemplateEngine/TemplateEngine.php";
use Artemis\Core\Router\Router;
use Artemis\Core\Forms\Forms;
use Artemis\Core\DataBases\DB;

$app = Router::getInstance();

class Dependency {
    public function action(){
        return "di";
    }
}
$Dependency = new Dependency();



$app->set("view_engine", new TemplateEngine("tests"));
$app->use($Dependency);

$app->use($Dependency);
$app->get("/test/di",function($req,$res) use ($app){
    $res->send($app->Dependency->action());
});
// request routes
$app->get("/db/test",function($req,$res) use ($app){
    $db = DB::new("PDO", "test","","mysql","localhost","root");
    $db->createTable([
        "table_name" => "test",
        "sql" => "CREATE TABLE test (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )"
    ]);
    $res->send("test");

});

$app->get("/db/test/create",function($req,$res) use ($app){
    $db = DB::new("PDO", "test","","mysql","localhost","root");
    $db->selectTable("test");

    $db->create([
        "table_name" => "test",
        "sql" => "INSERT INTO test (firstname, lastname, email)
        VALUES ('John', 'Doe', 'john@example.com')"
    ]);
    $res->send("created");

});
$app->get("/test",function($req,$res){
    $res->send("test");

});

$app->get("/tengine",function($req,$res){
    $data = [
        'title' => 'My Website',
        'heading' => 'Welcome to My Website',
        'content' => 'This is the content of my website.',
    ];
    $res->render("example",$data);

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

$app->get("/params/:id/test",function($req,$res ,){
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