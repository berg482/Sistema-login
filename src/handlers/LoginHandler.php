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

    /**
     * Função de verificação de login, verifica se existe email no banco de dados
     * e atravez da funçao password_verify compara a senha digitada com hash no banco
     * após todas as verificações cria um token para o usuário e registra no banco
     *
     * @param   varchar  $email     
     * @param   string  $password  
     *
     * @return  $token  Retorno do token condicionado a verificação de senha
     * @return  false   Retorno falso quando usuário não for encontrado usando email             
     */
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

    /**
     * Método que verifica se existe email já cadastrado no banco de
     * dados, evitando duplicação de email 
     * @param string $email
     * @return bool $existeEmail
     */
    public static function existeEmail($email){
        $existeEmail = usuario::select()->where('email', $email)->one();
        return $existeEmail ? true : false;
    }

    /**
     * Método que adiciona usuários no banco de dados e senha como hash recebendo 
     * nome, email, senha, cpf, permissao como parâmetros
     *  
     * @param   int      $nome       
     * @param   varchar  $email      
     * @param   string     $senha      
     * @param   bigint   $cpf        
     * @param   text     $permissao  
     *
     * @return  void     
     */
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