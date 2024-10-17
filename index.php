<?php
// --------- display all errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// --------------


//include_once './inc/function.php';
require('vendor/autoload.php');

$front = new \App\Controllers\FrontEndController();
$model = new \App\Models\MarkDownModel();

$front->app();
//$front->showBlogJsonPage();
//$front->showSinglePageJsonBlog(2);


//
//$model->getArticleList();
//var_dump($model->getSinglePage('main.md'));




