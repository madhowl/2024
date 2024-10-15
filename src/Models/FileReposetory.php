<?php

namespace App\Models;

class FileReposetory
{
    private string $path;

    public function __construct()
    {
        $this->path = 'content/blog/';
    }

    public function fileList(){
        $file_list = getFileList($this->path);
        foreach ( $file_list as $file){
            $page = $this->getContent($this->path.$file);
            showIntroPage($page);
        }
    }
    public function getFileList($path){
        $file_list =[];
        foreach(glob($path . '/*.md') as $dir) {
            if (is_file($dir)) { $file_list[] = basename($dir);}
        }
        return $file_list;
    }
    public function getContent($path){
        $page = $this->parseFile ($path);
        $pageItem['header'] =(array) json_decode ($page[0]);
        $pageItem['body'] = $page[1];
        return $pageItem;
    }
    public function parseFile($path){
        $content = explode ( '===', getFileContent ($path));
        return $content;
    }
}