<?php

declare(strict_types=1);

use App\Core\Interfaces\ModelInterface;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequest;
use App\Views\ErrorsView;
use App\Core\CoreModel;


$error = new ErrorsView();

$router = Router::create();

$container = $router->getContainer();
//$dir = 'sqlite:db/2024.sqlite';
$container->singleton('$dir', 'sqlite:db/2024.sqlite');
$container->singleton(PDO::class, fn($dir) => new PDO($dir));
//$container->singleton(PDO::class, 'sqlite:db/2024.sqlite');
//$container->singleton(ModelInterface::class, CoreModel::class);
$container->singleton(ModelInterface::class, \App\Models\Article::class);
$router->setContainer($container);


//$router->get('/core_model', [CoreModel::class, 'getAll']);


$router->get('/', [\App\Controllers\FrontController::class, 'index']);
$router->get('/blog/', [\App\Controllers\FrontController::class, 'showArticlesListPage']);
$router->get('/blog/{id}', [\App\Controllers\FrontController::class, 'showSingleArticlePage']);


$router->get('/admin/', [\App\Controllers\AdminController::class, 'index']);
$router->get('/admin/articles', [\App\Controllers\AdminController::class, 'showArticlesTable']);
$router->get('/admin/article/create', [\App\Controllers\AdminController::class, 'showCreateArticleForm']);
$router->post('/admin/article/store', [\App\Controllers\AdminController::class, 'storeArticle']);
$router->get('/admin/article/{id}/edit', [\App\Controllers\AdminController::class, 'showEditArticleForm']);
$router->post('/admin/article/update', [\App\Controllers\AdminController::class, 'updateArticle']);


$router->dispatch();
/*
try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // It's 404!
    $router->getPublisher()->publish( new HtmlResponse( $error->render404Page(), 404));
} catch (Throwable $e) {
    // Log and report...
    $router->getPublisher()->publish( new HtmlResponse( $error->render500Page(), 500));
}*/