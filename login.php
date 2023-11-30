<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca Portátil</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2> 
        <?php if (isset($_GET['erro']) && $_GET['erro']=='usuario_invalido'): ?>
            <p>Email ou senha incorretos</p>
        <?php endif; ?>
        <?php if (isset($_GET['erro']) && $_GET['erro']=='usuario_nao_logado'): ?>
            <p>Usuário não logado</p>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg']=='cadastro_sucesso'): ?>
            <p>Cadastro realizado com sucesso! Faça o login</p>
        <?php endif; ?>
        <form method="post" action="core/post_login.php">
            <input type="hidden" name="acao" value="login">
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <button type="submit">Entrar</button>
                <a href="cadastro.php" class="btn">Cadastro</a>
            </div>
        </form>
    </div>
</body>
</html>