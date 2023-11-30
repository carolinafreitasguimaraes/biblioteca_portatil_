<?php require_once('../includes/valida_login.php');?> 
<?php
unset($_SESSION['login']);

header('Location: ../login.php'); 
