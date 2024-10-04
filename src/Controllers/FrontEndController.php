<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Views\FrontEndView;
use Twig\Template;

class FrontEndController
{
    protected $View;

    public function __construct()
    {

        $this->View = new FrontEndView();
    }
    public function index()
    {
       $this->View->showIndexPage();
    }
}