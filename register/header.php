<?php
   ini_set("error_reporting", 1);
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: pre-check=0, post-check=0", false);
   header("Pragma: no-cache");

   if ($_GET["rel"]!="tab") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UrSpace</title>
   <link rel="stylesheet" href="src/newstyle.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="./src/script.main.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.1/lottie.min.js"></script>
</head>
       <header>
         
        </header>
<?php } ?>