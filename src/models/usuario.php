<?php
namespace src\models;
use \core\Model;
use ClanCats\Hydrahon\Query\Sql\Func as F; //Chamar funções de bd nativos, o primeiro param é a função count

class usuario extends Model {
    public $id;
    public $nome;
    public $email;
    public $cpf;
    public $permissao;

    
    public function pegarListaUsuario($offset, $limite){
        $usuarios = usuario::select()->limit($limite)->offset($offset)->execute();
        return $usuarios;
    }

    public function pegarTotalUsuarios(){
        $totalusuarios = usuario::select(new F('count','nome'))->get();
        return $totalusuarios;
    }
}