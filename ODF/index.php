<?php  //Current PHP version: 5.6.3
session_start();
 if( !isset($_SESSION['id']) ) {
  header("Location: login.php");
 }
 else{
   header("location: home.php");
 }
 ?>
