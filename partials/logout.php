<?php 

echo 'Logging you out please wait...';


session_start();

session_destroy();


header("location: ../index.php");




?>