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

$salt = 'ABBA';

switch ($acao) {
    case 'insert':

        $dados = [
            'nome' => $nome,
            'email' => $email,
            'senha' => crypt($senha,$salt)
        ];

        insere(
            'usuario',
            $dados
        );

        break;
}

if ($_SESSION['erros']) {
   // var_dump($_SESSION['erros']); 
    if ($_SESSION['erros'][0]['sqlstate']=='23000') {
        header('Location: ../cadastro.php?erro=email_duplicado');
    }
}
header('Location: ../login.php?msg=cadastro_sucesso');
