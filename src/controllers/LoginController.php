<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
//ini_set("display_errors", 1);
//include("file_with_errors.php");
class LoginController extends Controller {

    //public function __construct()
    //{
        
    //}

    public function logar(){
        $flash = '';
        if(!empty($_SESSION['flash'])){ //se está preenchido 
            $flash = $_SESSION['flash']; //salva mensagem
            $_SESSION['flash'] = '';     // apagando da sessão
        }
        $this->render('login', [
            'flash' => $flash       //mostrando flash unica vez
        ]);//criar view login
    }

    public function acaologar() {
       //filtrar e receber os dados
       $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
       $password = filter_input(INPUT_POST, 'password' );
       //verificar dados
       if($email && $password){
            $token = LoginHandler::verifyLogin($email, $password); // função verificar senha
            var_dump($token);
            if($token){
                $_SESSION['token'] = $token;//armazenar token na sessao
                //$this->redirect('/');//página inicial

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


   


}


