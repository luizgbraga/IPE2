<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <title>Faça seu Login</title>
        <meta charset="utf-8">
        <style>
          <?php include 'styles/login.style.css'; ?>
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    </head>

    <body>

        <aside></aside>

        <div id="island">
            <h2>Entrar</h2>

            <div class="login-form">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="whole-input">
                        <div class='dir-row'>
                            <div class='icon-senha <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                <img src="assets/user.png" alt="user-icon" width="22" height="22" />
                            </div>
                            <input type="text" name="username" placeholder="Login" class="writable-input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    

                    <div class="whole-input with-margin-top">
                        <div class='dir-row'>
                            <div class='icon-senha <?php echo (!empty($password_err)) ? 'is-invalid-icon' : ''; ?>'>
                                <img src="assets/lock.png" alt="lock-icon" width="22" height="22" />
                            </div>
                            <input type="password" name="password" placeholder="Senha" class="writable-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>

                    <div class='dir-row'>
                        <input type="checkbox" name="remember" class="checkbox">
                        <p>Lembrar de mim?</p>
                    </div>

                    <div class="whole-input">
                        <div class='dir-row'>
                            <input type="submit" class="btn" value="Entrar       ">
                            <img src="assets/next.png" class='next' alt="Next" width="20" height="20" />
                        </div>
                    </div>

                    <p>Não tem uma conta? <a href="register.php">Inscreva-se agora</a>.</p>

                </form>
                
            </div>
        </div>
    </body>
</html>