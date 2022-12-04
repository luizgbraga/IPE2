<?php

// Funções para facilitar ações da linguagem

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
    if(!empty($el) || $el === 0) {
        return $el;
    } else {
        return 'Não há';
    }
}

function translator($el) {
    if($el) {
        return 'Sim';
    } else {
        return 'Não';
    }
}

function detranslator($el) {
    if($el) {
        return 1;
    } else {
        return 0;
    }
}

function format_data($data) {
    $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    return $months[intval(substr($data, -2)) - 1] . '/' . substr($data, 0, 4);
}

// Funções para cálculos energéticos

function conta_mensal_demanda($demanda_medida, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol) {
    $conta_mensal = 0;
    $conta_mensal += max($demanda_medida, $demanda_contratada_periodo) * $tarifa;
    if($demanda_medida > (1 + $tol) * $demanda_contratada_periodo) {
        $conta_mensal += abs($demanda_medida - $demanda_contratada_periodo) * $tarifa_ultrapassagem;
    }
    return $conta_mensal;
}


function conta_mensal_demanda_pfp($demanda_medida_pfp, $demanda_contratada_periodo_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol) {
    $conta_mensal = 0;
    $conta_mensal += conta_mensal_demanda($demanda_medida_pfp[0], $demanda_contratada_periodo_pfp[0], $tarifa_pfp[0], $tarifa_ultrapassagem_pfp[0], $tol);
    $conta_mensal += conta_mensal_demanda($demanda_medida_pfp[1], $demanda_contratada_periodo_pfp[1], $tarifa_pfp[1], $tarifa_ultrapassagem_pfp[1], $tol);

    return $conta_mensal;
}

function conta_periodo_demanda($demandas_periodo, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol) {
    $conta_periodo = 0;
    foreach($demandas_periodo as $demanda_medida) {
        $conta_periodo += conta_mensal_demanda($demanda_medida, $demanda_contratada_periodo, $tarifa, $tarifa_ultrapassagem, $tol);
    }
    return $conta_periodo;
}

function multa_periodo($demandas_periodo, $demanda_contratada_periodo, $tarifa_ultrapassagem, $tol) {
    $multa_periodo = 0;
    foreach($demandas_periodo as $demanda_medida) {
        if($demanda_medida > (1 + $tol) * $demanda_contratada_periodo) {
            $multa_periodo += abs($demanda_medida - $demanda_contratada_periodo) * $tarifa_ultrapassagem;
        }
    }
    return $multa_periodo;
}


