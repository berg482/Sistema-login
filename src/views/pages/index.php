<?php
//namespace src\controllers;

//require_once __DIR__ . '/../../../vendor/autoload.php';

use ClanCats\Hydrahon\Query\Sql\Base;
use src\controllers\IndexController;
use \src\handlers\LoginController;


$IndexController = new IndexController();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login MKT</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
    <script type="text/javascript" src="index.js"></script>
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
                    <th><?= htmlspecialchars($usuario['nome']); ?></th>
                    <th><?= htmlspecialchars($usuario['email']); ?></th>
                    <th><?= str_pad($usuario['cpf'], 11, '0', STR_PAD_LEFT); ?></th>
                    <td class="cell">
                        <?php if($this->usuariologado->permissao != 'comum'): ?>
                            <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/editar">
                                <img src="<?=$base;?>/assets/images/editar.svg" alt"" />
                            </a>
                        <?php endif;?>
                        
                        <?php
                         if($this->usuariologado->permissao == 'administrador'): ?>  
                            <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/excluir" onclick="return confirm('Tem certeza que deseja excluir?')">
                                <img src="<?=$base;?>/assets/images/deletar.svg" alt"" />
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php for($q=1;$q<=$paginas;$q++): ?>
            <a href="<?php echo $base;?>?p=<?php echo $q;?>"class="pagination-link"> <?=$q;?> </a>
        <?php endfor;?>

    </section>

    <?php if($this->usuariologado->permissao != 'comum'):?>
        <div>
            <a href="<?=$base?>/criar" class="button">Criar usuário</a>
        </div>
    <?php endif; ?>
        
    <div>
        <a href="<?=$base;?>/login" class="button">Voltar</a>
    </div>
    
</body>
</html>