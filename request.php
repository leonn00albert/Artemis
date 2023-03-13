<?php

require_once('Artemis/utils.php');

class Request {
    public $route = "";
    public function body(){
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        if(isset($parsed['query'])){
            $query = $parsed['query'];
            parse_str($query, $params);
            return $params;
        }
     
    }

    public function method(){
        $method = $_SERVER['REQUEST_METHOD'];
        return $method ;
    }

    public function path(){
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        return $parsed['path'];
    }

    public function hostname(){
        $hostname = $_SERVER['HTTP_HOST'];
        return $hostname;
    }

    public function ip(){
        $ip = $_SERVER['SERVER_ADDR'];
        return $ip;
    }

    public function protocol(){
        $protocol = $_SERVER['SERVER_PROTOCOL'];
        return $protocol;
    }

    public function params(){
        if(Utils::hasParams($this->route)){
            $parsed = parse_url($_SERVER["REQUEST_URI"]);
            list($route_path, $route_lastSegment) = Utils::splitUrl($this->route["path"]);
            list($url_path, $url_lastSegment) = Utils::splitUrl($parsed["path"]);
            return array(Utils::parseParam($route_lastSegment) => $url_lastSegment);
        }
    
    }

    public function secure(){
        $secure = $_SERVER['HTTPS'];
        return $secure;
    }


    
    
}


?>