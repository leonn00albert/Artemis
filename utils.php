
<?php

class Utils {
    static function splitUrl($url) {
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $lastSegmentIndex = array_key_last($segments);
        $path = implode('/', array_slice($segments, 0, $lastSegmentIndex));
        return array($path, $lastSegment);
    }
    static function hasParams($route) {
        return str_contains($route['path'],":");
    }
    static function parseParam($param) {
        $parsed = explode(':', $param);
        return $parsed[1];
    }

    
}

?>
