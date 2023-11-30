<?php
    session_start();
    // Grava onde estava
   // */ $_SESSION['url_retorno'] = $_SERVER['PHP_SELF'];//
    //var_dump ($_SESSION); exit;
    if(!isset($_SESSION['login'])){
        header('Location: ./login.php?erro=usuario_nao_logado');
        exit;
    }
?>