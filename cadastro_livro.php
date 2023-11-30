<?php require_once('includes/valida_login.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro - Biblioteca Portátil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Livro</h2> 
        <?php if (isset($_GET['erro']) && $_GET['erro']=='email_duplicado'): ?>
            <p>O email preenchido já está cadastrado</p>
        <?php endif; ?>
        <form method="post" action="core/post_cadastro_livro.php" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="insert">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" required>
            </div>
           
            
            <div class="form-group">
                <button type="submit">Cadastrar</button>
                <a href="pagina_principal.php" class="btn">Voltar</a>
                <span class="icons">
                    <a href="#" class="fas fa-book-open"></a>
                    <a href="#" class="fas fa-heart"></a>
                </span>
            </div>
        </form>
    </div>
</body>
</html>