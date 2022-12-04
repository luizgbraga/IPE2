<?php

require_once('app/app.php');

$en = Data::get_energetic($_SESSION['id']);
$modalidade = $en['modalidade'];
 
if(is_post()) {

    $data = $consumo_p = $consumo_fp = $demanda_medida_p = $demanda_medida_fp = $energia_reativa = $energia_ativa =  '';
    $data_err = $consumo_p_err = $consumo_fp_err = $demanda_medida_p_err = $demanda_medida_fp_err = $energia_reativa_err = $energia_ativa_err =  '';

    if(empty(trim($_POST['data']))) {
        $data_err = 'Insira a data';     
    } else {
        $data = trim($_POST['data']);
    }
    
    if(empty(trim($_POST['consumo-p']))) {
        $consumo_p_err = 'Insira o consumo';     
    } else {
        $consumo_p = trim($_POST['consumo-p']);
    }

    if(empty(trim($_POST['consumo-fp']))) {
        $consumo_fp_err = 'Insira o consumo';     
    } else {
        $consumo_fp = trim($_POST['consumo-fp']);
    }

    if(empty(trim($_POST['demanda-medida-p']))) {
        $demanda_medida_p_err = 'Insira a demanda';     
    } else {
        $demanda_medida_p = trim($_POST['demanda-medida-p']);
    }


    if($modalidade === 'azul') {
        if(empty(trim($_POST['demanda-medida-fp']))) {
            $demanda_medida_fp_err = 'Insira a demanda';     
        } else {
            $demanda_medida_fp = trim($_POST['demanda-medida-fp']);
        }
    }



    if(empty(trim($_POST['energia-reativa']))) {
        $energia_reativa_err = 'Insira uma energia reativa';     
    } else {
        $energia_reativa = trim($_POST['energia-reativa']);
    }

    if(empty(trim($_POST['energia-ativa']))) {
        $energia_ativa_err = 'Insira uma energia ativa';     
    } else {
        $energia_ativa = trim($_POST['energia-ativa']);
    }

    if($modalidade === 'verde') {
        if(empty($data_err) && empty($consumo_p_err) && empty($demanda_medida_p_err) && empty($energia_reativa_err) && empty($energia_ativa_err)) {
            Data::add_input($_SESSION['id'], $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_p, $energia_reativa, $energia_ativa, 0);
        }
    } else {
        if(empty($data_err) && empty($consumo_p_err) && empty($demanda_medida_p_err) && empty($demanda_medida_fp_err) && empty($energia_reativa_err) && empty($energia_ativa_err)) {
            Data::add_input($_SESSION['id'], $data, $consumo_p, $consumo_fp, $demanda_medida_p, $demanda_medida_fp, $energia_reativa, $energia_ativa, 0);
            echo $data;
        }
    }

    redirect('welcome.php');
}

include('./views/inputs.view.php');

?>

