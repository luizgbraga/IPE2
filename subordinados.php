<?php

// inicialize a sessão
session_start();

require_once('app/app.php');
 
// verifique se está logado; senão, redirecione para o login
// ensure_user_is_authenticated();

require('app/data/classes/charts.class.php');
 
$subordinados = Data::get_subordinados($_SESSION['id']);

// SUBORDINADOS


if(is_get()) {


}

include('./views/subordinados.view.php');

?>
