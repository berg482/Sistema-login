<?php
namespace src\controllers;

use \src\models\usuario;
use \core\Controller;
use \src\handlers\LoginHandler;

//use src\handlers\LoginHandler as HandlersLoginHandler;

class IndexController extends Controller {

    public $usuariologado; //receber usuario logado

    public function __construct(){   //preencher usuariologado instancia de usuario
        
        $this->usuariologado = LoginHandler::checkLogin();
        if($this->usuariologado === false){
            $this->redirect('/login');
        }
        
    }

    public function index() {
        $usuarios = usuario::select()->execute(); //pegar todos usuarios 
        $this->render('index', [
            'usuarios' => $usuarios, //array usuarios mandando lista $usuarios para view
            //'permissao' => $permissao
            $this->usuariologado->permissao
        ]);
        $this->usuariologado->permissao;
    }

    public function formulario(){
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        if($this->usuariologado->permissao != 'comum'){
        $this->render('formulario',[
            'flash' => $flash
        ]);
        }else{
            echo 'Criação de usuários não autorizada';
        }
    }

    public function acaoformulario(){
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha' );
        $cpf = filter_input(INPUT_POST, 'cpf');
        $permissao = filter_input(INPUT_POST, 'permissao');

        if($nome && $email && $senha && $cpf && $permissao ){

            if(LoginHandler::existeEmail($email) === false){

                LoginHandler::adicionarUsuario($nome, $email, $senha, $cpf, $permissao );
                    $this->redirect('/');
                }else{
                    $_SESSION['flash'] = 'E-mail já cadastrado';
                    $this->redirect('/formulario');
                }            
        }else{
            $_SESSION['flash'] = 'Preencha todos os campos e selecione uma permissão';
            $this->redirect('/formulario');
        }
        
    }

    public function editar($args){
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        if($this->usuariologado->permissao != 'comum'){
            $usuario = usuario::select()->find($args['id']);
            $this->render('editar',[
                'usuario' => $usuario,
                'flash' => $flash
            ]);
        }else{
            echo 'Edição não autorizada';
        }
        
    }

    public function acaoeditar($args){

        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $cpf = filter_input(INPUT_POST, 'cpf' );
        $permissao = filter_input(INPUT_POST, 'permissao');
        

        if($nome && $email && $cpf && $permissao){
            usuario::update()
                ->set('nome', $nome)
                ->set('email', $email)
                ->set('cpf', $cpf)
                ->set('permissao', $permissao)
                ->where('id', $args['id'])
            ->execute();
            
            $this->redirect('/');
        }else{
            $_SESSION['flash'] = 'Preencha todos os campos e escolha uma permissão';
            $this->redirect('/usuario/'.$args['id'].'/editar');
        }

        $this->redirect('/usuario/'.$args['id'].'/editar');
    }

    public function excluir($args){
        if($this->usuariologado->permissao != 'comum'){
            usuario::delete()
            ->where('id', $args['id'])->execute();
            $this->redirect('/');
        }else{
            $this->redirect('/');
        }
    }

    
}


