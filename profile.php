<?php

// inicialize a sessão
session_start();

require_once('app/app.php');
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

 
$efetivo = $metragem = $demanda = $modalidade = '';

if(is_post()) {

    $efetivo = trim($_POST['efetivo']);
    $metragem = trim($_POST['metragem']);
    $demanda = trim($_POST['demanda']);
    $modalidade = trim($_POST['modalidade']);
    Data::update_user($_SESSION['id'], $efetivo, $metragem, $demanda, $modalidade);

}

$sec = Data::get_secundary(($_SESSION['id']));

include('./views/profile.view.php');
?>
