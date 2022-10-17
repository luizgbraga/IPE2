<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <title>Home</title>
    <meta charset="utf-8">

    <style>
      <?php include 'styles/default.style.css'; ?>
      <?php include 'styles/header.style.css'; ?>
      <?php include 'styles/welcome.style.css'; ?>
      <?php include 'styles/nav.style.css'; ?>
      <?php include 'styles/modal.style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

  </head>

  <body>

    <?php include 'header.view.php'; ?>

    <div class="row-sided row">

      <?php $home_nav = true; $mensagens_nav = false; $adicionar_subordinado_nav = false; $profile_nav = false; ?>
      <?php include 'nav.view.php'; ?>

      <section class='row'>

        <div class="chart-test">
          <h2 class='title-chart'>Consumo</h2>
          <canvas id="chart-consumo"></canvas>
        </div>

        <div class="chart-test">
          <h2 class='title-chart'>Demanda medida</h2>
          <canvas id="chart-demanda-medida"></canvas>
        </div>
      </section>

      <?php include 'modal.view.php'; ?>

    </div>

  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const labels = <?php echo json_encode($datas) ?>;
    const consumoJSON = <?php echo json_encode($all_consumo) ?>;
    const demandaJSON = <?php echo json_encode($all_demanda_medida) ?>;
    const allDataJSON = <?php echo json_encode($subordinados_inputs) ?>;

    <?php include 'scripts/data.js'; ?>
    <?php include 'scripts/modal.js'; ?>
  </script>

</html>