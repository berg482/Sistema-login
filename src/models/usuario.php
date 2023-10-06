<?php
namespace src\models;
use \core\Model;

class usuario extends Model {
    public $id;
    public $nome;
    public $email;
    public $cpf;
    public $permissao;

    
    public function pegarLista($offset, $limite){
        $usuarios = usuario::select()->limit(2)->execute();
        return $usuarios;
    }
}