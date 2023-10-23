<?php

include_once("../bd/conexao.php"); //chama o arquivo conexao.php que faz a conexao
session_start(); //inicia a sessão

$email = $_POST['email']; //pega os dados do campo com name email
$_SESSION['email'] = $_POST['email']; //passa os dados do campo com name email para a sessao, podendo ser pego em qualquer página
$user = $_POST['user']; //pega os dados do campo com name user
$_SESSION['user'] = $_POST['user']; //passa os dados do campo com name user para a sessao, podendo ser pego em qualquer página
$password = $_POST['password']; //pega os dados do campo com name password
$confirm_password = $_POST['confirm_password']; //pega os dados do campo com name confirm password
$error01 = "error01"; //erro em string
$error02 = "error02"; //erro em string
$error03 = "error03"; //erro em string
$error04 = "error04"; //erro em string

$query = "SELECT email FROM `users` WHERE email = '$email'"; //sintaxe da pesquisa
$query_result = mysqli_query($conexao, $query); //faz a query da pesquisa
$row_query = mysqli_num_rows($query_result); //detecta as linhas do resultado da pesquisa

$query = "SELECT user FROM `users` where user = '$user'"; //sintaxe da pesquisa
$query_user = mysqli_query($conexao, $query); //faz a query da pesquisa
$row_user = mysqli_num_rows($query_user); //detecta as linhas do resultado da pesquisa

   if (empty($email) or empty($user) or empty($password) or empty($confirm_password)) { //se os campos email, user, name e password estiverem vazios, erro 1
        $_SESSION['register_error01'] = true;
        header('Location: register.php?p=register&error01='.$error01); //o . em php funciona como concatenação
        exit();
    } else if ($password != $confirm_password) { //se as senhas forem diferentes, erro 2
        $_SESSION['register_error02'] = true;
        header('Location: register.php?p=register&error02='.$error02);
        exit();
    } 
    else if ($row_query > 0) { //se o email for encontrado (já existe), erro 3
        $_SESSION['register_error03'] = true;
        header('Location: register.php?p=register&error03='.$error03);
        exit();
    } else if ($row_user == 1) { //se o nome de usuário for encontrado (já existe), erro 4 
        $_SESSION['register_error04'] = true;
        header('Location: register.php?p=register&error04='.$error04);
        exit();
    }   
    else { //senão
        $register = "INSERT INTO users (email, user, password) VALUES ('$email', '$user', md5('$password'))"; 
        if (mysqli_query($conexao, $register)) {
            echo 'success';
        } else {
            echo 'failure';
        }
}
header('Location: ../login/login.php');
?>