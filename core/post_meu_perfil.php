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

function uploadImagem() {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $nome_imagem = md5(uniqid(rand(),true)).'.'.$imageFileType;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["foto"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["foto"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return '';
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], '../uploads/'.$nome_imagem)) {
        return $nome_imagem;
      } else {
        return '';
      }
    }
   
}
switch ($acao) {
    case 'update':
        $id = (int)$id;
        $dados = [
            'nome'=> $nome,
            'email' => $email
        ];

        if (isset($senha) && trim($senha)!='') {
            $salt='ABBA';
            $dados['senha']=crypt($senha,$salt);
        }

        $foto = uploadImagem();
        if (isset($foto) && trim($foto)!='') {
            $dados['foto']=$foto;
        }

        $criterio = [
            ['id', '=', $id]
        ];

        atualiza(
            'usuario',
            $dados,
            $criterio
        );

        break;
}

if ($_SESSION['erros']) {
   // var_dump($_SESSION['erros']); 
    if ($_SESSION['erros'][0]['sqlstate']=='23000') {
        //header('Location: ../cadastro.php?erro=email_duplicado');
    }
}

header('Location: ../meu_perfil.php?msg=alteracao_sucesso');