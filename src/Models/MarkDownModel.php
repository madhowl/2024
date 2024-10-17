<?php

namespace App\Models;

use App\Core\FileSystemClass as FS;

class MarkDownModel
{

    public function getArticleList()
    {
        $dir = 'content/blog/';
        $filesList = scandir($dir);
        $pages = glob($dir . "*.md");
        foreach ($pages as $page) {
            $pageName = substr($page, 8);
            $pageName = substr($pageName, 0, -3);
            echo "<li><a href=\"index.php?id=" . $pageName . "\">" . $pageName . "</a></li>";
        }
    }

    public function getSinglePage($pageName)
    {
        return $pageContent = FS::getContent("content/pages/" . $pageName);
    }

}