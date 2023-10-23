<?php
include_once("../bd/conexao.php");
session_start();
$current_user = $_SESSION['username'];
$to = $_SESSION['chat_user'];
$to = trim($to);
$from = $current_user;    
$message = $_POST['sendmessage'];

    $register = "INSERT INTO messages (msgfrom, msgto, message) VALUES ('$from', '$to', '$message')"; 
    if (mysqli_query($conexao, $register)) {
        echo 'success';
    } else {
         echo 'failure';
    }

?>