<?php require_once('includes/valida_login.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários - Biblioteca Portátil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Comentário</h2> 
        <?php if (isset($_GET['erro']) && $_GET['erro']=='email_duplicado'): ?>
            <p>O email preenchido já está cadastrado</p>
        <?php endif; ?>
        <form method="post" action="core/post_cadastro_comentario.php" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="insert">
            <div class="form-group">
                <label for="texto">Texto:</label>
                <input type="text" id="texto" name="texto" required>
            </div>           
            
            <div class="form-group">
                <button type="submit">Publicar</button>
                <a href="pagina_principal.php" class="btn">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>