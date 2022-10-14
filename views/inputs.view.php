<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <style>
          <?php include 'styles/inputs.style.css'; ?>
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
                    <img src='assets/home.png' width="20" height="20">
                    <a href='welcome.php'><p class="action-nav">Início</p></a>
                  </div>

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

                <h2 class='title'>Insira um novo dado</h2>

                <div class='data-form'>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="whole-input">
                            <div class='dir-row'>
                            <input type="date" name="data" class="writable-input <?php echo (!empty($data_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $data; ?>">
                            </div>
                            <span class="invalid-feedback"><?php echo $data_err; ?></span>
                        </div>  

                        <div class="whole-input">
                            <div class='dir-row'>
                            <input type="number" name="consumo" placeholder='Consumo' class="writable-input <?php echo (!empty($consumo_err)) ? 'is-invalid' : ''; ?>">
                                <div class='icon-senha <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/plugue.png" alt="plugue-icon" width="22" height="22" />
                                </div>
                            </div>
                            <span class="invalid-feedback"><?php echo $consumo_err; ?></span>
                        </div>   

                        <div class="whole-input">
                            <div class='dir-row'>
                            <input type="number" name="demanda-medida" placeholder='Demanda medida' class="writable-input <?php echo (!empty($demanda_medida_err)) ? 'is-invalid' : ''; ?>">
                                <div class='icon-senha <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/medidor.png" alt="medidor-icon" width="22" height="22" />
                                </div>
                            </div>
                            <span class="invalid-feedback"><?php echo $demanda_medida_err; ?></span>
                        </div>  

                        <div class="whole-input">
                            <div class='dir-row'>
                            <input type="number" name="energia-reativa" placeholder='Energia reativa' class="writable-input <?php echo (!empty($energia_reativa_err)) ? 'is-invalid' : ''; ?>">
                                <div class='icon-senha <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/energy.png" alt="user-icon" width="22" height="22" />
                                </div>
                            </div>
                            <span class="invalid-feedback"><?php echo $energia_reativa_err; ?></span>
                        </div>  

                        <div class="whole-input">
                            <div class='dir-row'>
                            <input type="number" name="energia-ativa" placeholder='Energia ativa' class="writable-input <?php echo (!empty($energia_ativa_err)) ? 'is-invalid' : ''; ?>">
                                <div class='icon-senha <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/energy.png" alt="user-icon" width="22" height="22" />
                                </div>
                            </div>
                            <span class="invalid-feedback"><?php echo $energia_ativa_err; ?></span>
                        </div>  

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </div>
                    </form>
                </div>
            </section>
        </div>
        
    </body>
</html>