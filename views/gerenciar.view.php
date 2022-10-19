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

                <div class='content'>

                    <table id="customers">
                        <tr>
                            <th>Data</th>
                            <th>Consumo</th>
                            <th>Demanda medida</th>
                            <th>Energia Ativa</th>
                            <th>Energia Reativa</th>
                        </tr>
                            <?php

                                foreach($user_inputs as $input) {
                                    $data = $input->data;
                                    $consumo = $input->dados->consumo;
                                    $demanda_medida = $input->dados->demanda_medida;
                                    $energia_ativa = $input->dados->energia_ativa;
                                    $energia_reativa = $input->dados->energia_reativa;
                                    echo "
                                        <tr>
                                            <td>$data</td>
                                            <td>$consumo</td>
                                            <td>$demanda_medida</td>
                                            <td>$energia_ativa</td>
                                            <td>$energia_reativa</td>
                                        </tr>
                                    ";
                                }

                            ?>
                    </table>
                
                </div>

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>