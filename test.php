<?php

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

/*
echo conta_mensal_demanda(1200, 1000, 30, 15, 0.01);
echo '</br>';
echo conta_mensal_demanda_pfp([1000, 200], [800, 50], [40, 10], [30, 15], 0.01);
echo '</br>';
echo conta_periodo_demanda([1000, 700, 1200, 800], 1000, 30, 20, 0.05);
echo '</br>';
echo conta_periodo_demanda_pfp([[1000, 200], [800, 300], [1200, 400]], [800, 200], [30, 15], [40, 10], 0.05);
echo '</br>';
echo conta_anual_demanda([1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], 1000, 1400, 30, 10, 0.05);
echo '</br>';
echo conta_anual_demanda_pfp([[1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], [600, 200, 500, 900, 800, 400, 100, 300, 130, 400, 900, 1000]], [1000, 300], [900, 200], [40, 10], [10, 5], 0.05);
echo '</br>';
echo optimal_demandas_contratadas([1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], 30, 10, 0.05, 1)[0];
echo '</br>';
echo optimal_demandas_contratadas([1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], 30, 10, 0.05, 1)[1];
echo '</br>';
print_r(optimal_demandas_contratadas_pfp([[1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], [600, 200, 500, 900, 800, 400, 100, 300, 130, 400, 900, 1000]], [40, 10], [10, 5], 0.05, 1));
echo '</br>';
print_r(economia([1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], 1000, 1400, 30, 10, 0.05, 1));
echo '</br>';
print_r(economia([1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], 1000, 1400, 30, 10, 0.05, 1));
echo '</br>';
print_r(economia_pfp([[1000, 1200, 1500, 900, 800, 1000, 1100, 3000, 1300, 400, 900, 1000], [600, 200, 500, 900, 800, 400, 100, 300, 130, 400, 900, 1000]], [1000, 300], [900, 200], [40, 10], [10, 5], 0.05, 1));
echo '</br>';
*/