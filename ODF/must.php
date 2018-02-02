<?php
  ob_start();
  session_start();
  require_once 'db.php';
  include 'functions.php';
  if( !isset($_SESSION['id']) ) {
    header("Location: login.php");
  }
  $id = $_SESSION['id'];
?>
