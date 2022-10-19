<?php

// inicialize a sesssão
session_start();
 
require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login


$user_inputs = (array) Data::get_inputs($_SESSION['id']);

include('./views/gerenciar.view.php');

?>