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
        <form method="POST" action="<?=$base;?>/usuario/<?=$usuario['id'];?>/editar">

        <?php if(!empty($flash)): ?>
          <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>
            <h1 class="title">Editar usuários</h1></br>
            <input placeholder="Digite o nome" class="input" type="text" name="nome" value="<?=$usuario['nome'];?>" />

            <input placeholder="Digite o e-mail" class="input" type="email" name="email" value="<?=$usuario['email'];?>"  />

            <input placeholder="Digite o CPF" class="input" type="text" name="cpf" value="<?=$usuario['cpf'];?>" pattern="[0-9]{11}" maxlength="11"  />

            <h2 class="title">Permissão</h2>
                
                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_comum" name="permissao" value="comum">
                    <label for="input_permissao_usuario_add">Comum</label>
                </div>
                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_gerente" name="permissao" value="gerente">
                    <label for="input_permissao_usuario_editar">Gerente</label>
                </div>
                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_administrador" name="permissao" value="administrador">
                    <label for="input_permissao_usuario_deletar">Administrador</label>
                </div>
            <input class="button" type="submit" value="Salvar" />
            <a href="<?=$base;?>/" class="button">Sair</a>
        </form>
    </section>
</body>
</html>