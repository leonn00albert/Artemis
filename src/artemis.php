<?php
    declare(strict_types=1);
    require_once __DIR__ . '/utils.php';
    require_once __DIR__ . '/response.php';
    require_once __DIR__ . '/request.php';
    
    class Artemis {
       protected $props = array();
       protected $routes = array();
            function __construct(){ 
            }
    
        public function get(string $path,object $callback) {   
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'GET'
            ));   
               
        }

        public function post(string $path,object $callback) {
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'POST'
            ));
        }   
        public function delete(string $path,object $callback) {
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'DELETE'
            ));
        }   

        public function put(string $path,object $callback) {
            array_push($this->routes,array(
                'path' => $path,
                'callback' => $callback,
                'type' => 'PUT'
            ));
        }   

 
    

        public function listen(string $path,object $callback) {
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
        public function setProp(string $key, string $value) {
            array_push($this->props, array($key => $value));
        }
        public function getProp(string $key) {
            return $this->props[$key];
        }


    }






?>

