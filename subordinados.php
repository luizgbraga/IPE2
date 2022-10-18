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
        $all_consumo_sub = [...$all_consumo_sub, $input->dados->consumo];
        $all_demanda_medida_sub = [...$all_demanda_medida_sub, $input->dados->demanda_medida];
        $all_energia_ativa_sub = [...$all_energia_ativa_sub, $input->dados->energia_ativa];
        $all_energia_reativa_sub = [...$all_energia_reativa_sub, $input->dados->energia_reativa];
    }
}

include('./views/subordinados.view.php');

?>
