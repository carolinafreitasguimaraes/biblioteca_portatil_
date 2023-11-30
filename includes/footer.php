<?php if (isset($pagina)):?>
<?php if ($pagina == 'pagina_principal' || $pagina == 'index'):?>
    
<!-- review section starts  -->

<section class="review" id="review">

<h1 class="heading"> Comentários dos<span> usuarios</span> </h1>
<?php if (isset($_SESSION['login'])): ?>
<center> <a href="cadastro_comentario.php" class="my-btn">Comentar</a></center>
<?php endif; ?>
<br>
<br>

<div class="box-container">

<?php
                date_default_timezone_set('America/Sao_Paulo');
                require_once 'includes/funcoes.php';
                require_once 'core/conexao_mysql.php';
                require_once 'core/sql.php';
                require_once 'core/mysql.php';

                foreach ($_GET as $indice => $dado) {
                    $$indice = limparDados($dado);
                }

                $data_atual = date('Y-m-d H:i:s');
                // é a forma mais fácil de ordenar uma data, pois em caso de ordenação, 
                // o ano é o primeiro parametro a ser verificado, assim, ano>mes>dia 

                // busca o horário do servidor

                $criterio = [
                  ['data_criacao', '<=', $data_atual]
                ];

                $comentarios = buscar(
                    'comentario',
                    [
                        'texto', 
                        'data_criacao',
                        'id',
                        ' (select nome 
                                from usuario
                                where usuario.id = comentario.usuario_id) as nome',
                        ' (select foto 
                        from usuario
                        where usuario.id = comentario.usuario_id) as foto'
                    ],
                    $criterio,
                    'data_criacao DESC'
                );
                ?>

<?php
        foreach ($comentarios as $comentario) :
            $data = date_create($comentario['data_criacao']);
            $data = date_format($data, 'd/m/Y H:i:s');
?>
    <div class="box">
        <p><?=$comentario['texto'];?></p>
        <div class="user">
            <?php if (trim($comentario['foto']) !== ''): ?>
                <img src="./uploads/<?=$comentario['foto'];?>" alt="">
            <?php else: ?> 
                <img src="./images/foto_padrao.jpg" alt="">
            <?php endif; ?>
            <div class="user-info">
                <h3><?=$comentario['nome'];?></h3>
                <!--<span>happy customer</span>-->
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>
<?php endforeach;?> 
   

</div>
    
</section>

<!-- review section ends -->

<!-- contact section starts  -->
<?php endif; ?>
<?php endif; ?>

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Links rápidos</h3>
            <a href="index.php#">Inicio</a>
            <a href="index.php#about">Sobre</a>
            <a href="#products">Livros</a>
            <a href="#review">Comentários</a>
        </div>

        <div class="box">
            <h3>Informações de contato</h3>
            <a href="#">+55 18981247130</a>
            <a href="#">carolina.guimaraes@aluno.ifsp.edu.br</a>
            <a href="#"></a>
            <!--<img src="images/payment.png" alt="">-->
        </div>

    </div>

    <div class="credit"> IFSP-Birigui <span> Biblioteca Portátil </span> </div>

</section>

<!-- footer section ends -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
