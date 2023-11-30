<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Biblioteca Portátil</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2> 
        <?php if (isset($_GET['erro']) && $_GET['erro']=='email_duplicado'): ?>
            <p>O email preenchido já está cadastrado</p>
        <?php endif; ?>
        <form method="post" action="core/post_cadastro.php">
            <input type="hidden" name="acao" value="insert">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
                <a href="login.php" class="btn">Login</a>
            </div>
        </form>
    </div>
</body>
</html>