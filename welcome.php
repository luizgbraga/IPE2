<?php

// inicialize a sessão

session_start();

require_once("app/app.php");
 
// verifique se está logado; senão, redirecione para o login


require('app/data/classes/charts.class.php');

$user_inputs = (array) Data::get_inputs($_SESSION['id']);
$sec_inputs = Data::get_secundary($_SESSION['id']);
$efetivo = $sec_inputs[0];

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

$demanda_contratada = $sec_inputs[2];
if(!empty($all_demanda_medida)) {
    $optimal_demanda = optimal_demanda($all_demanda_medida, 0.1, 0.1);
} else {
    $optimal_demanda = 0;
}

$profile_warnings = array_map('value', $sec_inputs);

$consumo_medio_por_efetivo = round(avg($all_consumo)/$efetivo, 1);
$energia_reativa_media = round(avg($all_energia_reativa));
$energia_ativa_media = round(avg($all_energia_ativa));

$percentual_ultrapassagem = average_trepass_percentage($all_demanda_medida, $demanda_contratada);

$fp_medio = round(cos(atan($energia_reativa_media/$energia_ativa_media)), 3);
$last_fp = round(atan($all_energia_reativa[array_key_last($all_energia_reativa)]/$all_energia_ativa[array_key_last($all_energia_ativa)]), 3);

include('./views/welcome.view.php');

?>
