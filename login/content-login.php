<?php session_start(); //inicia a sessão ?>
                    <div class="logo-box">
                    <img class="logo" src="home/images/Space.svg" alt="">
                    </div>
                    <div id="text"> Bem vindo de volta! </div>
                    <div id="subtext"> Você provavelmente viajou alguns anos luz! </div> 
                    <form action="log-in.php" method="POST">
                    <div id="lblUserLogin"> NOME DE USUÁRIO </div>
                    <input type="text" id="usernamelogin" name = "username" autocomplete="off">
                    <div id="lblSenhaLogin"> SENHA </div>
                    <input type="password" id="passwordlogin" name = "password" autocomplete="off" maxlength="16">
                    <div id="newaccount"> Ainda não tem uma conta? </div>  
                    <?php
                    if (isset( $_SESSION['login_error'])):
                    ?>
                    <div id="error">
                        <div id="errortxt">Nome de usuário ou senha incorretos!</div>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['login_error']);
                    ?>
                    <a class="regist" href="../register/register.php" onclick="transition();"> <div id = "register">  Registre-se </div> </a>
                    <a href="Forgot Password/user.php"><div id = "forgot"> Esqueceu sua senha? </div></a>
                    <button class="btn-login"> Entrar </button>
                    </form> 