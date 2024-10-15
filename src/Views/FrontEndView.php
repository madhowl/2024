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
        echo $this->twig->render('index.twig',['title' => $title, 'description' => $description]);
    }

}