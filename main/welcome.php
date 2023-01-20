<?php

// inicialize a sessão

session_start();

require_once("../app/app.php");
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

require('../app/data/classes/charts.class.php');

$user_inputs = (array) Data::get_inputs($_SESSION['id']);
$sec_inputs = Data::get_secundary($_SESSION['id']);$en_inputs = Data::get_energetic($_SESSION['id']);


$modalidade = $en_inputs['modalidade'];

$datas = [];
$all_consumo_p = $all_consumo_fp = []; 
$all_demanda_medida_p = $all_demanda_medida_fp = [];
$all_energia_ativa = $all_energia_reativa = [];

$tarifa = 20;
$tarifa_p = 30;
$tarifa_fp = 10;
$tarifa_ultrapassagem = 40;

// USUÁRIO

foreach($user_inputs as $input) {
    $datas = [...$datas, $input->data];
    $all_consumo_p = [...$all_consumo_p, $input->dados->consumo_p];
    $all_consumo_fp = [...$all_consumo_fp, $input->dados->consumo_fp];
    $all_demanda_medida_p = [...$all_demanda_medida_p, $input->dados->demanda_medida_p];
    $all_demanda_medida_fp = [...$all_demanda_medida_fp, $input->dados->demanda_medida_fp];
    $all_energia_ativa = [...$all_energia_ativa, $input->dados->energia_ativa];
    $all_energia_reativa = [...$all_energia_reativa, $input->dados->energia_reativa];
}

if(count($datas) > 12) {
    $datas = array_slice($datas, -12, 12);
    $all_consumo_p = array_slice($all_consumo_p, -12, 12);
    $all_consumo_fp = array_slice($all_consumo_fp, -12, 12);
    $all_demanda_medida_p = array_slice($all_demanda_medida_p, -12, 12);
    $all_demanda_medida_fp = array_slice($all_demanda_medida_fp, -12, 12);
    $all_energia_ativa = array_slice($all_energia_ativa, -12, 12);
    $all_energia_reativa = array_slice($all_energia_reativa, -12, 12);
}

if($modalidade === 'verde') {
    $optimal_demandas = optimal_demandas_contratadas($all_demanda_medida_p, $tarifa, $tarifa_ultrapassagem, 0.05, 1);
    $optimal_demanda_s = $optimal_demandas[0];
    $optimal_demanda_u = $optimal_demandas[1];
} else if($modalidade === 'azul') {
    $demandas_pfp = [$all_demanda_medida_p, $all_demanda_medida_fp];
    $tarifas_pfp = [$tarifa_p, $tarifa_fp];
    $tarifas_ultrapassagem_pfp = [$tarifa_ultrapassagem, $tarifa_ultrapassagem];
    $optimal_demandas = optimal_demandas_contratadas_pfp($demandas_pfp, $tarifas_pfp, $tarifas_ultrapassagem_pfp, 0.05, 1);
    $optimal_demanda_seco_p = $optimal_demandas[0][0];
    $optimal_demanda_umido_p = $optimal_demandas[0][1];
    $optimal_demanda_seco_fp = $optimal_demandas[1][0];
    $optimal_demanda_umido_fp = $optimal_demandas[1][1];
} else {
    $optimal_demanda = 0;
    $optimal_demanda_s = 0;
    $optimal_demanda_u = 0;
    $optimal_demanda_seco_p = 0;
    $optimal_demanda_umido_p = 0;
    $optimal_demanda_seco_fp = 0;
    $optimal_demanda_umido_fp = 0;
}

$sum_consumo_p = array_sum($all_consumo_p);
$sum_consumo_fp = array_sum($all_consumo_fp);
$sum_consumo = $sum_consumo_p + $sum_consumo_fp;

$consumo_total = [];
for($i = 0; $i < count($all_consumo_p); $i++) {
    $consumo_total = [...$consumo_total, $all_consumo_p[$i] + $all_consumo_fp[$i]];
}

$demanda_total = [];
for($i = 0; $i < count($all_demanda_medida_p); $i++) {
    $demanda_total = [...$demanda_total, $all_demanda_medida_p[$i] + $all_demanda_medida_fp[$i]];
}

$consumo_medio_p = round(avg($all_consumo_p));
$consumo_medio_fp = round(avg($all_consumo_fp));
$consumo_medio = round(avg($consumo_total));

if($sec_inputs['efetivo'] === 0) {
    $consumo_medio_por_efetivo = 0;
} else {
    $consumo_medio_por_efetivo = round($consumo_medio/$sec_inputs['efetivo'], 1);
}

if($sec_inputs['metragem'] === 0) {
    $consumo_medio_por_metragem = 0;
} else {
    $consumo_medio_por_metragem = round($consumo_medio/$sec_inputs['metragem'], 1);
}

$energia_reativa_media = round(avg($all_energia_reativa));
$energia_ativa_media = round(avg($all_energia_ativa));

$profile_warnings = array_map('value', $sec_inputs);

if($energia_ativa_media == 0 || $energia_reativa_media == 0) {
    $fp_medio = 0;
} else {
    $fp_medio = round(cos(atan($energia_reativa_media/$energia_ativa_media)), 3);
}

$average_trepass = average_trepass_percentage($all_demanda_medida_p, $en_inputs['demanda_sp']);
$multa_total = multa_periodo($all_demanda_medida_p, $en_inputs['demanda_sp'], $tarifa_ultrapassagem, 0.05);

include('../views/welcome.view.php');

?>
