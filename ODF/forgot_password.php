<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <style>
       .block{
          margin:7% 28%;
         }
        div.main{
         width:500px;
         overflow:hidden;
         margin:5% 2%;
         box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }


        table,td{
        padding:12px;
        }


        td:focus{background-color:#0000FF;
         }


        .button {
          background-color: #607d8b; /*  */
          border: none;
          color: white;
          padding: 10px 25px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
      	border-radius:8px;
          font-size: 16px;
      	 }
      .button:hover {
          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      }


      .name
      {
      padding:4px;
      height:20px;
      width:100%;
      }
    </style>
    <meta name="viewport" content="width=device-width,initial-scale=1">
  </head>
  <body>
     <div class="w3-container block">
      <div class="main">
      <table>
       <form method="POST" action="">
       <tr>
    	<th colspan="2" style="width:100%; padding:10px; font-size:20px">Change Password</th>
    	<tr>
    	<td>Password:</td>
    	<td><input class="name" type="password" name="password1"></td>
    	</tr>
    	<tr>
    	<td>Re-Password:</td>
    	<td><input class="name" type="password" name="password"></td>
    	</tr>
    	<tr>
    	<td></td>
    	<td>
    	<input class="button"  type="submit" value="Select" name="change_password">
    	<input class="button"  type="submit" value="Cancel" name = "cancel" style="margin:1px 0px 1px 40px;">
    	</td>
    	</tr>
       </form>
       <table>
      </div>
      </div>
  </body>
</html>
<?php
session_start();
ob_start();
require_once 'db.php';
if(isset($_POST['change_password'])){
  $passkey=$_GET['passkey'];
  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  $password = md5($password);
  $query = "SELECT * FROM USER WHERE confirm_code ='$passkey'";
  $res = mysql_query($query);
  $row=mysql_fetch_array($res);
  if (mysql_num_rows($res) == 1){
    $query = "UPDATE USER SET password = '$password' WHERE confirm_code = '$passkey'";
    if (mysql_query($query)){
      $query2 = "SELECT id FROM USER WHERE confirm_code = '$passkey'";
      $row2=mysql_fetch_array(mysql_query($query2));
      $_SESSION['id'] = $row['id'];
      echo "<script>alert('PASSWORD HAS BEEN CHANGED');</script>";
      header("Location: home.php");
    }
    else{
      echo "PASSWROD NOT UPDATED";
    }
  }
  else{
    echo "WRONG CODE";
  }
}
elseif (isset($_POST['cancel'])) {
  header("Location: login.php");
}
 ?>
