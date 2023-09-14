<?php
//namespace src\controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';
use src\controllers\HomeController;

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
                       <?php if($this->usuariologado->permissao == 'administrador' || $this->usuariologado->permissao == 'gerente'): ?>
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
    <a href="<?=$base?>/formulario">Criar usuário</a>
</body>
</html>