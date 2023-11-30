<?php require_once('includes/valida_login.php');//?> 

<?php
$titulo = 'Meus Livros';
$menu = [
    [
        'label' => 'Livros',
        'link' => 'pagina_principal.php#products'
    ],
    [
        'label' => 'Comentários',
        'link' => 'pagina_principal.php#review'
    ],
];
?>
<?php require_once ('includes/header.php');?>
<?php require_once ('includes/menu.php');?>

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
                   //['usuario_id', '=', $_SESSION['login']['usuario']['id']]
                ];

                if (!empty($busca)) {
                    $criterio[] = [
                       // 'AND',
                        'titulo',
                        'like',
                        // like é para buscar em qualquer parte do post.
                        "%{$busca}%"
                        // refere-se ao campo de nome busca, para ver se ele está preenchido
                    ];
                }

                $qtd = $qtd ?? 9;

                $livros = buscar(
                    'usuario_livros',
                    [
                        'livro.titulo',
                        'livro.imagem', 
                        'usuario_livros.data_criacao',
                        'usuario_livros.id',
                        ' (select nome 
                                from usuario
                                where usuario.id = usuario_livros.usuario_id) as nome'
                    ],
                    $criterio,
                    'usuario_livros.data_criacao DESC ' . ' LIMIT ' . $qtd,
                    'INNER JOIN livro ON livro.id = usuario_livros.livro_id AND usuario_livros.usuario_id = ' . $_SESSION['login']['usuario']['id']
                );
                ?>

    <div class="container">
        <?php if (isset($_GET['msg']) && $_GET['msg']=='sucesso'): ?>
          <h2 style="margin-left: auto; margin-right: auto;">Livro adicionado com sucesso!</h2>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg']=='removido_sucesso'): ?>
          <h2 style="margin-left: auto; margin-right: auto;">Livro removido com sucesso!</h2>
        <?php endif; ?>
        <form action="meus_livros.php" method="get">
            <div class="input-group mb-3">
                <input type="text" name="busca" value="<?=isset($busca) ? $busca : ''; ?>" class="form-control" placeholder="Pesquisar Livro" aria-label="Pesquisar Livro" aria-describedby="button-addon2">
                <button class="btn btn-success" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
            </div> 
        </form>
    </div>
    <center> <a href="cadastro_livro.php" class="my-btn">Cadastrar Livro</a></center>
        <br/>
        <br/>
    <div class="box-container">

    <?php if (empty($livros)): ?>
        <h2 style="margin-left: auto; margin-right: auto;">Livro não cadastrado nos seus livros</h2>
    <?php endif; ?>

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
                    <a href="core/post_rm_meus_livros.php?id=<?=$livro['id'];?>" class="fas fa-trash-alt"></a>
                    <a href="core/post_add_livro_desejado.php?livro_id=<?=$livro['id'];?>" class="fas fa-heart"></a>
                 
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
        <center> <a href="meus_livros.php?qtd=<?=$qtd+9;?>#carregar_mais" class="my-btn">Carregar Mais</a></center> 
    </div>

</section>

<?php require_once ('includes/footer.php');?>