function conta_periodo_demanda_pfp($demandas_periodo_pfp, $demanda_contratada_periodo_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol) {
    $conta_periodo = 0;
    foreach($demandas_periodo_pfp as $demanda_medida_pfp) {
        $conta_periodo += conta_mensal_demanda_pfp($demanda_medida_pfp, $demanda_contratada_periodo_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol);
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

function conta_anual_demanda_pfp($demandas_ano_pfp, $demanda_contratada_seco_pfp, $demanda_contratada_umido_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol) {
    if(count($demandas_ano_pfp[0]) !== 12 || count($demandas_ano_pfp[1]) !== 12) {
        return 0;
    } 
    $conta_anual = 0;
    $conta_anual += conta_anual_demanda($demandas_ano_pfp[0], $demanda_contratada_seco_pfp[0], $demanda_contratada_umido_pfp[0], $tarifa_pfp[0], $tarifa_ultrapassagem_pfp[0], $tol);
    $conta_anual += conta_anual_demanda($demandas_ano_pfp[1], $demanda_contratada_seco_pfp[1], $demanda_contratada_umido_pfp[1], $tarifa_pfp[1], $tarifa_ultrapassagem_pfp[1], $tol);
    return $conta_anual;
}

function optimal_demandas_contratadas($demandas_ano, $tarifa, $tarifa_ultrapassagem, $tol, $inc) {
    if(count($demandas_ano) !== 12) {
        return [0, 0];
    } 
    $demandas_seco = array_slice($demandas_ano, 4, 11);
    $demandas_umido = array_merge(array_slice($demandas_ano, 0, 4), [$demandas_ano[11]]);
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

function optimal_demandas_contratadas_pfp($demandas_ano_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc) {
    if(count($demandas_ano_pfp[0]) !== 12 || count($demandas_ano_pfp[1]) !== 12) {
        return [[0, 0], [0, 0]];
    } 
    $demandas_p_seco = array_slice($demandas_ano_pfp[0], 4, 11);
    $demandas_fp_seco = array_slice($demandas_ano_pfp[1], 4, 11); 
    $demandas_p_umido = array_merge(array_slice($demandas_ano_pfp[0], 0, 4), [$demandas_ano_pfp[0][11]]);
    $demandas_fp_umido = array_merge(array_slice($demandas_ano_pfp[1], 0, 4), [$demandas_ano_pfp[1][11]]);
    $demandas_contratadas_p_seco_teste = range(min($demandas_p_seco), max($demandas_p_seco), $inc);
    $demandas_contratadas_fp_seco_teste = range(min($demandas_fp_seco), max($demandas_fp_seco), $inc);
    $demandas_contratadas_p_umido_teste = range(min($demandas_p_umido), max($demandas_p_umido), $inc);
    $demandas_contratadas_fp_umido_teste = range(min($demandas_fp_umido), max($demandas_fp_umido), $inc);
    $contas_p_seco = [];
    $contas_fp_seco = [];
    $contas_p_umido = [];
    $contas_fp_umido = [];

    foreach($demandas_contratadas_p_seco_teste as $demanda_contratada_p_seco_teste) {
        $contas_p_seco = [...$contas_p_seco, conta_periodo_demanda($demandas_p_seco, $demanda_contratada_p_seco_teste, $tarifa_pfp[0], $tarifa_ultrapassagem_pfp[0], $tol)];
    }
    foreach($demandas_contratadas_fp_seco_teste as $demanda_contratada_fp_seco_teste) {
        $contas_fp_seco = [...$contas_fp_seco, conta_periodo_demanda($demandas_fp_seco, $demanda_contratada_fp_seco_teste, $tarifa_pfp[1], $tarifa_ultrapassagem_pfp[1], $tol)];
    }
    foreach($demandas_contratadas_p_umido_teste as $demanda_contratada_p_umido_teste) {
        $contas_p_umido = [...$contas_p_umido, conta_periodo_demanda($demandas_p_umido, $demanda_contratada_p_umido_teste, $tarifa_pfp[0], $tarifa_ultrapassagem_pfp[0], $tol)];
    }
    foreach($demandas_contratadas_fp_umido_teste as $demanda_contratada_fp_umido_teste) {
        $contas_fp_umido = [...$contas_fp_umido, conta_periodo_demanda($demandas_fp_umido, $demanda_contratada_fp_umido_teste, $tarifa_pfp[1], $tarifa_ultrapassagem_pfp[1], $tol)];
    }

    $min_p_seco = min($contas_p_seco);
    $min_fp_seco = min($contas_fp_seco);
    $min_p_umido = min($contas_p_umido);
    $min_fp_umido = min($contas_fp_umido);
    $melhor_demanda_contratada_p_seco = $demandas_contratadas_p_seco_teste[array_search($min_p_seco, $contas_p_seco)];
    $melhor_demanda_contratada_fp_seco = $demandas_contratadas_fp_seco_teste[array_search($min_fp_seco, $contas_fp_seco)];
    $melhor_demanda_contratada_p_umido = $demandas_contratadas_p_umido_teste[array_search($min_p_umido, $contas_p_umido)];
    $melhor_demanda_contratada_fp_umido = $demandas_contratadas_fp_umido_teste[array_search($min_fp_umido, $contas_fp_umido)];
    return [[$melhor_demanda_contratada_p_seco, $melhor_demanda_contratada_p_umido], [$melhor_demanda_contratada_fp_seco, $melhor_demanda_contratada_fp_umido]];
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

function economia_pfp($demandas_ano_pfp, $demanda_contratada_seco_pfp, $demanda_contratada_umido_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc) {
    $melhor_demanda_contratada_p_seco = optimal_demandas_contratadas_pfp($demandas_ano_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc)[0][0];
    $melhor_demanda_contratada_fp_seco = optimal_demandas_contratadas_pfp($demandas_ano_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc)[1][0];
    $melhor_demanda_contratada_p_umido = optimal_demandas_contratadas_pfp($demandas_ano_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc)[0][1];
    $melhor_demanda_contratada_fp_umido = optimal_demandas_contratadas_pfp($demandas_ano_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol, $inc)[1][1];
    $melhor_demanda_contratada_seco_pfp = [$melhor_demanda_contratada_p_seco, $melhor_demanda_contratada_fp_seco];
    $melhor_demanda_contratada_umido_pfp = [$melhor_demanda_contratada_p_umido, $melhor_demanda_contratada_fp_umido];
    $conta_atual = conta_anual_demanda_pfp($demandas_ano_pfp, $demanda_contratada_seco_pfp, $demanda_contratada_umido_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol);
    $conta_melhor = conta_anual_demanda_pfp($demandas_ano_pfp, $melhor_demanda_contratada_seco_pfp, $melhor_demanda_contratada_umido_pfp, $tarifa_pfp, $tarifa_ultrapassagem_pfp, $tol);
    $economia = abs($conta_melhor - $conta_atual);
    $economia_percentual = round(100 * $economia/$conta_atual, 2);
    return [$economia, $economia_percentual];
}

function avg($arr) {
    if(count($arr) === 0) {
        return 0;
    }
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
        if($demanda > $demanda_contratada) {
            $p = abs($demanda_contratada - $demanda)/$demanda_contratada;
            $percentages = [...$percentages, $p];
        }
    }
    return round(100 * avg($percentages), 1);
}

?>