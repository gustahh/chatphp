<?php include_once("header.php"); 
?>



<title>Login</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../src/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.1/lottie.min.js"></script>


   <main>
            <div id="box">
                    <div id="text"> Bem vindo de volta! </div>
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
                    <div class="regist">  Registre-se </div>
                    <a href="Forgot Password/user.php"><div id = "forgot"> Esqueceu sua senha? </div></a>
                    <button class="btn-login"> Entrar </button>
                    </form>        
                </div>
                <script>
                    $( ".regist" ).click(function() {
                        document.getElementById('registerlink').click();
                        $("#box").css({"animation-name": "popout"});
                    });
                    
                </script>
        </main>