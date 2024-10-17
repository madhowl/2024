<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Models\JsonModel;
use App\Models\MarkDownModel;
use App\Views\FrontEndView;
use App\Core\HelperClass as Helper;

class FrontEndController
{
    protected $View;
    private  $Model;

    public function __construct()
    {

        $this->View = new FrontEndView();
        $this->Model = new JsonModel();
        //$this->Model = new MarkDownModel();
    }

    public function app()
    {
        $uri = Helper::getURI();
        $page = Helper::parseURI($uri);
        switch ($page[0]) {
            case 'about':
                $this->showSinglePageMarkDownBlog('about.md');
                break;
            case 'calc':
                include('content/pages/calc.php');
                break;
            case 'articles':
                articleList();
                break;
            case 'page':
                $this->showSinglePageMarkDownBlog($page);
                //showSinglePage($page);
                break;
            default:
                $this->showSinglePageMarkDownBlog('404.md');

        }

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

    public function showSinglePageMarkDownBlog($page)
    {
        $article = $this->Model->getSinglePage($page);
        $this->View->renderSinglePageJsonBlog($article);
    }
}