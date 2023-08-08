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
        $usuarios = usuario::select()->execute(); //pegar todos usuarios 
        $this->render('home', [
            'usuarios' => $usuarios //array usuarios mandando lista $usuarios para view
        ]);
    }

    public function formulario(){
        $this->render('formulario');
    }

    public function acaoformulario(){
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha' );
        $cpf = filter_input(INPUT_POST, 'cpf');

        if($nome && $email && $senha && $cpf){

            $data = usuario::select()->where('email', $email)->execute();
            
            if(count($data) === 0){ //se não existir
                usuario::insert([
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $senha,
                    'cpf' => $cpf
                ])->execute();
                $this->redirect('/');
            }
            
        }
        $this->redirect('/formulario');
    }

    public function editar($args){
        $usuario = usuario::select()->find($args['id']);
        
        $this->render('editar',[
            'usuario' => $usuario
        ]);
    }

    public function acaoeditar($args){
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $cpf = filter_input(INPUT_POST, 'cpf' );

        if($nome && $email && $cpf){
            //requisição
            usuario::update()
                ->set('nome', $nome)
                ->set('email', $email)
                ->set('cpf', $cpf)
                ->where('id', $args['id'])
            ->execute();
            
            $this->redirect('/');
        }

        $this->redirect('/usuario/'.$args['id'].'/editar');
    }

    public function excluir($args){
        echo 'excluindo';
        usuario::delete()
            ->where('id', $args['id'])->execute();
        $this->redirect('/');
    }




}


