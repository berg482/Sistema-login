<?php
namespace src\handlers;
use \src\models\usuario;
//error_reporting(E_ALL);
ini_set("display_errors", 1);
//include("file_with_errors.php");

class LoginHandler {// classe especifica para verificar login

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){//se existir e não estiver vazia

            $token = $_SESSION['token']; //pegar token
            
            $data = usuario::select()->where('token', $token)->execute();//verificação
            //echo '<pre>';
            //highlight_string("<?php\n" . var_export($data, true));
            //echo '</pre>';
            if(is_array($data)){
                $cont = count($data);
            }else{
                $cont = 0;
            }
            if($cont > 0){

                $usuariologado = new usuario();//instancia, montando classe de usuário
                if (isset($data[0]['permissao'])) {
                    $usuariologado->permissao = $data[0]['permissao'];
                    $usuariologado->email = $data[0]['email'];
                }
               
                return $usuariologado;
            }

        }
        return false;
    }

    public static function verifyLogin($email, $password){
        $user = usuario::select()->where('email', $email)->one(); //buscar usuario no banco 
        
        if($user){
            if(password_verify($password, $user['senha'])){ //função verificar senha com hash

                $token = md5(time().rand(0,9999999).time()); //gerar token
                //$tokenLengh = 32;
                //$token = bin2hex(random_bytes($tokenLengh));
        
                usuario::update()//update             //Alterar no usuario, salvar token
                    ->set('token', $token)
                    ->where('email', $email)
                    //'token' => $token
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
        //$token = md5(time().rand(0,9999999));

        usuario::insert([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hash,
            'cpf' => $cpf,
            'permissao' => $permissao
        ])->execute();

    }

}