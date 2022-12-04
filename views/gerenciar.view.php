<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Gerenciar Inputs</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/gerenciar.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided row'>

            <?php $gerenciar_nav = true; ?>
            <?php include 'nav.view.php'; ?>

            <div class='column'>

                <h2 class='main-title-page'>Gerenciar Inputs</h2>

                <div class='content content-spread column'>
                
                    <div class='table-wrapper'>

                        <table id="customers">
                            <tr>
                                <th class='first-title-table'>Data</th>
                                <th>Consumo (ponta)</th>
                                <th>Consumo (fora)</th>
                                <?php if($modalidade == 'verde') { ?>
                                <th>Demanda medida</th>
                                <?php } else { ?>
                                    <th>Demanda (ponta)</th>
                                    <th>Demanda (fora)</th>
                                <?php } ?>
                                <th>Energia Ativa</th>
                                <th class='last-title-table'>Energia Reativa</th>
                            </tr>
                                <?php

                                    if(isset($_GET['row'])) {

                                        foreach($user_inputs as $key=>$input) {

                                            if($key == $_GET['row']) {

                                                $data = $input->data;
                                                $consumo_p = $input->dados->consumo_p;
                                                $consumo_fp = $input->dados->consumo_fp;
                                                if($modalidade === 'verde') {
                                                    $demanda_medida = $input->dados->demanda_medida_p;
                                                } else {
                                                    $demanda_medida_p = $input->dados->demanda_medida_p;
                                                    $demanda_medida_fp = $input->dados->demanda_medida_fp;
                                                }
                                                $energia_ativa = $input->dados->energia_ativa;
                                                $energia_reativa = $input->dados->energia_reativa;
                                                $action = htmlspecialchars($_SERVER["PHP_SELF"]);
                                                if($modalidade === 'verde') {
                                                    echo "
                                                    <form id='row-form' action=$action method='post'>
                                                        <input type='hidden' name='key' value=$key />
                                                        <tr>
                                                            
                                                            <td><input type='month' name='data' value=$data class='table-input'></td>
                                                            <td><input type='number' name='consumo-p' value=$consumo_p class='table-input'></td>
                                                            <td><input type='number' name='consumo-fp' value=$consumo_fp class='table-input'></td>
                                                            <td><input type='number' name='demanda-medida' value=$demanda_medida class='table-input'></td>
                                                            <td><input type='number' name='energia-ativa' value=$energia_ativa class='table-input'></td>
                                                            <td><input type='number' name='energia-reativa' value=$energia_reativa class='table-input'></td>
                                                        </tr>
                                                    </form>";
                                                } else {
                                                echo "
                                                <form id='row-form' action=$action method='post'>
                                                    <input type='hidden' name='key' value=$key />
                                                    <tr>
                                                        
                                                        <td><input type='month' name='data' value=$data class='table-input'></td>
                                                        <td><input type='number' name='consumo-p' value=$consumo_p class='table-input'></td>
                                                        <td><input type='number' name='consumo-fp' value=$consumo_fp class='table-input'></td>
                                                        <td><input type='number' name='demanda-medida' value=$demanda_medida_p class='table-input'></td>
                                                        <td><input type='number' name='demanda-medida' value=$demanda_medida_fp class='table-input'></td>
                                                        <td><input type='number' name='energia-ativa' value=$energia_ativa class='table-input'></td>
                                                        <td><input type='number' name='energia-reativa' value=$energia_reativa class='table-input'></td>
                                                    </tr>
                                                </form>
                                            ";
                                            }

                                            } else {

                                                $data = format_data($input->data);
                                                $consumo_p = $input->dados->consumo_p;
                                                $consumo_fp = $input->dados->consumo_fp;
                                                if($modalidade === 'verde') {
                                                    $demanda_medida = $input->dados->demanda_medida_p;
                                                } else {
                                                    $demanda_medida_p = $input->dados->demanda_medida_p;
                                                    $demanda_medida_fp = $input->dados->demanda_medida_fp;
                                                }
                                                $energia_ativa = $input->dados->energia_ativa;
                                                $energia_reativa = $input->dados->energia_reativa;
                                                if($modalidade === 'verde') {
                                                    echo "
                                                    <tr>
                                                        <td>$data</td>
                                                        <td>$consumo_p</td>
                                                        <td>$consumo_fp</td>
                                                        <td>$demanda_medida</td>
                                                        <td>$energia_ativa</td>
                                                        <td>$energia_reativa</td>
                                                    </tr>
                                                ";
                                                } else {
                                                    echo "
                                                    <tr>
                                                        <td>$data</td>
                                                        <td>$consumo_p</td>
                                                        <td>$consumo_fp</td>
                                                        <td>$demanda_medida_p</td>
                                                        <td>$demanda_medida_fp</td>
                                                        <td>$energia_ativa</td>
                                                        <td>$energia_reativa</td>
                                                    </tr>
                                                ";
                                                }

                                            }
                                        }

                                    } else {

                                        foreach($user_inputs as $key=>$input) {
                                            $data = format_data($input->data);
                                            $consumo_p = $input->dados->consumo_p;
                                            $consumo_fp = $input->dados->consumo_fp;
                                            if($modalidade === 'verde') {
                                                $demanda_medida = $input->dados->demanda_medida_p;
                                            } else {
                                                $demanda_medida_p = $input->dados->demanda_medida_p;
                                                $demanda_medida_fp = $input->dados->demanda_medida_fp;
                                            }
                                            $energia_ativa = $input->dados->energia_ativa;
                                            $energia_reativa = $input->dados->energia_reativa;
                                            if($modalidade === 'verde') {
                                                echo "
                                                <tr>
                                                    <td><a href='gerenciar.php?row=$key'>$data</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$consumo_p</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$consumo_fp</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$demanda_medida</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_ativa</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_reativa</a></td>
                                                </tr>
                                            ";
                                            } else {
                                                echo "
                                                <tr>
                                                    <td><a href='gerenciar.php?row=$key'>$data</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$consumo_p</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$consumo_fp</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$demanda_medida_p</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$demanda_medida_fp</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_ativa</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_reativa</a></td>
                                                </tr>
                                            ";
                                            }
                                        }
                                    }
                                        

                                ?>

                        </table>

                    </div>

                    <div class='row'>
                      <button type="submit" class='btn-salvar' form="row-form">Salvar alterações</button>
                        <a id="edit" href="gerenciar.php">
                          <p class='btn-cancel center-content'>Cancelar</p>
                        </a>
                    </div>
                
                </div>

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>


</html>