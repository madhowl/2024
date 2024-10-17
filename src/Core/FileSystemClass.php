<?php

namespace App\Core;

use App\Core\HelperClass as Helper;
use App\Core\Parsedown;
class FileSystemClass
{
    public static function getContent($path)
    {
        $Parsedown = new Parsedown();
        $page = self::parseFile($path);
        $pageItem = (array)json_decode($page[0]);
        $pageItem['content'] = $Parsedown->text($page[1]); ;
        return $pageItem;
    }

   public static function parseFile($path)
    {
        $content = explode('===', file_get_contents($path));
        return $content;
    }



}