<?php

// inicialize a sesssão
session_start();
 
require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

$id = $_SESSION['id'];
 
$mensagens = (array) Data::get_mensagens($id);

include('./views/mensagens.view.php');

?>