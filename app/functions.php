<?php

function redirect($url) {
    header("Location: $url");
    die();
}

function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function is_user_authenticated() {
    return isset($_SESSION['loggedin']);
}

function ensure_user_is_authenticated() {
    if (!is_user_authenticated()) {
      redirect('login.php');
    }
}

function value($el) {
    if(empty($el)) {
        return 'Não há';
    } else {
        return $el;
    }
}

function b_to_a($demanda) {
    if($demanda > 30) {
        return true;
    } else {
        return false;
    }
}

function conta_mensal_demanda($demanda_medida, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol) {
    $conta_mensal = 0;
    $conta_mensal += max($demanda_medida, $demanda_contratada_periodo) * $tarifa;
    if($demanda_medida > (1 + $tol) * $demanda_contratada_periodo) {
        $conta_mensal += abs($demanda_medida - $demanda_contratada_periodo) * $tarifa_ultrapassagem;
    }
    return $conta_mensal;
}

function conta_periodo_demanda($demandas_periodo, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol) {
    $conta_periodo = 0;
    foreach($demandas_periodo as $demanda_medida) {
        $conta_periodo += conta_mensal_demanda($demanda_medida, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol);
    }
    return $conta_periodo;
}

function conta_anual_demanda($demandas_ano, $demanda_contratada_seco, $demanda_contratada_umido, $tarifa, $tarifa_ultrapassagem, $tol) {
    if(count($demandas_ano) !== 12) {
        return 0;
    } 
    $demandas_seco = array_slice($demandas_ano, 4, 11);
    $demandas_umido = array_merge(array_slice($demandas_ano, 0, 4), [$demandas_ano[11]]);
    $conta_seco = conta_periodo_demanda($demandas_seco, $demanda_contratada_seco, $tarifa, $tarifa_ultrapassagem, $tol);
    $conta_umido = conta_periodo_demanda($demandas_umido, $demanda_contratada_umido, $tarifa, $tarifa_ultrapassagem, $tol);
    $conta_anual = $conta_seco + $conta_umido;
    return $conta_anual;
}

function optimal_demandas_contratadas($demandas, $tarifa, $tarifa_ultrapassagem, $tol, $inc) {
    $demandas_seco = array_slice($demandas, 4, 11);
    $demandas_umido = array_merge(array_slice($demandas, 0, 4), [$demandas[11]]);
    $demandas_contratadas_seco_teste = range(min($demandas_seco), max($demandas_seco), $inc);
    $demandas_contratadas_umido_teste = range(min($demandas_umido), max($demandas_umido), $inc);
    $contas_seco = [];
    $contas_umido = [];

    foreach($demandas_contratadas_seco_teste as $demanda_contratada_seco_teste) {
        $contas_seco = [...$contas_seco, conta_periodo_demanda($demandas_seco, $demanda_contratada_seco_teste, $tarifa, $tarifa_ultrapassagem, $tol)];
    }
    foreach($demandas_contratadas_umido_teste as $demanda_contratada_umido_teste) {
        $contas_umido = [...$contas_umido, conta_periodo_demanda($demandas_umido, $demanda_contratada_umido_teste, $tarifa, $tarifa_ultrapassagem, $tol)];
    }
    $min_seco = min($contas_seco);
    $min_umido = min($contas_umido);
    $melhor_demanda_contratada_seco = $demandas_contratadas_seco_teste[array_search($min_seco, $contas_seco)];
    $melhor_demanda_contratada_umido = $demandas_contratadas_umido_teste[array_search($min_umido, $contas_umido)];
    return [$melhor_demanda_contratada_seco, $melhor_demanda_contratada_umido];
}

function economia($demandas_ano, $demanda_contratada_seco, $demanda_contratada_umido, $tarifa, $tarifa_ultrapassagem, $tol, $inc) {
    $melhor_demanda_contratada_seco = optimal_demandas_contratadas($demandas_ano, $tarifa, $tarifa_ultrapassagem, $tol, $inc)[0];
    $melhor_demanda_contratada_umido = optimal_demandas_contratadas($demandas_ano, $tarifa, $tarifa_ultrapassagem, $tol, $inc)[1];
    $conta_atual = conta_anual_demanda($demandas_ano, $demanda_contratada_seco, $demanda_contratada_umido, $tarifa, $tarifa_ultrapassagem, $tol);
    $conta_melhor = conta_anual_demanda($demandas_ano, $melhor_demanda_contratada_seco, $melhor_demanda_contratada_umido, $tarifa, $tarifa_ultrapassagem, $tol);
    $economia = abs($conta_melhor - $conta_atual);
    $economia_percentual = round(100 * $economia/$conta_atual, 2);
    return [$economia, $economia_percentual];
}

function multa($demanda_medida, $demanda_contratada, $tol) {
    $dist = abs($demanda_contratada - $demanda_medida); 
    if($dist < (1 + $tol) * $demanda_contratada && $dist > (1 - $tol) * $demanda_contratada) {
        return 0;
    } else {
        return $dist;
    }
}

function multa_anual($demandas, $demanda_contratada, $tol) {
    $multa = 0;
    foreach($demandas as $demanda) {
        $multa += multa($demanda, $demanda_contratada, $tol);
    }

    return $multa;
}

function optimal_demanda($demandas, $tol, $inc) {
    $test_values = range(min($demandas), max($demandas), $inc);
    $multas = [];
    foreach($test_values as $test_value) {
        $multas = [...$multas, multa_anual($demandas, $test_value, $tol)];
    }

    $min_multa = min($multas);
    return $test_values[array_search($min_multa, $multas)];
}

function avg($arr) {
    $avg = 0;
    foreach($arr as $el) {
        $avg += $el;
    }
    $avg /= count($arr);
    return $avg;
}

function average_trepass_percentage($demandas, $demanda_contratada) {
    $percentages = [];
    foreach($demandas as $demanda) {
        $p = abs($demanda_contratada - $demanda)/$demanda_contratada;
        $percentages = [...$percentages, $p];
    }
    return round(100 * avg($percentages), 1);
}

?>