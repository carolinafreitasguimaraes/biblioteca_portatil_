<?php
session_start();
?>

<div class="card">
    <div class="card-header">
        <h1>Projeto Blog em PHP + MySQL IFSP - Carol</h1>
    </div>

    <?php if (isset($_SESSION['login'])) : ?>
        <div class="card-body text-right bg-dark text-white">
            Olá <?php echo $_SESSION['login']['usuario']['nome'] ?>!
            <a href="core/usuario_repositorio.php?acao=logout" class="text-danger">Sair</a>

        </div>
    <?php endif ?>
</div>