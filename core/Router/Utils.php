<?php

namespace Router;

class Utils
{
    static function splitUrl(string $url): array
    {
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $lastSegmentIndex = array_key_last($segments);
        $path = implode('/', array_slice($segments, 0, $lastSegmentIndex));
        return array($path, $lastSegment);
    }

    static function hasParams(array $route): bool
    {
        return str_contains($route['path'], ":");
    }

    static function parseParam(string $param): string
    {
        $parsed = explode(':', $param);
        return $parsed[1];
    }


}
