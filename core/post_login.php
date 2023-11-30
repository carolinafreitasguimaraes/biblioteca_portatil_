<?php
session_start();
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';
$salt = 'ABBA';

foreach($_POST as $indice => $dado){
    $$indice = limparDados($dado);
    // cria a variável
}

foreach($_GET as $indice => $dado){
    $$indice = limparDados($dado);
}
switch($acao){

        case 'login':
            $criterio = [
                ['email', '=', $email],
                ];
                // verifica se o email está ativa

        $retorno = buscar(
            'usuario',
            ['id','nome','email','senha'],
            $criterio
        );

        if(count($retorno) > 0){
            if(crypt($senha,$salt) == $retorno[0]['senha']){
                $_SESSION['login'] = [
                    'usuario' => $retorno[0]
                ];
                
                if(!empty($_SESSION['url_retorno'])){
                    header('Location:' . $_SESSION['url_retorno']);
                    $_SESSION['url_retorno'] = '';
                    exit;
                    // se em algum momento a sessão expirar ou algo do tipo, ele volta para o url desejado.
                } else {
                    header('Location: ../pagina_principal.php?msg=login_sucesso');
                    exit;
                }
            } else {
                header('Location: ../login.php?erro=usuario_invalido');
                exit;
            }
        }

    break;
    case 'logout':
        session_destroy();
        break;

}
header('Location: ../login.php?erro=usuario_invalido');
exit;
// quando não tiver, padrão index
?>