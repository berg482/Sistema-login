<?php
namespace src\handlers;
use \src\models\usuario;

class LoginHandler {// classe especifica para verificar login
    
    public static function checkLogin(){
        if(!empty($_SESSION['token'])){//se existir e não estiver vazia
            $token = $_SESSION['token']; //pegar token

            $data = usuario::select()->where('token', $token)->one();//verificação
            if(count($data) > 0){

                $usuariologado = new usuario();//instancia, montando classe de usuário
                $usuariologado->id = $data['id'];
                $usuariologado->email = $data['email']; 
                $usuariologado->name = $data['nome'];

                return $usuariologado;
            }

        }
        return false;
    }

    public static function verifyLogin($email, $senha){
        $user = usuario::select()->where('email', $email)->one(); //buscar usuario no banco 
        
        if($user){
            if(password_verify($senha, $user['senha'])){ //função verificar senha com hash
                $token = md5(time().rand(0,9999999)); //gerar token
                
                usuario::update()              //Alterar no usuario, salvar token
                    ->set('token', $token)
                    ->where('email', $email)
                ->execute(); 
                
                return $token; 
            }
        }
        return false;
    }
}