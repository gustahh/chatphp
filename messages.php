<?php
    include_once("bd/conexao.php");
    session_start();
    $current_user = $_SESSION['username'];
    if(!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
    }
    $chat_user = $_SESSION['chat_user'];
    $chat_user = trim( $_SESSION['chat_user'] );
    $messages = "SELECT * FROM messages m WHERE (m.msgfrom = '$current_user' AND m.msgto = '$chat_user') OR (m.msgfrom = '$chat_user' AND m.msgto = '$current_user') ORDER BY hour ASC";//SELECT * FROM messages m WHERE (m.msgfrom = '$current_user' AND m.msgto = '$chat_user') OR (m.msgfrom = '$chat_user' AND m.msgto = '$current_user') ORDER BY hour ASC
    $result_messages = mysqli_query($conexao, $messages);
    $row = mysqli_num_rows($result_messages);
        if ($row > 0) {
            while ($rows_messages = mysqli_fetch_array($result_messages)) {
                $msg = $rows_messages["message"];
                $from = $rows_messages["msgfrom"];
                $to = $rows_messages["msgto"];
            ?>
            <br>
            <?php 
                if ($from == $current_user) {
             ?> <div id="msgsender"><?php echo $msg ?></div> <?php
                } else {
                    ?> <div id="msgreceiver"><?php echo $msg ?></div> <?php
                }
            ?>
            <br><br>
            <?php
    }
}                
?>