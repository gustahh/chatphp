<?php 
    include_once("../bd/conexao.php");
    session_start();
    $current_user = $_SESSION['username'];
    $user = $_GET['user'];

    $add = "INSERT INTO adduser (user, addeduser) VALUES ('$current_user', '$user')"; 
    if (mysqli_query($conexao, $add)) {
        echo 'success';
    } else {
        echo 'failure';
    }
?>