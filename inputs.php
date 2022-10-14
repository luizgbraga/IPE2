<?php

// inicialize a sessão
session_start();

require_once('app/app.php');
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();
 
$data = $consumo = $demanda_medida = $energia_reativa = $energia_ativa =  '';
$data_err = $consumo_err = $demanda_medida_err = $energia_reativa_err = $energia_ativa_err =  '';
 
if(is_post()) {
 
    if(empty(trim($_POST['data']))) {
        $data_err = 'Insira uma data';
    } else {
        $data = trim($_POST['data']);
    }
    
    if(empty(trim($_POST['consumo']))) {
        $consumo_err = 'Insira o consumo de sua OM';     
    } else {
        $consumo = trim($_POST['consumo']);
    }

    if(empty(trim($_POST['demanda-medida']))) {
        $demanda_medida_err = 'Insira um demanda para sua OM';     
    } else {
        $demanda_medida = trim($_POST['demanda-medida']);
    }

    if(empty(trim($_POST['energia-reativa']))) {
        $energia_reativa_err = 'Insira uma energia reativa para sua OM';     
    } else {
        $energia_reativa = trim($_POST['energia-reativa']);
    }

    if(empty(trim($_POST['energia-ativa']))) {
        $energia_ativa_err = 'Insira uma energia ativa para sua OM';     
    } else {
        $energia_ativa = trim($_POST['energia-ativa']);
    }

    if(empty($data_err) && empty($consumo_err) && empty($demanda_medida_err) && empty($demanda_reativa_err) && empty($demanda_ativa_err)) {
        Data::add_input($_SESSION['id'], $data, $consumo, $demanda_medida, $energia_ativa, $energia_reativa);
    }
}

include('./views/inputs.view.php');

?>

