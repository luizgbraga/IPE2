<?php

// inicialize a sessão

session_start();

require_once("app/app.php");
 
// verifique se está logado; senão, redirecione para o login
ensure_user_is_authenticated();

class Consumo {
    public $data;
    public $consumo;
}

$user_inputs = (array) Data::get_inputs($_SESSION['id']);
$subordinados = Data::get_subordinados($_SESSION['id']);

$subordinados_inputs = [];

$datas = [];
$all_consumo = $all_demanda_medida = $all_energia_ativa = $all_energia_reativa = [];

foreach($user_inputs as $input) {
    $datas = [...$datas, $input->data];
    $all_consumo = [...$all_consumo, $input->dados->consumo];
    $all_demanda_medida = [...$all_demanda_medida, $input->dados->demanda_medida];
    $all_energia_ativa = [...$all_energia_ativa, $input->dados->energia_ativa];
    $all_energia_reativa = [...$all_energia_reativa, $input->dados->energia_reativa];
}

foreach($subordinados as $subordinado) {
    $inputs = (array) Data::get_inputs($subordinado->id);
    $subordinados_inputs = [...$subordinados_inputs, $inputs];
}

$subordinados_consumo = [];
foreach($subordinados_inputs as $input) {
    $consumo_sub = new Consumo();
    $consumo_sub->data = $input[0]->data;
    $consumo_sub->consumo = $input[0]->dados->consumo;
    $subordinados_consumo = [...$subordinados_consumo, $consumo_sub];
}

include('./views/welcome.view.php');

?>
