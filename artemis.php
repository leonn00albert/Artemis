<?php
    require_once("Artemis/utils.php");
    require_once("Artemis/response.php");
    require_once("Artemis/request.php");
    class Artemis {
       protected $props = array();
       protected $routes = array();
            function __construct(){ 
            }
    
        public function get($path,$callback) {   
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'GET'
            ));   
               
        }

        public function post($path,$callback) {
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'POST'
            ));
        }   
        public function delete($path,$callback) {
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'DELETE'
            ));
        }   

 
    

        public function listen($path,$callback) {
            $request = new Request();
            $response = new Response(); 
            $route_exsist = false;
            $wild_card;
            $parsed = parse_url($_SERVER["REQUEST_URI"]);
            foreach($this->routes as $route) {

                if($route['type'] == $_SERVER["REQUEST_METHOD"] ) {
                if(Utils::hasParams($route)) {
                list($path, $lastSegment) = Utils::splitUrl($route["path"]);
                list($second_path, $second_lastSegment) = Utils::splitUrl($parsed ["path"]);

                if($path == $second_path){
                    $request->route = $route;
                    $route["callback"]($request, $response);   
                    $route_exsist = true;
                }
                }

                if ($route["path"] === $parsed['path']) {
                    $route["callback"]($request, $response);   
                    $route_exsist = true;
                } else if ($route["path"] === "*") {
                    $wild_card = $route["callback"];
                }
            }
    
                
            }

            if(!$route_exsist) {
                $wild_card($request, $response);
            }

    
            $callback();
        }
        public function setProp($key, $value) {
            array_push($this->props, array($key => $value));
        }
        public function getProp($key) {
            return $this->props[$key];
        }


    }






?>

