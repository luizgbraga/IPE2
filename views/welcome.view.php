<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <style>
          <?php include 'styles/welcome.style.css'; ?>
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

        <header>
            <div class='logo-img'></div>
            <div class='name'>
              <h2>Bem vindo, <?php echo $_SESSION["nome"]; ?></h2>
            </div>
            <div class="actions-header">
                <a href='mensagens.php'><img src='assets/bell.png' width="26" height="26"></a>
                <a href=''><img src='assets/question.png' width="26" height="26"></a>
                <a href='logout.php'><img src='assets/logout.png' width="26" height="26"></a>
                <a href='profile.php'><img src='assets/colored-user.png' width="36" height="36"></a>
            </div>
        </header>

        <div class="row-sided">
            <nav>
                <div class="actions-nav">

                  <div class='dir-row'>
                    <img src='assets/add-input.png' width="20" height="20">
                    <a href='inputs.php'><p class="action-nav">Novo Input</p></a>
                  </div>

                  <div class='dir-row'>
                    <img src='assets/chat.png' width="20" height="20">
                    <a href='mensagens.php'><p class="action-nav">Mensagens</p></a>
                  </div>
                  
                  <div class='dir-row'>
                    <img src='assets/add-user.png' width="20" height="20">
                    <a href='acesslevel.php'><p class="action-nav">Adicionar subordinado</p></a>
                  </div>

                  <div class='dir-row settings'>
                    <img src='assets/setting.png' width="20" height="20">
                    <a href=''><p class="action-nav">Configurações</p></a>
                  </div>

                </div>
            </nav>
            <section>
                <div class="chart-test">
                    <canvas id="myChart"></canvas>
                </div>
            </section>
        </div>
        
    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const labels = <?php echo json_encode($datas) ?>;
      const dataJSON = <?php echo json_encode($consumo) ?>;
      const allDataJSON = <?php echo json_encode($subordinados_inputs) ?>;

      let dataNumber = [];

      for(let el of dataJSON) {
        dataNumber.push(Number(el));
      }

      const data = {
        labels: labels,
        datasets: [{
          label: 'Consumo',
          backgroundColor: '#5D13E7',
          borderColor: '#5D13E7',
          data: dataNumber
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
    </script>

</html>