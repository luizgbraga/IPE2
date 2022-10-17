<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Mensgens</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/welcome.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
            <?php include 'styles/acesslevel.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided'>

            <?php $home_nav = false; $mensagens_nav = true; $adicionar_subordinado_nav = false; $profile_nav = false; ?>
            <?php include 'nav.view.php'; ?>

            <div class='column content'>

                <h2>Suas mensagens</h2>

                <?php

                foreach($mensagens as $item) {
                $from = $item->from->id;
                $name = $item->from->nome;
                $sigla = $item->from->sigla;

                    echo "<p>Mensagem de $name ($sigla) - <a href=accept.php?id=$id&from=$from>Aceitar</a></p>";
                }

                ?>

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>