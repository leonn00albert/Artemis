    <?php



    require_once "router/Router.php";
    include "controller/Controller.php";
    include "secure/secure.php";
    include "forms\Forms.php";
    include "db\DB.php";
    function clientCode()
    {
        $app = Router::getInstance();
        $controller = new Controller();
        $secure = new SimpleLogin();
        $forms= new Forms();
        $GLOBALS['db'] = new db("JSON",'test');
        $app->get("/test")->next(function($req,$res){
            $req->body["user"] = "leon";
            $req->body["pwd"] = "12345";
            $req->body["sanatize"] = "<script type='text/javascript'>";
        
        })->next($forms->sanatize)->next($secure->login)->next(function($req,$res) {
            if($req->auth) {
                $res->body = $GLOBALS['db'] ->con->find([]);
            }
            
        })->next($controller->handle_basic_request);

        $app->listen("",function(){ });

    }

    clientCode();
  