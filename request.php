<?php

require_once('Artemis/utils.php');

class Request {
    public $route = "";
    public function body():array {
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        if(isset($parsed['query'])){
            $query = $parsed['query'];
            parse_str($query, $params);
            return $params;
        }
     
    }

    public function method():string {
        $method = $_SERVER['REQUEST_METHOD'];
        return $method ;
    }

    public function path():string {
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        return $parsed['path'];
    }

    public function hostname():string{
        $hostname = $_SERVER['HTTP_HOST'];
        return $hostname;
    }

    public function ip():string {
        $ip = $_SERVER['SERVER_ADDR'];
        return $ip;
    }

    public function protocol():string {
        $protocol = $_SERVER['SERVER_PROTOCOL'];
        return $protocol;
    }

    public function params():array {
        if(Utils::hasParams($this->route)){
            $parsed = parse_url($_SERVER["REQUEST_URI"]);
            list($route_path, $route_lastSegment) = Utils::splitUrl($this->route["path"]);
            list($url_path, $url_lastSegment) = Utils::splitUrl($parsed["path"]);
            return array(Utils::parseParam($route_lastSegment) => $url_lastSegment);
        }
    
    }

    public function secure():bool {
        $secure = $_SERVER['HTTPS'];
        return $secure;
    }


    
    
}


?>