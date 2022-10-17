<?php

// inicialize a sessão

session_start();

require_once("app/app.php");
 
// verifique se está logado; senão, redirecione para o login


require('app/data/classes/charts.class.php');

$user_inputs = (array) Data::get_inputs($_SESSION['id']);
$subordinados = Data::get_subordinados($_SESSION['id']);

$datas = [];
$all_consumo = $all_demanda_medida = $all_energia_ativa = $all_energia_reativa = [];

// USUÁRIO

foreach($user_inputs as $input) {
    $datas = [...$datas, $input->data];
    $all_consumo = [...$all_consumo, $input->dados->consumo];
    $all_demanda_medida = [...$all_demanda_medida, $input->dados->demanda_medida];
    $all_energia_ativa = [...$all_energia_ativa, $input->dados->energia_ativa];
    $all_energia_reativa = [...$all_energia_reativa, $input->dados->energia_reativa];
}


include('./views/welcome.view.php');

?>
