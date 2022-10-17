<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <title>Home</title>
    <meta charset="utf-8">

    <style>
      <?php include 'styles/default.style.css'; ?>
      <?php include 'styles/header.style.css'; ?>

      <?php include 'styles/nav.style.css'; ?>
      <?php include 'styles/modal.style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

  </head>

  <body>

    <?php include 'header.view.php'; ?>

    <div class="row-sided row">

      <?php $home_nav = false; $mensagens_nav = false; $adicionar_subordinado_nav = false; $profile_nav = false; $subordinados_nav = true; ?>
      <?php include 'nav.view.php'; ?>

      <section class='row'>

        <form action="action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="subordinados">Selecione um subordinado</label>
                <select name="subordinados" id="subordinados">
                    <?php

                        foreach($subordinados as $subordinado) {
                        $nome = $$subordinado->name;
                        $sigla = $subordinado->sigla;

                            echo "<option value="$sigla">$sigla</option>";
                        }

                    ?>
                </select>
                <br><br>
            <input type="submit" value="Submit">
        </form>

      <?php include 'modal.view.php'; ?>

    </div>

  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>

  </script>

</html>