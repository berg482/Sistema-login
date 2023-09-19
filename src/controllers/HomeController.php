<?php
namespace src\controllers;

use \src\models\usuario;
use \core\Controller; //liberar uso 
use \src\handlers\LoginHandler;

//use src\handlers\LoginHandler as HandlersLoginHandler;

class HomeController extends Controller {

    public $usuariologado; //receber usuario logado

    public function __construct(){   //preencher usuariologado instancia de usuario
        
        $this->usuariologado = LoginHandler::checkLogin();
        if($this->usuariologado === false){
            $this->redirect('/login');
        }
        
    }

    public function index() {
        $usuarios = usuario::select()->execute(); //pegar todos usuarios 
        $this->render('home', [
            'usuarios' => $usuarios, //array usuarios mandando lista $usuarios para view
            //'permissao' => $permissao
            $this->usuariologado->permissao

        ]);
        $this->usuariologado->permissao;
    }

    public function formulario(){
        $this->render('formulario');
    }

    public function acaoformulario(){
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha' );
        $cpf = filter_input(INPUT_POST, 'cpf');
        $permissao = filter_input(INPUT_POST, 'permissao');

        if($nome && $email && $senha && $cpf && $permissao ){

            //$data = usuario::select()->where('email', $email)->execute();
            
            //if(count($data) === 0){ //se não existir
                //usuario::insert([
                    //'nome' => $nome,
                    //'email' => $email,
                    //'senha' => $senha,
                    //'cpf' => $cpf
                //])->execute();
                //$this->redirect('/');

                if(LoginHandler::existeEmail($email) === false){

                    LoginHandler::adicionarUsuario($nome, $email, $senha, $cpf, $permissao );
                    //$_SESSION['token'] = $token;
                    $this->redirect('/');
                }else{
                    $_SESSION['flash'] = 'E-mail já cadastrado';
                    $this->redirect('/formulario');
                }

            //}
            
        }else{
            $this->redirect('/');
        }
        
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
        $permissao = filter_input(INPUT_POST, 'permissao');

        if($nome && $email && $cpf && $permissao){
            //requisição
            usuario::update()
                ->set('nome', $nome)
                ->set('email', $email)
                ->set('cpf', $cpf)
                ->set('permissao', $permissao)
                ->where('id', $args['id'])
            ->execute();
            
            $this->redirect('/');
        }

        $this->redirect('/usuario/'.$args['id'].'/editar');
    }

    public function excluir($args){
        usuario::delete()
            ->where('id', $args['id'])->execute();
        $this->redirect('/');
    }

    
}


