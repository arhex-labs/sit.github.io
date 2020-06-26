<?php
	session_start();
   	unset($_SESSION["userId"]);
   	session_unset();
	session_destroy();
   	header("LOCATION: index.php");
?>
   