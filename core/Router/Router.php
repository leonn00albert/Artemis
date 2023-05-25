<?php

namespace Artemis\Core\Router;

use Exception;
use Artemis\Core\Router\Response;
use Artemis\Core\Router\Request;
use Artemis\Core\Router\Utils;

/**
 *
 */
class Router
{
    /**
     * @var array
     */
    private static $instances = [];
    /**
     * @var array
     */
    protected $props = array();
    /**
     * @var array
     */
    protected $routes = array();
    /**
     * @var Request
     */
    protected Request $request;
    /**
     * @var Response
     */
    protected Response $response;

    /**
     *
     */
    protected function __construct()
    {
    }

    /**
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize Router.");
    }

    /**
     * @return Router
     */
    public static function getInstance(): Router
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {

            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    /**
     * @param string $path
     * @param object $middleware
     * @return $this
     */
    public function get(string $path, object $middleware)
    {
        $arg = array_slice(func_get_args(), 1);

        $this->request = new Request();
        $this->response = new Response();
        array_push($this->routes, array(
            "path" => $path,
            "type" => "GET",
            "middleware" => $arg,
        ));
        return $this;
    }

    /**
     * @param string $path
     * @param object $middleware
     * @return $this
     */
    public function post(string $path, object $middleware)
    {
        $arg = array_slice(func_get_args(), 1);

        $this->request = new Request();
        $this->response = new Response();
        array_push($this->routes, array(
            "path" => $path,
            "type" => "POST",
            "middleware" => $arg,
        ));
        return $this;
    }

    /**
     * @param string $path
     * @param object $callback
     * @return $this
     */
    public function delete(string $path, object $callback)
    {
        $arg = array_slice(func_get_args(), 1);

        $this->request = new Request();
        $this->response = new Response();
        array_push($this->routes, array(
            "path" => $path,
            "type" => "DELETE",
            "middleware" => $arg,
        ));
        return $this;
    }

    /**
     * @param string $path
     * @param object $callback
     * @return $this
     */
    public function put(string $path, object $callback)
    {
        $arg = array_slice(func_get_args(), 1);

        $this->request = new Request();
        $this->response = new Response();
        array_push($this->routes, array(
            "path" => $path,
            "type" => "PUT",
            "middleware" => $arg,
        ));
        return $this;
    }


    /**
     * @param string $path
     * @param object $callback
     * @return void
     */
    public function listen(string $path, object $callback)
    {

        $route_exsist = false;
        $wild_card = [];
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        foreach ($this->routes as $route) {
            if ($route["type"] == $_SERVER["REQUEST_METHOD"]) {
                if(str_contains($route["path"],":")){
              
                    $posOne = strpos($route['path'],":");
                    $route_string = substr($route["path"],$posOne + 1);
                    $posTwo = strpos($route_string,"/");
                    if( $posTwo === false){
                        $posTwo = strlen($route_string);   
                    }
                    $param = substr($route_string,0,$posTwo);

                    $parse_string = substr($parsed["path"],$posOne);
                    $posTwo = strpos($parse_string,"/");
                    if( $posTwo === false){
                        $posTwo = strlen($parse_string);   
                    }
                    $param_value = substr($parse_string,0,$posTwo);
                    $new_route = str_replace(":" .$param,$param_value,$route["path"]);
                    
                    if($new_route === $parsed["path"]){

                        $unique = function ($new_route) {
                            foreach ($this->routes as $r) {
                                if($r["path"] === $new_route) {
                                    return false;
                                }
                            }
                            return true;
                        };
                        if($unique($new_route)) {
                            $this->request->params = [$param => $param_value];
                            foreach ($route["middleware"] as $controller) {
                                $controller($this->request, $this->response);
                        
                            }
                            $route_exsist = true;
                        }
                        
                 
                    }

                }
   
                if ($route["path"] === $parsed["path"]) {
                    foreach ($route["middleware"] as $controller) {
                        $controller($this->request, $this->response);
                    }

                    $route_exsist = true;
                } else if ($route["path"] === "*") {
                    $wild_card = $route["middleware"];
                }
            }
        }

        if (!$route_exsist) {
            foreach ($wild_card as $controller) {
                $controller($this->request, $this->response);
            }

     
        }

        $callback();
        unset($this->response);
        unset($this->request);
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setProp(string $key, string $value)
    {
        array_push($this->props, array($key => $value));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getProp(string $key)
    {
        return $this->props[$key];
    }
}
