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
        <form method="POST" action="<?=$base;?>/formulario">

        <?php if(!empty($flash)): ?>
          <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>
        
            <input placeholder="Digite o nome" class="input" type="text" name="nome" />

            <input placeholder="Digite o e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite o CPF" class="input" type="text" name="cpf" />

            <input placeholder="Digite a senha" class="input" type="password" name="senha" />

            <h2>Permissão</h2>
            <div class="permissao">
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_login" name="permissao[]" value="login">
                    
                    <label for="input_permissao_login">Login</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_add" name="permissao[]" value="usuario_add">
                    
                    <label for="input_permissao_usuario_add">Add usuário</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_editar" name="permissao[]" value="usuario_editar">
                    
                    <label for="input_permissao_usuario_editar">Editar usuário</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_deletar" name="permissao[]" value="usuario_deletar">
                    
                    <label for="input_permissao_usuario_deletar">Deletar usuário</label>
                </div>
            </div>

            <input class="button" type="submit" value="Salvar" />
            <a href="<?=$base;?>/login" class="button">Sair</a>
        </form>
    </section>
</body>
</html>