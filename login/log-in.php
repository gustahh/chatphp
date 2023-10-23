<?php 
include('../bd/conexao.php');
session_start();

if(empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: login.php');
    exit();
}

$username = mysqli_real_escape_string($conexao, $_POST['username']);
$password = mysqli_real_escape_string($conexao, $_POST['password']);
$name = mysqli_real_escape_string($conexao, $_POST['name']);

$query = "SELECT id, user FROM users WHERE user = '$username' and password = md5('$password')";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['username'] = $username;
    header('Location: ../home/index.php');
    $delete = "DELETE FROM token WHERE timestamp < DATE_SUB(NOW(), INTERVAL 5 MINUTE) AND user = '$username'";
    $query_delete = mysqli_query($conexao, $delete);
    $row_delete = mysqli_num_rows($query_delete);
    exit();
}
else {
    $_SESSION['login_error'] = true;
    header('Location: ?p=login');   
    exit();
}

?>