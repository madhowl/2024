<?php

declare(strict_types=1);


namespace App\Core;


use App\Views\AdminView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper;

class Auth
{
    /**
     * @var AdminView
     */
    private $View;

    public function __construct()
    {
        $this->View = new AdminView();
    }

    public function showLoginPage()
    {
        if($this->checkAuth()){
            echo "Вы уже авторизованы ";
            exit();
        }
        echo $this->View->renderLoginPage();
    }
    public function checkAuth()
    {
        if (isset($_SESSION['username'])){
            return true;
        } else return false;
    }
    public function logOut()
    {
        $this->signOut();
        Helper::goToUrl('/login');
    }

    public function check(ServerRequest $request)
    {
        $data  = $request->getParsedBody();
        if ($data['email'] == '123@mail.ru' && $data['password']== '123'){
            $this->signIn($data['email'], 1);
            $html = 'User sign in -> ';
            $html .= '<a href="/log-out">EXIT</a>';
            echo $html;
            var_dump($_SESSION);

            //Helper::goToUrl('/admin');
        }else{
            Helper::goToUrl('/login');
        }
    }
    public function signIn(string $username, int $id){
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $id;
    }
    public function signOut(){
        unset($_SESSION['username']) ;
        unset($_SESSION['user_id']) ;
    }

}