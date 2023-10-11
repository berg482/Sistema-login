<?php
namespace src\controllers;

use \src\models\usuario;
use \core\Controller;
use \src\handlers\LoginHandler;



class IndexController extends Controller {

    public $usuariologado; 

    public function __construct(){ 
        
        $this->usuariologado = LoginHandler::checkLogin();
        if($this->usuariologado === false){
            $this->redirect('/login');
        }
        
    }

    /**
     * [index description]
     *
     * @return  [type]  [return description]
     */
    public function index() {
        $usuariosModel = new usuario;

        $offset = 0;
        $limite = 2;

        $totalUsuariosArray = $usuariosModel->pegarTotalUsuarios();
        $totalUsuarios = $totalUsuariosArray[0]['count(`nome`)'];
 
        $numeroPaginas = ceil($totalUsuarios/$limite);
        $paginaAtual = 1;

        if(!empty($_GET['p'])){
            $paginaAtual = $_GET['p'];
        }

        $offset = ($paginaAtual*$limite) - $limite;
        $usuarios = $usuariosModel->pegarListaUsuario($offset, $limite);
        
        $this->render('index', [
            'usuarios' => $usuarios, 
            'paginas' => $numeroPaginas,
            'permissao' => $this->usuariologado->permissao
        ]);
    }
    
    /**
     * Método de criação de usuários condicionado a permissão
     * de administrador e gerente ser existente, exibe flash na view se
     * condição não for atendida
     * @return  void
     */
    public function criar(){
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        if($this->usuariologado->permissao != 'comum'){
        $this->render('criar',[
            'flash' => $flash
        ]);
        }else{
            echo 'Criação de usuários não autorizada';
        }
    }

    public function acaocriar(){
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
                    $this->redirect('/criar');
                }            
        }else{
            $_SESSION['flash'] = 'Preencha todos os campos e selecione uma permissão';
            $this->redirect('/criar');
        }
        
    }

    /**
     * Método responsável por enviar para a view de edição informações
     * do usuário selecionado para edição,também bloquea acesso a rota
     * de edição por usuário logado com permissão comum e envia flash para view 
     * @param   int  $args 
     * @return  void 
     */
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
        $usuarioEdicao = usuario::select()->find($args['id']);

        if($nome && $email && $cpf && $permissao ){
            //Possibilita editar o próprio usuário logado sem editar o email
            if($email !== $usuarioEdicao['email'] && LoginHandler::existeEmail($email)){
                $_SESSION['flash'] = 'E-mail já cadastrado';
                $this->redirect('/usuario/'.$args['id'].'/editar');
            }
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

    /**
     * Método de exclusão de usuários de acordo com a permissão
     * Somente para usuário administrador 
     * @param   int  $args
     * @return  void
     */
    public function excluir($args){
        if($this->usuariologado->permissao = 'administrador'){
            usuario::delete()
            ->where('id', $args['id'])->execute();  
        }
        $this->redirect('/');
    }

}


