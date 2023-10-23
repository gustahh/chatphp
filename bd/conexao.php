<?php

define('HOST', 'localhost:3307');
define('USER', 'gustah');
define('PASSWORD', 'ADMIN');
define('DB', 'chatphp');

$conexao = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Connection failed :C');

?>