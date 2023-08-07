
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
            <a href=""><img src="<?=$base;?>/assets/images/devsbook_logo.png" /></a>
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
                        <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/editar">Editar</a>
                        <a href="<?=$base?>/usuario/<?=$usuario['id']; ?>/excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </section>
</body>
</html>