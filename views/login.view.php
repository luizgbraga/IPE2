<!DOCTYPE html>

<html lang='pt-br'>

    <head>

        <title>Faça seu Login</title>
        <meta charset='utf-8'>

        <style>
          <?php include 'styles/default.style.css'; ?>
          <?php include 'styles/login.style.css'; ?>
        </style>

        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Nunito'>
        <link rel="icon" type="image/png" href="../assets/favicon.png">
    
    </head>

    <body>

        <aside></aside>

        <div id='island' class='column'>
            <h2 class='login-title'>Entrar</h2>

            <div class='login-form row'>

                <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>

                    <div>
                        <div class='row'>
                            <div class='icon center-content <?php echo (!empty($username_err)) ? 'is-invalid-icon' : ''; ?>'>
                                <img src='../assets/user.png' alt='user-icon' width='24' height='24' />
                            </div>
                            <input type='text' name='username' placeholder='Login' class='writable-input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>' value='<?php echo $username; ?>'>
                        </div>
                        <span class='invalid-feedback'><?php echo $username_err; ?></span>
                    </div>    

                    <div class='password-input'>
                        <div class='row'>
                            <div class='icon center-content <?php echo (!empty($password_err)) ? 'is-invalid-icon' : ''; ?>'>
                                <img src='../assets/lock.png' alt='lock-icon' width='24' height='24' />
                            </div>
                            <input type='password' name='password' placeholder='Senha' class='writable-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>'>
                        </div>
                        <span class='invalid-feedback'><?php echo $password_err; ?></span>
                    </div>

                    <div class='row'>
                        <input type='checkbox' name='remember' class='checkbox'>
                        <p class='remember-me'>Lembrar de mim?</p>
                    </div>

                    <div>
                        <div class='row'>
                            <input type='submit' class='btn' value='Entrar       '>
                            <img src='../assets/next.png' class='next' alt='Next' width='20' height='20' />
                        </div>
                    </div>

                    <p class='does-not-have-account-text'>Não tem uma conta? <a class='goto' href='register.php'>Inscreva-se agora</a></p>

                </form>
                
            </div>

        </div>

    </body>
    
</html>