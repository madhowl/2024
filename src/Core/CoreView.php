<?php

namespace App\Core;

use App\Core\Interfaces\ViewInterface;

class CoreView implements ViewInterface
{
    protected $loader;
    protected $twig;

    public function __construct(string $template_path)
    {
        $this->setLoader($template_path);
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function setLoader($path)
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($path);
    }

}