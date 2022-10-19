<?php

// inicialize a sesssão
session_start();
 
require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login
// ensure_user_is_authenticated();

$user_inputs = (array) Data::get_inputs($_SESSION['id']);

if(is_post()) {

    $key = trim($_POST['key']);
    $data = trim($_POST['data']);
    $consumo = trim($_POST['consumo']);
    $demanda_medida = trim($_POST['demanda-medida']);
    $energia_ativa = trim($_POST['energia-ativa']);
    $energia_reativa = trim($_POST['energia-reativa']);

    Data::update_input($_SESSION['id'], $key, $data, $consumo, $demanda_medida, $energia_ativa, $energia_reativa);
    redirect('gerenciar.php');
    
}

include('./views/gerenciar.view.php');

?>