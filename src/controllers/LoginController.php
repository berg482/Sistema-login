<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {



    public function logar(){
        $flash = '';
        if(!empty($_SESSION['flash'])){ //se está preenchido 
            $flash = $_SESSION['flash']; //salva mensagem
            $_SESSION['flash'] = '';     // apagando da sessão
        }
        $this->render('login', [
            'flash' => $flash       //mostrando flash unica vez
        ]);
    }

    public function acaologar() {
       //filtrar e receber os dados
       $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
       $password = filter_input(INPUT_POST, 'password' );
       //verificar dados
       if($email && $password){
            $token = LoginHandler::verifyLogin($email, $password); //função verificar senha
            
            if($token){
                $_SESSION['token'] = $token;
                $this->redirect('/');
            }else{
                $_SESSION['flash'] = 'email e/ou senha não conferem';
                $this->redirect('/login');
            } 
       }else{
        $_SESSION['flash'] = 'Digite os campos corretamente';
        $this->redirect('/login');
       }
    }

    public function sair(){
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }
    
}


