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

if (isset($id)) {
    $criterio = [
        ['id', '=', $id],
        [' AND ', 'usuario_id', '=', $_SESSION['login']['usuario']['id']]
    ];

    deleta(
        'usuario_livros_desejados',
        $criterio
    );
    header('Location: ../livros_desejados.php?msg=removido_sucesso');
    exit;
}

if ($_SESSION['erros']) {
   // var_dump($_SESSION['erros']); 
    if ($_SESSION['erros'][0]['sqlstate']=='23000') {
        //header('Location: ../cadastro.php?erro=email_duplicado');
    }
}
 header('Location: ../livros_desejados.php');
