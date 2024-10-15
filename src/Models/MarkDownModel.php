<?php

namespace App\Models;

class MarkDownModel
{

    function getArticleList()
    {
        $dir = 'content/blog/';
        $filesList = scandir($dir);
        //dbg($filesList);
        $pages = glob($dir . "*.md");
        //dbg($pages);
        foreach ($pages as $page) {
            $pageName = substr($page, 8);
            $pageName = substr($pageName, 0, -3);
            echo "<li><a href=\"index.php?id=" . $pageName . "\">" . $pageName . "</a></li>";
        }
    }

}