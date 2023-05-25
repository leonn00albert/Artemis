<?php

namespace Artemis\Core\Router;

use Artemis\Core\Router\Utils;


class Request
{
    public $route = [];
    public $params = [];
    /**
     * @return [type]
     */

    //add support for json and form data 
    public function body()
    {

        $contentType = $_SERVER["CONTENT_TYPE"];
  
        if ($contentType === "application/json") {
            $request_body = file_get_contents("php://input");
            $data = json_decode($request_body, true); // true to convert to associative array
    
            return $data;
  
        } elseif ($contentType === "application/x-www-form-urlencoded") {
            // Request contains form data
            $formData = $_POST;
            return $formData;
        } else {

        }
 
    }

    /**
     * @return array
     */
    public function query(): array
    {
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        if (isset($parsed["query"])) {
            $query = $parsed["query"];
            parse_str($query, $params);
            return $params;
        } else {
            return [];
        }
    }

    /**
     * @return string
     */
    public function method(): string
    {
        $method = $_SERVER["REQUEST_METHOD"];
        return $method;
    }


    /**
     * @return string
     */
    public function path(): string
    {
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        return $parsed["path"];
    }

    /**
     * @return string
     */
    public function hostname(): string
    {
        $hostname = $_SERVER["HTTP_HOST"];
        return $hostname;
    }


    /**
     * @return array
     */
    public function ip(): array
    {
        $ipAddress = $_SERVER["REMOTE_ADDR"];
        $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "No HTTP referer";
        return  ["ip" => $ipAddress, "referer" => $referer];
    }

    /**
     * @return string
     */
    public function protocol(): string
    {
        $protocol = $_SERVER["SERVER_PROTOCOL"];
        return $protocol;
    }

    /**
     * @return bool
     */
    public function xhr(): bool
    {
        $header = getallheaders();
        return isset($header["XMLHttpRequest"]);;
    }

    /**
     * @return array
     */
    public function params(): array
    {
        return $this->params;
    }

    /**
     * @return bool
     */
    public function secure(): bool
    {
        $secure = isset($_SERVER["HTTPS"]);
        return $secure;
    }
}
