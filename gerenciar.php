<?php

// inicialize a sesssão
session_start();
 
require_once("app/app.php");

// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

$en_inputs = Data::get_energetic($_SESSION['id']);
$modalidade = $en_inputs['modalidade'];

if($_SESSION['master'] == 1) {
  $user_inputs = (array) Data::get_inputs($_SESSION['id']);
} else {
  $user_inputs = (array) Data::get_inputs($_SESSION['associate-id']);
}

if(is_post()) {

    $key = trim($_POST['key']);
    $data = trim($_POST['data']);
    $consumo_p = trim($_POST['consumo-p']);
    $consumo_fp = trim($_POST['consumo-fp']);
    $demanda_medida = trim($_POST['demanda-medida']);
    $energia_ativa = trim($_POST['energia-ativa']);
    $energia_reativa = trim($_POST['energia-reativa']);

    if($_SESSION['master'] == 1) {
      Data::update_input($_SESSION['id'], $key, $data, $consumo_p, $consumo_fp, $demanda_medida, $demanda_medida, $energia_reativa, $energia_ativa, $ger_distribuida);
    } else {
      Data::update_input($_SESSION['associate-id'], $key, $data, $consumo_p, $consumo_fp, $demanda_medida, $demanda_medida, $energia_reativa, $energia_ativa, $ger_distribuida);
    }
    redirect('gerenciar.php');

  }
include('./views/gerenciar.view.php');


?>