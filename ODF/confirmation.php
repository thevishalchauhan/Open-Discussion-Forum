<?php
session_start();
ob_start();
require 'db.php';
$passkey=$_GET['passkey'];
$query = "SELECT * FROM USER WHERE confirm_code ='$passkey'";//PASSKEY CAN BE SAME IN LONG RUN
$res = mysql_query($query);
$row=mysql_fetch_array($res);
if (mysql_num_rows($res) == 1){
  $query = "UPDATE USER SET registered = 1 WHERE confirm_code = '$passkey'";
  if (mysql_query($query)){
    echo "YOUR ACCOUNT HAS BEEN ACTIVATED YOU CAN LOGIN TO CONTINUE";
    $_SESSION['id'] = $row['id'];
    //header("Location: login.php");
  }
}
else{
  echo "WRONG CONFIRMAITON CODE";
}
 ?>
