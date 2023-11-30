<header>

    <section class="flex">

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="#" class="logo">Biblioteca Portatil<span>.</span></a>

        <nav class="navbar">
            <?php foreach ($menu as $item):?>
                <a href="<?=$item['link'];?>"><?=$item['label'];?></a>
            <?php endforeach; ?>
        </nav>

        <div class="icons">
            <a href="meus_livros.php" class="fas fa-book-open"></a>
            <a href="livros_desejados.php" class="fas fa-heart"></a>
            <a href="meu_perfil.php" class="fas fa-user"></a>
        </div>

    </section>

</header>
