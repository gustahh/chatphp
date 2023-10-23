<link rel="stylesheet" href="../src/style.css">
<form action="../search/search.php" method="post" id="form">
    <input type="search" id="search" name="search">
</form>
<?php
include_once("../bd/conexao.php");
session_start();
$current_user = $_SESSION['username'];


$searching = $_POST['search'];

$search = "SELECT * FROM `users` WHERE user LIKE '%$searching%'";
$result_search = mysqli_query($conexao, $search);
$row = mysqli_num_rows($result_search);
if ($row > 0) {
    while ($rows_search = mysqli_fetch_array($result_search)) {
        $user = $rows_search["user"];
?>
        <div id="result">
            <div id="userresult">
                <div id="profilepic"></div>
                <h3 id="text-interface" style="top: 30%;"><?php echo $user ?></h3>
                <form action="../add/adduser.php?user= <?php echo $user ?>" method="post">
                    <?php 
                        $verification = "SELECT * FROM `adduser` WHERE user = '$current_user' and addeduser = '$user'";
                        $result_verification = mysqli_query($conexao, $verification);
                        $row = mysqli_num_rows($result_verification);
                        if ($row > 0) {
                            ?> 
                                
                            <?php
                        } else {
                            ?> <button id="adduser">Adicionar</button> <?php
                        }
                    ?>
                    
                </form>
                
            </div>
        </div>
<?php
    }
} else {
    echo 'Nenhum usuário encontrado!';
}

?>
<script>
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
</script>