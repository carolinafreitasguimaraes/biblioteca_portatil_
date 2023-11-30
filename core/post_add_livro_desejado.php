<?php require_once('../includes/valida_login.php');?> 
<?php
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';

foreach ($_POST as $indice => $dado) {
    $$indice = limparDados($dado);
}

foreach ($_GET as $indice => $dado) {
    $$indice = limparDados($dado);
}

if (isset($livro_id)) {
    $dados = [
        'livro_id' => $livro_id,
        'usuario_id' => $_SESSION['login']['usuario']['id']
    ];

    insere(
        'usuario_livros_desejados',
        $dados
    );
    header('Location: ../livros_desejados.php?msg=sucesso');
    exit;
}

if ($_SESSION['erros']) {
   // var_dump($_SESSION['erros']); 
    if ($_SESSION['erros'][0]['sqlstate']=='23000') {
        //header('Location: ../cadastro.php?erro=email_duplicado');
    }
}
 header('Location: ../livros_desejados.php');
