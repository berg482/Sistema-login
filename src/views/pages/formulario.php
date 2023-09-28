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
            <h1 class="title">Criar usuário</h1>
            <input placeholder="Digite o nome" class="input" type="text" name="nome" />

            <input placeholder="Digite o e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite o CPF" class="input" type="text" name="cpf" pattern="[0-9]{11}" maxlength="11" />

            <input placeholder="Digite a senha" class="input" type="password" name="senha" />

            <h2 class="title">Permissão</h2>
            <div class="permissao">
               
                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_comum" name="permissao" value="comum">
                    <label for="input_permissao_usuario_comum">Comum</label>
                </div>

                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_gerente" name="permissao" value="gerente">
                    <label for="input_permissao_usuario_gerente">Gerente</label>
                </div>

                <div class="radio">
                    <input type="radio" id="input_permissao_usuario_administrador" name="permissao" value="administrador">    
                    <label for="input_permissao_usuario_input_permissao_usuario_administrador">Administrador</label>
                </div>

            </div>
            
            <input class="button" type="submit" nome="submit" value="Salvar" />
            <a href="<?=$base;?>/" class="button">Voltar</a>
            
        </form>
    </section>
</body>
</html>