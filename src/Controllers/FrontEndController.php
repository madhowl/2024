<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Models\JsonModel;
use App\Views\FrontEndView;
use Twig\Template;

class FrontEndController
{
    protected $View;
    private  $Model;

    public function __construct()
    {

        $this->View = new FrontEndView();
        $this->Model = new JsonModel();
    }
    public function index()
    {
       $this->View->showIndexPage();
    }

    public function showBlogJsonPage()
    {
        $articles = $this->Model->getArticles();
        $this->View->renderBlogJsonPage($articles);
    }
    public function showSinglePageJsonBlog($id)
    {
        $article = $this->Model->getArticleById($id);
        $this->View->renderSinglePageJsonBlog($article);
    }
}