<?php

namespace App\Controllers;

use App\Models\Article;
use App\Traits\Auth;
use App\Views\AdminView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper;

class AdminController
{
    use Auth;

    protected $View;
    private  $Article;

    public function __construct()
    {
        $this->checkAuth();
        $this->View = new AdminView();
        $this->Article = new Article();
    }

    public function index()
    {
        echo $this->View->renderIndexPage();
    }
    public function showCreateArticleForm()
    {
        echo $this->View->renderCreateArticlePage();
    }
    public function showEditArticleForm($id)
    {
        $article = $this->Article->find($id);
        echo $this->View->renderEditArticlePage($article);
    }
    public function storeArticle(ServerRequest $request)
    {
        $article = $request->getParsedBody();
        $this->Article->store($article);
        Helper::goToUrl('/admin/articles');
    }
    public function updateArticle(ServerRequest $request)
    {
        $article = $request->getParsedBody();
        $this->Article->update($article);
        Helper::goToUrl('/admin/articles');
    }
    public function destroyArticle($id)
    {
        $this->Article->destroy($id);
        Helper::goToUrl('/admin/articles');
    }
    public function showArticlesTable()
    {
        $articles = $this->Article->getAll();
        echo $this->View->showArticlesTable($articles);
    }

}