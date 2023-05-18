<?php

namespace Artemis\Core\Router;

use Artemis\Core\Router\Utils;


class Request
{
    public $route = "";

    /**
     * @return [type]
     */
    public function body()
    {
        $request_body = file_get_contents("php://input");
        $data = json_decode($request_body, true); // true to convert to associative array

        return $data;

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
        }else {
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
     * @return string
     */
    public function ip(): string
    {
        $ip = $_SERVER["SERVER_ADDR"];
        return $ip;
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
        if (Utils::hasParams($this->route)) {
            $parsed = parse_url($_SERVER["REQUEST_URI"]);
            list($route_path, $route_lastSegment) = Utils::splitUrl($this->route["path"]);
            list($url_path, $url_lastSegment) = Utils::splitUrl($parsed["path"]);
            return array(Utils::parseParam($route_lastSegment) => $url_lastSegment);
        }

    }

    /**
     * @return bool
     */
    public function secure(): bool
    {
        $secure = $_SERVER["HTTPS"];
        return $secure;
    }


}


?>
