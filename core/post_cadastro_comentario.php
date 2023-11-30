<?php require_once('../includes/valida_login.php');//?>
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

switch ($acao) {
    case 'insert':

        $dados = [
            'texto' => $texto,
            'usuario_id' => $_SESSION['login']['usuario']['id']
        ];

        insere(
            'comentario',
            $dados
        );

        break;
}

if ($_SESSION['erros']) {
   // var_dump($_SESSION['erros']); 
    if ($_SESSION['erros'][0]['sqlstate']=='23000') {
        //header('Location: ../cadastro.php?erro=email_duplicado');
    }
}
 header('Location: ../pagina_principal.php');
