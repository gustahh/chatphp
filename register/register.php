<?php include_once("../login/header.php"); 
?>



<title>Register</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../src/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.1/lottie.min.js"></script>
   <script src="../src/script.main.js"></script>

    <main>
        <div id="box-register">
                    <form method = "POST" action = "processa.php"> <!-- formulário do tipo 'POST' envia as informações para outra página -->
                        <div id="text-register"> Crie uma conta! </div>
                        <div id="lblEmail"> E-MAIL </div>
                        <input type="text" name = "email" id="email" >

                        <div id="lblUser"> NOME DE USUÁRIO </div>
                        <input type="text" name = "user" id="user" maxlength="15" required="required" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$">
                        <div id="lblSenha"> SENHA </div>
                        <input type="password" name= "password" id="password" maxlength="32">

                        <div id="lblConSenha"> CONFIRMAR SENHA </div>
                        <input type="password" name = "confirm_password" id="confirmpassword" maxlength="32" >
                        <div id="account">Espera aí, já tem uma conta?</div>
                        <form action="/verify email/send.php">
                            <button class="btn-reg" name = 'register'> Registrar </button>
                        </form>
                        <?php                    
                        if (@$_GET['error01']) { ?> <!-- pega a variavel error01 da url -->
                            <script> 
                                email = document.getElementById("email").style.borderColor = "#EA2027";
                                name = document.getElementById("nome").style.borderColor = "#EA2027";
                                user = document.getElementById("user").style.borderColor = "#EA2027";
                                password = document.getElementById("password").style.borderColor = "#EA2027";
                                confirm_password = document.getElementById("confirmpassword").style.borderColor = "#EA2027";
                            </script>
                            <div id="error">
                            <img src="error.svg" id = "img">
                            <div id="text1">Todos os campos devem ser preenchidos!</div>
                            </div> 
                            <?php  } else if (@$_GET['error02']) { ?> <!-- pega a variavel error02 da url -->
                            <script>
                                document.getElementById("password").style.borderColor = "#EA2027";
                                document.getElementById("confirmpassword").style.borderColor = "#EA2027";
                            </script>
                            <div id="error">
                            <img src="error.svg" id = "img">
                            <div id="text1">As senhas definidas pelo usuário não coincidem</div>
                            </div> 
                        <?php  }  else if (@$_GET['error03']) { ?> <!-- pega a variavel error03 da url -->
                            <script>
                                document.getElementById("email").style.borderColor = "#EA2027";
                            </script>
                            <div id="error">
                            <img src="error.svg" id = "img">
                            <div id="text1">Email digitado pelo usuário já existe</div>
                            </div> 
                        <?php  }  else if (@$_GET['error04']) { ?> <!-- pega a variavel error04 da url -->
                            <script>
                                document.getElementById("user").style.borderColor = "#EA2027";
                            </script>
                            <div id="error">
                            <img src="error.svg" id = "img">
                            <div id="text1">Nome de usuário já existe</div>
                            </div> 
                        <?php } ?>
                    </form>
                </div>
                <script>
                    $( "#account" ).click(function() {
                        document.getElementById('loginlink').click();
                        $("#box-register").css({"animation-name": "popout"});
                    });
                </script>
    </main>
<?php include_once("./footer.php"); ?>