<?php
// --------- display all errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// --------------


//include_once './inc/function.php';
require('vendor/autoload.php');

use MiladRahimi\PhpRouter\Router;
use Laminas\Diactoros\Response\JsonResponse;

$router = Router::create();

$router->get('/', [App\Controllers\FrontEndController::class, 'showBlogJsonPage']);
$router->get('/page/{id}', [App\Controllers\FrontEndController::class, 'showSinglePageJsonBlog']);

$router->dispatch();




//
//
//$front = new \App\Controllers\FrontEndController();
//$model = new \App\Models\MarkDownModel();
//
//$front->app();
//$front->showBlogJsonPage();
//$front->showSinglePageJsonBlog(2);


//
//$model->getArticleList();
//var_dump($model->getSinglePage('main.md'));




