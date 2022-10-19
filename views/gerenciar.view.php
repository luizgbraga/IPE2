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
                            <th class='first-title-table'>Data</th>
                            <th>Consumo</th>
                            <th>Demanda medida</th>
                            <th>Energia Ativa</th>
                            <th class='last-title-table'>Energia Reativa</th>
                        </tr>
                            <?php

                                if(isset($_GET['key'])) {

                                    foreach($user_inputs as $key=>$input) {

                                        if($key === $_GET['key']) {

                                            $data = $input->data;
                                            $consumo = $input->dados->consumo;
                                            $demanda_medida = $input->dados->demanda_medida;
                                            $energia_ativa = $input->dados->energia_ativa;
                                            $energia_reativa = $input->dados->energia_reativa;
                                            echo "
                                            <form>
                                                <tr>
                                                    <td>$data</td>
                                                    <td><input type='number' name='consumo' value=$consumo class='table-input'></td>
                                                    <td><input type='number' name='demanda-medida' value=$demanda_medida class='table-input'></td>
                                                    <td><input type='number' name='energia-ativa' value=$energia_ativa class='table-input'></td>
                                                    <td><input type='number' name='energia-reativa' value=$energia_reativa class='table-input'></td>
                                                </tr>
                                            </form>
                                        ";

                                        } else {

                                            $data = $input->data;
                                            $consumo = $input->dados->consumo;
                                            $demanda_medida = $input->dados->demanda_medida;
                                            $energia_ativa = $input->dados->energia_ativa;
                                            $energia_reativa = $input->dados->energia_reativa;
                                            echo "
                                                <tr>
                                                    <td><a href='gerenciar.php?row=$key'>$data</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$consumo</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$demanda_medida</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_ativa</a></td>
                                                    <td><a href='gerenciar.php?row=$key'>$energia_reativa</a></td>
                                                </tr>
                                            ";

                                        }
                                    }

                                } else {

                                    foreach($user_inputs as $key=>$input) {
                                        $data = $input->data;
                                        $consumo = $input->dados->consumo;
                                        $demanda_medida = $input->dados->demanda_medida;
                                        $energia_ativa = $input->dados->energia_ativa;
                                        $energia_reativa = $input->dados->energia_reativa;
                                        echo "
                                            <tr>
                                                <td><a href='gerenciar.php?row=$key'>$data</a></td>
                                                <td><a href='gerenciar.php?row=$key'>$consumo</a></td>
                                                <td><a href='gerenciar.php?row=$key'>$demanda_medida</a></td>
                                                <td><a href='gerenciar.php?row=$key'>$energia_ativa</a></td>
                                                <td><a href='gerenciar.php?row=$key'>$energia_reativa</a></td>
                                            </tr>
                                        ";
                                    }
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

    <script>

        const row = document.getElementById('open-modal');
        row.addEventListener("click", () => {
        window.location.href = `#`;

    </script>

</html>