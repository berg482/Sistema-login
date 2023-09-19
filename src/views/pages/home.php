<?php
//namespace src\controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';
use src\controllers\HomeController;
use \src\handlers\LoginController;


$homeController = new HomeController();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login MKT</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
</head>
<body>
<script  src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <header>
        <div class="container">
            <a href=""><img src="<?=$base;?>/assets/images/logo.png" /></a>
        </div>
    </header>
    <section class="container main">  
        <table border="1" width="100%">
            <tr>
                <th>Nome:</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <th><?= $usuario['nome']; ?></th>
                    <th><?= $usuario['email']; ?></th>
                    <th><?= $usuario['cpf']; ?></th>
                    <td>
                       <?php if($this->usuariologado->permissao != 'comum'): ?>
                        <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/editar">
                            <img src="<?=$base;?>/assets/images/editar.svg" alt"" />
                        </a>
                        <?php endif;?>
                        
                        <?php
                        
                         //$acesso = $usuario['permissao'];
                         //var_dump($acesso);
                         if($this->usuariologado->permissao == 'administrador'): ?>  
                            <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/excluir" onclick="return confirm('Tem certeza que deseja excluir?')">
                                <img src="<?=$base;?>/assets/images/deletar.svg" alt"" />
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <?php if($this->usuariologado->permissao != 'comum'):?>
        <a href="<?=$base?>/formulario">
            <button style="border: 0;
                padding: 10px 20px;
                background-color: #FF4500;
                border-radius: 10px;
                color: #FFF;
                font-size: 15px;
                margin-bottom: 10px;
                cursor: pointer;
                box-shadow: 0px 0px 3px #999;
                ">Criar usuário
            </button>
        </a>
        
    <?php endif; ?>

    <button id="botaoSair">Sair</button>
    
  <script>
    // jQuery está pronto para uso
    $(document).ready(function () {
      // Quando o botão for clicado, exiba um alerta
      $("#botaoSair").click(function () {
        alert("Botão clicado!");
      });
    });
  </script>

    

    

</body>
</html>