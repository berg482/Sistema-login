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
        $_SESSION['token'] = '';
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
            $token = LoginHandler::verifyLogin($email, $password); //função verificar senha
            
            if($token){
                $_SESSION['token'] = $token;//armazenar token na sessao
                //$this->redirect('/');     //página inicial
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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action === "sair") {
           
            sair();
        } elseif ($action === "logout") {
            
            session_destroy();
            header("Location: ../view/pages/login.php"); 
            exit;
        }
    }

    
    public function sair(){
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }
    
}


