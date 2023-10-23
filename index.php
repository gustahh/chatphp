<?php
include_once("bd/conexao.php");
session_start();
$current_user = $_SESSION['username'];
if(!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
}
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../src/javascript.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div id="box-message">
        <div id="chats">
            <form action="search/search.php" method="post" id="form">
                <input type="search" id="search" name="search">
            </form>
            <h1 id="text-interface">Chats</h1>
            <?php 
                $chats = "SELECT * FROM `adduser` WHERE user LIKE '$current_user'";
                $result_chats = mysqli_query($conexao, $chats);
                $row = mysqli_num_rows($result_chats);
                if ($row > 0) {
                    while ($rows_chats= mysqli_fetch_array($result_chats)) {
                        $user = $rows_chats["addeduser"];
                        ?> 
                        <a href="index.php?user=<?php echo $user ?>">
                            <div id="result">
                                <?php if($user == $_GET['user']) {
                                    ?> 
                                        <div id="chatuserchat">
                                    <?php
                                } else {
                                    ?> <div id="chatuser"> <?php
                                } ?>
                                    <div id="profilepic"><img src="images/pfp.jpg" alt="" id="pfp"></div>
                                    <h3 id="text-interface" style="top: 30%;"><?php echo $user ?></h3>
                                    </form>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                }
            ?>
            

            
        </div>
        <?php if(isset($_GET['user'])) {
            $chat_user = $_GET['user'];
            $_SESSION['chat_user'] = $chat_user;
            $chat_user = trim( $_GET['user'] );
            ?>
            <div id="userbar">
                <div id="profilepic"><img src="images/pfp.jpg" alt="" id="pfp"></div>
                <h3 id="text-interface" style="top: 30%;">
                    <?php echo $chat_user ?>
                </h3>
                <span class="material-symbols-outlined" id="options">more_vert</span>
            </div> 
            <?php } ?>
            <?php if(isset($_GET['user'])) {
        ?>
            <div id="message-box">
                <script>
                    function loadMsg() {
                        $("#message-box").load("messages.php");
                    }
                    loadMsg(); // This will run on page load
                    setInterval(function(){
                        loadMsg() // this will run after every 5 seconds
                    }, 5000);
                </script>
                
            </div> 
        <?php } else {
            ?>
            <div id="index"></div>
            <?php
        }?>

        <div id="current_user">
                <div id="profilepic"><img src="images/pfp.jpg" alt="" id="pfp"></div>
                <h3 id="text-interface" style="top: 30%;">
                    <?php echo $current_user ?>
                </h3>
                <a href="../login/logout.php"><span id="config" class="material-symbols-outlined">logout</span></a>
            </div>
        
        <?php if(isset($_GET['user'])) {
        ?>
        <form action="../messages/newmessage.php" method="post" id="formmessage" name="formmessage">
            <div id="send">
                <input type="text" id="sendmessage" name="sendmessage" placeholder="Envie uma mensagem" onkeyup="keyup()">
                <button id="btnsend" disabled><img src="images/send.svg" alt="" id="sendicon"></button>
            </div> 
        </form>
        <?php } ?>
    </div>
    <div id="result"></div>
    <script>
        //carrega mensagens e recarrega a cada 5 segundos
        
        $("#form").submit(function(e) {
            e.preventDefault();
            var form = $('#form')[0];
            var formData = new FormData(form);
            $.ajax({
                    url: '../search/search.php',
                    type: 'POST',
                    search: $("#search").val(),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#chats").html(data)
                    }
                },
                function(result) {
                    if (result == "success") {
                       
                    }
                });
        });

        //mensagem sem recarregar a página

        $("#formmessage").submit(function(e){
                        e.preventDefault();
                        
                        var form = $('#formmessage')[0];
                        var formData = new FormData(form);
                        $.post(
                            {
                                url: '../messages/newmessage.php',
                                type: 'POST',
                                content: $("#sendmessage").val(), 
                                data: formData,
                                processData:false,
                                contentType:false,
                                success:function(data){
                                    loadMsg(),
                                    document.getElementById("sendmessage").value = "",
                                    document.getElementById("btnsend").disabled = true
                                }   
                            },
                            function(result){
                                if(result=="success"){
                                    
                                }else{
                                    $("#result").html("Houve um erro ao enviar a mensagem, nos desculpe :(")
                                }
                            }
                        );
                    });
                    if (!$('#sendmessage').val()) {
                        document.getElementById("btnsend").disabled = true
                    }
    </script>
</body>

</html>