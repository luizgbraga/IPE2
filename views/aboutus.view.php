<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <meta charset='UTF-8'>
        <title>Sobre nós</title>

        <style>
            <?php include 'styles/default.style.css'; ?>
            <?php include 'styles/header.style.css'; ?>
            <?php include 'styles/nav.style.css'; ?>
            <?php include 'styles/aboutus.style.css'; ?>
            <?php include 'styles/modal.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>

    </head>

    <body>

        <?php include 'header.view.php'; ?>

        <div class='row-sided row'>

            <?php include 'nav.view.php'; ?>

            <div class='column'>

                <h2 class='main-title-page'>Sobre nós</h2>

                <div class='content-about'>

                    <p class='about-text'>Somos uma empresa onde buscamos o bem estar de nossos clientes. E como conseguimos esse bem estar? Um dos caminhos é a economia energética, e o nosso propósito é auxiliar e assessorar nossos contratantes por meio de consultorias especializadas em cima de dados e análises.</p>
                    <br>
                    <p class='about-text'>Prezamos pela transparência na formulação de relatórios de resultado de consumo energético, com o único viés de propor soluções para o atingimento das metas de sua organização, sem a parcialidade de promover produtos ou serviços parceiros, apenas o melhor caminho.</p>

                </div>


                <?php include 'modal.view.php'; ?>

            </div>

        </div>

    </body>

    <script>
        <?php include 'scripts/modal.js'; ?>
    </script>

</html>