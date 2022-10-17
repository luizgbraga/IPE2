<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <title>Crie sua conta</title>
        <meta charset="utf-8">
        <style>
          <?php include 'styles/default.style.css'; ?>
          <?php include 'styles/register.style.css'; ?>
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

        <div id='island'>
            <h2>Criar uma conta</h2>

            <div class="login-form">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class='row'>

                        <div>
                            <div class='row nome'>
                                <div class='icon <?php echo (!empty($nome_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/military-base.png" alt="Sigla" width="24" height="24" />
                                </div>
                                <input type="text" name="nome" placeholder='Nome de sua OM' class="writable-input <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome; ?>">
                            </div>
                            <span class="invalid-feedback"><?php echo $nome_err; ?></span>
                        </div> 

                        <div>
                            <div class='row'>
                                <div class='icon icon-sigla <?php echo (!empty($sigla_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/card.png" alt="Sigla" width="24" height="24" />
                                </div>
                                <input type="text" name="sigla" placeholder='Sigla de sua OM' class="writable-input sigla <?php echo (!empty($sigla_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sigla; ?>">
                            </div>
                            <span class="invalid-margin"><?php echo $sigla_err; ?></span>
                        </div>   

                    </div>

                    <div class='margin-top'>
                        <div class='row'>
                            <div class='icon <?php echo (!empty($login_err)) ? 'is-invalid-icon' : ''; ?>'>
                                <img src="assets/user.png" alt="User" width="24" height="24" />
                            </div>
                            <input type="text" name="login" placeholder='Login' class="writable-input login <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login; ?>">    
                        </div>
                        <span class="invalid-feedback"><?php echo $login_err; ?></span>
                    </div>

                    <div class='row margin-top'>

                        <div>
                            <div class='row'>
                                <div class='icon <?php echo (!empty($senha_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/lock.png" alt="User" width="24" height="24" />
                                </div>
                                <input type="password" name="senha" placeholder='Senha' class="writable-input senha <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>">
                            </div>
                            <span class="invalid-feedback"><?php echo $senha_err; ?></span>
                        </div>

                        <div>
                            <div class='row'>
                                <div class='icon icon-sigla <?php echo (!empty($confirm_senha_err)) ? 'is-invalid-icon' : ''; ?>'>
                                    <img src="assets/key.png" alt="User" width="24" height="24" />
                                </div>
                                <input type="password" name="confirm_senha" placeholder='Confirme a senha' class="writable-input senha <?php echo (!empty($confirm_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_senha; ?>">
                            </div>
                            <span class="invalid-margin"><?php echo $confirm_senha_err; ?></span>
                        </div>

                    </div>

                    <div>
                        <input type="submit" class="btn" value="Criar Conta">
                    </div>

                    <p>Já tem uma conta? <a href="login.php">Entre aqui</a></p>

                </form>

            </div>

        </div>
        
        <aside></aside>

    </body>

</html>