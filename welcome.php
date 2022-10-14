<?php

// inicialize a sessão

session_start();

require_once("app/app.php");
 
// verifique se está logado; senão, redirecione para o login
// ensure_user_is_authenticated();

class Consumo {
    public $data;
    public $consumo;
}

$user_inputs = (array) Data::get_inputs($_SESSION['id']);
$subordinados = Data::get_subordinados($_SESSION['id']);

$subordinados_inputs = [];

$datas = [];
$consumo = [];


foreach($subordinados as $subordinado) {
    $inputs = (array) Data::get_inputs($subordinado->id);
    $subordinados_inputs = [...$subordinados_inputs, $inputs];
}

foreach($user_inputs as $input) {
    $datas = [...$datas, $input->data];
    $consumo = [...$consumo, $input->dados->consumo];
}

$subordinados_consumo = [];
foreach($subordinados_inputs as $input) {
    $consumo_sub = new Consumo();
    $consumo_sub->data = $input->data;
    $consumo_sub->consumo = $input->dados->consumo;
    $subordinados_consumo = [...$subordinados_consumo, $consumo_sub];
}

include('./views/welcome.view.php');

?>
