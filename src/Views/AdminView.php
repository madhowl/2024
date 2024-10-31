<?php

namespace App\Views;

use App\Core\CoreView;
use App\Core\Helper;

class AdminView extends CoreView
{
    public $formr;
    public function __construct()
    {
        $this->setLoader('template/admin/');
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function renderIndexPage()
    {
        $pagetitle = "Admin Panel";
        return $this->twig->render('layout.twig',compact('pagetitle'));
    }

    public function renderEditArticlePage($article)
    {
        $pagetitle = "Редактирование статьи ID #".$article['id'];
        return $this->twig->render('/articles/edit.twig',compact('pagetitle','article'));
    }
    public function renderCreateArticlePage()
    {
        $pagetitle = "Добавление новой статьи";
        return $this->twig->render('/articles/create.twig',compact('pagetitle'));
    }

    public function showArticlesTable(array $articles)
    {
        $pagetitle = "Список статей";
        return $this->twig->render('/articles/index-table.twig',compact('articles','pagetitle'));
    }

}