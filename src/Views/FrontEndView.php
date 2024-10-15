<?php

namespace App\Views;

use App\Core\CoreView;

class FrontEndView extends CoreView
{
    public function showIndexPage()
    {
        $title = 'Главная страница';
        $description = 'Описание Главной страницы';
//        $template = $this->twig->load('index.twig');
//        echo $template->render(['title' => $title, 'description' => $description ]);
        echo $this->twig->render('index.twig', ['title' => $title, 'description' => $description]);
    }

    public function renderBlogJsonPage($articles)
    {
        $title = 'Блог на Json';
        $description = 'Вывод всех статей';
        echo $this->twig->render('articles-list.twig',compact('title', 'description', 'articles'));
    }
    public function renderSinglePageJsonBlog($article)
    {
        $title = 'Блог на Json';
        $description = 'Вывод стастьи';
        echo $this->twig->render('single-article-page.twig',compact('title', 'description', 'article'));
    }

}