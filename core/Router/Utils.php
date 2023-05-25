<?php
namespace Artemis\Core\Router;

class Utils
{
   /**
    * @param string $url
    * 
    * @return array
    */
    static function splitUrl(string $url): array
    {
        $segments = explode("/", $url);
        $lastSegment = end($segments);
        $lastSegmentIndex = array_key_last($segments);
        $path = implode("/", array_slice($segments, 0, $lastSegmentIndex));
        return array($path, $lastSegment);
    }

   /**
    * @param array $route
    * 
    * @return bool
    */
    static function hasParams(array $route): bool
    {
        return str_contains($route["path"], ":");
    }

   /**
    * @param string $param
    * 
    * @return string
    */
    static function parseParam(string $param=""): string
    {   

        $parsed = explode(":", $param);
        return $parsed[1];
    }


}
