<?php

// inicialize a sessão
session_start();

require_once('app/app.php');
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

require('app/data/classes/charts.class.php');
 
$subordinados = Data::get_subordinados($_SESSION['id']);
$subordinado_inputs = [];

$datas_sub = [];
$all_consumo_sub = $all_demanda_medida_sub = $all_energia_ativa_sub = $all_energia_reativa_sub = [];

// SUBORDINADOS

if(is_get()) {

    $subordinado_id = $_GET['subordinados'];
    $subordinado_inputs = (array) Data::get_inputs($subordinado_id);

    foreach($subordinado_inputs as $input) {
        $datas_sub = [...$datas_sub, $input->data];
        $all_consumo_p_sub = [...$all_consumo_sub, $input->dados->consumo_p];
        $all_consumo_p_sub = [...$all_consumo_sub, $input->dados->consumo_p];
        $all_demanda_medida_p_sub = [...$all_demanda_medida_sub, $input->dados->demanda_medida_p];
        $all_demanda_medida_fp_sub = [...$all_demanda_medida_sub, $input->dados->demanda_medida_p];
        $all_energia_ativa_sub = [...$all_energia_ativa_sub, $input->dados->energia_ativa];
        $all_energia_reativa_sub = [...$all_energia_reativa_sub, $input->dados->energia_reativa];
    }
}


if(count($datas_sub) > 12) {
    $datas_sub = array_slice($datas, -12, 12);
    $all_consumo_p_sub = array_slice($all_consumo_p, -12, 12);
    $all_consumo_fp_sub = array_slice($all_consumo_fp, -12, 12);
    $all_demanda_medida_p_sub = array_slice($all_demanda_medida_p, -12, 12);
    $all_demanda_medida_fp_sub = array_slice($all_demanda_medida_fp, -12, 12);
    $all_energia_ativa_sub = array_slice($all_energia_ativa, -12, 12);
    $all_energia_reativa_sub = array_slice($all_energia_reativa, -12, 12);
}

include('./views/subordinados.view.php');

?>
