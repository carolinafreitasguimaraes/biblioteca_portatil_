<?php require_once('includes/valida_login.php');//?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Adicione o link para o Font Awesome -->
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/meu_perfil.css">

</head>
<body>
    <div class="container">

        <?php
                require_once 'includes/funcoes.php';
                require_once 'core/conexao_mysql.php';
                require_once 'core/sql.php';
                require_once 'core/mysql.php';

                if (isset($_SESSION['login'])) {
                    // verifica se está logado
                    $id = (int) $_SESSION['login']['usuario']['id'];

                    $criterio = [
                        ['id', '=', $id]
                    ];

                    $retorno = buscar(
                        // busca dados do usuário 
                        'usuario',
                        ['id', 'nome', 'email', 'foto'],
                        $criterio
                    );

                    $entidade = $retorno[0];
                }
                ?>
        <?php if (isset($entidade['foto']) && trim($entidade['foto']) != ''): ?>
            <center><img src="./uploads/<?= $entidade['foto'];?>" width="80" class="foto"/></center>    
        <?php else: ?>
            <h2 class="user-icon"><i class="fas fa-user"></i></h2> <!-- Ícone de usuário -->
        <?php endif; ?>
        <h2>Perfil</h2>

        <?php if (isset($_GET['msg']) && $_GET['msg']=='alteracao_sucesso'): ?>
            <p>A alteração foi realizada com sucesso!</p>
        <?php endif; ?>
        <form method="post" action="core/post_meu_perfil.php" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="<?php echo 'update' ?>">
            <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $entidade['nome'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $entidade['email'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="text" id="senha" name="senha">
            </div>
            
            <div class="form-group">
                <button type="submit">Atualizar</button>
                <a href="pagina_principal.php" class="btn">Voltar</a>
                <a href="./core/logout.php" class="btn">Sair</a>
            </div>
        </form>
    </div>
</body>
</html>