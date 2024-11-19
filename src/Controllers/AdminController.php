<?php

namespace App\Controllers;

use App\Core\Interfaces\ModelInterface;
use App\Models\Article;
use App\Views\AdminView;
use GUMP;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper;

class AdminController
{
    protected $View;
    private  $Article;

    public function __construct(ModelInterface $article)
    {
        $this->View = new AdminView();
        $this->Article = $article;
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
        $message = null;
        $filtered = GUMP::filter_input($request->getParsedBody(), $this->Article->filter);
        unset($filtered['id']);
        $is_valid = GUMP::is_valid($filtered, $this->Article->rules);
        if ($is_valid === true) {
            if ($this->Article->store($filtered) == null) {
                $message = 'Статья добавлена';
            }
        } else {
            $message = $is_valid; // array of error messages
        }

        return $message;
//        $article = $request->getParsedBody();
//        $this->Article->store($article);
//        Helper::goToUrl('/admin/articles');
    }
    public function updateArticle(ServerRequest $request)
    {
        $article = $request->getParsedBody();
        $this->Article->update($article);
        Helper::goToUrl('/admin/articles');
    }
    public function showArticlesTable()
    {
        $articles = $this->Article->getAll();
        echo $this->View->showArticlesTable($articles);
    }

}