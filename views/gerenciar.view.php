<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Gerenciar Inputs</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
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

                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>