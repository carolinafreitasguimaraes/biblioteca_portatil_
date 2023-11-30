<?php session_start();?> 

<?php
$titulo = 'Página Inicial';
$pagina = 'index';
$menu = [
    [
        'label' => 'Início',
        'link' => 'index.php'
    ],
    [
        'label' => 'Sobre',
        'link' => '#about'
    ],
    [
        'label' => 'Livros',
        'link' => '#products'
    ],
    [
        'label' => 'Comentários',
        'link' => '#review'
    ]
];
?>
<?php require_once ('includes/header.php');?>
<?php require_once ('includes/menu.php');?>

<!-- home section starts  -->

<div class="home-container">

    <section class="home" id="home">

        <div class="content">
            <h3>Biblioteca Portátil</h3>
            <span> Recomendações de livros & Avaliações </span>
            <p>Seja bem-vindo ao projeto Biblioteca Portátil, estamos felizes  com sua colaboração!</p>
            <a href="cadastro.php" class="my-btn">Criar Conta</a>
        </div>
        
    </section>

</div>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span> Sobre </span> nós </h1>

    <div class="row">

        <div class="video-container">
            <img src="images/gif.gif" alt="">
            <h3>Categorize seus livros</h3>
        </div>

        <div class="content">
            <h3>O que nós somos e fazemos?</h3>
            <p>Somos uma plataforma digital em formato de site que busca ajudá-lo a categorizar seus livros e com nosso algorítimo indicar livros de acordo com o seu gosto!</p>
            <p>Nós fazemos nosso trabalho por meio de nosso Website, venha e crie uma conta!</p>
            <a href="cadastro.php" class="my-btn">Criar conta</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<h1 class="heading"> <span> Nossos </span> livros </h1>
<section class="products" id="products">

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
                   // ['data_postagem', '<=', $data_atual]
                ];

                if (!empty($busca)) {
                    $criterio[] = [
                        //'AND',
                        'titulo',
                        'like',
                        // like é para buscar em qualquer parte do post.
                        "%{$busca}%"
                        // refere-se ao campo de nome busca, para ver se ele está preenchido
                    ];
                }

                $qtd = $qtd ?? 9;

                $livros = buscar(
                    'livro',
                    [
                        'titulo',
                        'imagem', 
                        'data_criacao',
                        'id',
                        ' (select nome 
                                from usuario
                                where usuario.id = livro.usuario_id) as nome'
                    ],
                    $criterio,
                    'data_criacao DESC ' . ' LIMIT ' . $qtd,
                );
                ?>

    <div class="box-container">

    <?php
        foreach ($livros as $livro) :
            $data = date_create($livro['data_criacao']);
            $data = date_format($data, 'd/m/Y H:i:s');
    ?>

        <div class="box">
           <!-- <span class="discount">-10%</span> -->
            <div class="image">
                <img src="<?= 'uploads/'.$livro['imagem']; ?>" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-book-open"></a>
                    <a href="#" class="fas fa-heart"></a>
                 
                </div>
            </div>
            <div class="content">
                <h3><?= $livro['titulo']; ?></h3>
               <!--<div class="price"> $12.99 <span>$15.99</span> </div>-->
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    
    <br>
    <br> 
    <div id="carregar_mais"> 
        <center> <a href="index.php?qtd=<?=$qtd+9;?>#carregar_mais" class="my-btn">Carregar Mais</a></center> 
    </div>
</section>

<?php require_once ('includes/footer.php');?> 