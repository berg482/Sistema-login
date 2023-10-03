<?php
namespace src\handlers;
use \src\models\usuario;
//error_reporting(E_ALL);
ini_set("display_errors", 1);
//include("file_with_errors.php");

class LoginHandler {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            if (!empty($_SESSION['token'])) {
                $token = $_SESSION['token'];
                $data = usuario::select()->where('token', $token)->execute();
        
                if ($data && isset($data[0]['permissao'], $data[0]['email'])) {
                    $usuariologado = new usuario();
                    $usuariologado->permissao = $data[0]['permissao'];
                    $usuariologado->email = $data[0]['email'];
                    return $usuariologado;
                }
            }
            return false;
        }
    }

    public static function verifyLogin($email, $password){
        $user = usuario::select()->where('email', $email)->one(); 
        if($user){
            if(password_verify($password, $user['senha'])){ 
                $token =  password_hash(time() . rand(0, 9999999) . time(), PASSWORD_BCRYPT);
                usuario::update()       
                    ->set('token', $token)
                    ->where('email', $email)
                    ->execute();
                return $token; 
            }
        }
        return false;
    }

    public static function existeEmail($email){
        $user = usuario::select()->where('email', $email)->one();
        return $user ? true : false; 
    }

    public static function adicionarUsuario($nome, $email, $senha, $cpf, $permissao){
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        usuario::insert([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash,
            'cpf' => $cpf,
            'permissao' => $permissao
        ])->execute();
    }

}