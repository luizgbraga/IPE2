<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Mensagens</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
            <?php include 'styles/mensagens.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided row'>

            <?php $mensagens_nav = true; ?>
            <?php include 'nav.view.php'; ?>

            <div class='column'>

                <h2 class='main-title-page'>Suas mensagens</h2>

                <?php 
                    $counter = 0;
                    foreach($mensagens as $mensagem) {
                    $counter += 1;
                    }
                ?>

                <div <?php if($counter === 0) {
                    echo "class='centered-content-box center-content'";
                    } ?>>

                    <?php if($counter === 0) { ?>
                        <p class='empty-mensagens-text'>Não há mensagens</p>
                    <?php } else { ?>

                    <div class='content'>

                        <?php

                        foreach($mensagens as $item) {
                            $from = $item->from->id;
                            $name = $item->from->nome;
                            $sigla = $item->from->sigla;

                                echo "<p class='mensagem-text'>Solicitação de $name ($sigla) <a class='accept-message' href=mensagens.php?id=$id&from=$from>Aceitar</a></p>";
                        }

                        ?>

                        <?php } ?>

                    </div>

                </div>

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>