<?php
namespace src\controllers;

use \src\models\usuario;
use \core\Controller; //liberar uso 
use \src\handlers\LoginHandler;
//use src\handlers\LoginHandler as HandlersLoginHandler;

class HomeController extends Controller {

    private $usuariologado; //receber usuario logado

    public function __construct()
    {   //preencher usuariologado instancia de usuario
        $this->usuariologado = LoginHandler::checkLogin(); 
        if($this->usuariologado === false){
            //$this->redirect('/login');
        }
       
    }

    public function index() {
        $this->render('home',);
    }

    public function formulario(){
        $this->render('formulario');
    }

    public function acaoformulario(){
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha' );

        if($nome && $email && $senha){

            $data = usuario::select()->where('email', $email)->execute();
            
            if(count($data) === 0){ //se não existir
                usuario::insert([
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $senha
                ])->execute();
                echo'Inserido com sucesso';
                exit;
            }
            
        }
        echo'Falha ao enserir';
        //$this->redirect('/formulario');
    }


}


