<!DOCTYPE html>

<html lang='pt-br'>

<head>

    <meta charset='UTF-8'>
    <title>Adicionar subordinados</title>

    <style>
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

    <?php $home_nav = false; $mensagens_nav = false; $adicionar_subordinado_nav = true; $profile_nav = false; ?>
        <?php include 'nav.view.php'; ?>

        <div class='column content'>

            <h2 class='title'>Procure uma OM</h2>

            <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='get'>
                <div class='row'>
                    <div class='form-group'>
                        <input type='text' name='search' class='search-input' placeholder='Procure uma OM' value='<?php echo $search; ?>'>
                    </div>    
                    <img class='search-icon' src='assets/search.png' alt='search-icon' width='22' height='22' />
                    <div class='form-group'>
                        <input type='submit' class='search-btn' value='Pesquisar'>
                    </div>
                </div>
            </form>

            <div class='box-users'>

                <?php

                foreach($users as $item) {
                $nome = $item->nome;
                $sigla = $item->sigla;
                $id = $item->id;
                $from = $_SESSION['id'];

                if($id !== $from) {
                    echo "<div class='box-om'>
                                <div class='column'>
                                    <p>$nome</p> 
                                    <p>$sigla</p>
                                </div> 
                                <a class='send-btn' href=send_message.php?id=$id&from=$from>Enviar solicitação</a>
                            </div>";
                }
                }

                ?>

        </div>

  <?php include 'modal.view.php'; ?>

  </div>

</div>

</body>

<script>
    <?php include 'scripts/modal.js'; ?>
  </script>

</html>