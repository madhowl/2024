<?php

namespace App\Core;

class HelperClass
{
    public static function dd($some)
    {
        echo '<pre>';
        print_r($some);
        echo '</pre>';
        exit();
    }

    public static function goUrl(string $url)
    {
        echo '<script type="text/javascript">location="';
        echo $url;
        echo '";</script>';
    }

    function getDirList($path)
    {
        $dir_list = [];
        foreach (glob($path . '/*', GLOB_ONLYDIR) as $dir) {
            if (($dir)) {
                $dir_list[] = basename($dir);
            }
        }
        return $dir_list;
    }

    public static function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function parseURI($uri)
    {
        $uri = trim($uri, '/');
        $uri = explode("/", $uri);
        return $uri;
    }

}