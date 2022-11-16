<?php

// inicialize a sessão
session_start();

require_once('app/app.php');
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();
 
$efetivo = $metragem = $demanda = $modalidade = 0;

if(is_post()) {

    if(!empty(trim($_POST['efetivo']))) {
       $efetivo = trim($_POST['efetivo']);
    }

    if(!empty(trim($_POST['metragem']))) {
        $metragem = trim($_POST['metragem']);
    }

    if(!empty(trim($_POST['demanda']))) {
        $demanda = trim($_POST['demanda']);
    }

    if(!empty(trim($_POST['modalidade']))) {
        $modalidade = trim($_POST['modalidade']);
    }
    
    Data::update_user($_SESSION['id'], $efetivo, $metragem, $demanda, $modalidade);

}

$sec = Data::get_secundary(($_SESSION['id']));
$profile_warnings = array_map('value', $sec);

include('./views/profile.view.php');

?>
