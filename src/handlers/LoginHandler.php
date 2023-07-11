<?php
namespace src\handlers;
use \src\models\User;

class LoginHandler {// classe especifica para verificar login
    
    public static function checkLogin(){
        if(!empty($_SESSION['token'])){//se existir e não estiver vazia
            $token = $_SESSION['token']; //pegar token

            $data = User::select()->where('token', $token)->one();//verificação
            if(count($data) > 0){

                $loggedUser = new User();//instancia, montando classe de usuário
                $loggedUser->id = $data['id'];
                $loggedUser->email = $data['email']; 
                $loggedUser->name = $data['name'];

                return $loggedUser;
            }

        }
        return false;
    }

    public static function verifyLogin($email, $password){
        $user = User::select()->where('email', $email)->one(); //buscar usuario no banco 
        
        if($user){
            if(password_verify($password, $user['password'])){ //função verificar senha com hash
                $token = md5(time().rand(0,9999999)); //gerar token
                
                User::update()              //Alterar no usuario, salvar token
                    ->set('token', $token)
                    ->where('email', $email)
                ->execute(); 
                
                return $token; 
            }
        }
        return false;
    }
}