<?php include_once("./header.php"); 
ini_set("error_reporting", 1);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: pre-check=0, post-check=0", false);
header("Pragma: no-cache");

if ($_GET["rel"]!="tab") {

?>
<div>Here coming data from 
   <strong>PHP</strong> page. 
   <a href="#" class="link">Click</a>
</div>
<!-- add script -->
<script>
   document.querySelector(".link").addEventListener("click", function( e ) {
      e.preventDefault();
      alert("I am PHP page.");
   });
</script>

<?php include_once("./footer.php"); 
}
?>