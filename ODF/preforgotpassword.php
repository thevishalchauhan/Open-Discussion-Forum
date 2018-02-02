<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
      <title>Forgot Password</title>
  </head>
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
  <body>
     <div class="w3-container block">
      <div class="main">
      <table>
       <form method="POST" action="">
       <tr>
    	<th colspan="2" style="width:100%; padding:10px; font-size:20px">CHANGE PASSWORD</th>
    	<tr>
    	<td>E-mail ID:</td>
    	<td><input class="name" type="text" name="email_id"></td>
    	</tr>
    	<tr>
    	<td></td>
    	<td>
    	<input class="button"  type="submit" value="Select" name="change_password">
    	<input class="button"  type="submit" value="Cancel" name= "cancel" >
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
  require 'functions.php';
  require_once 'db.php';
  if( isset($_POST['change_password']) ){
     $email_id = trim($_POST['email_id']);
     $email_id = strip_tags($email_id);
     $email_id = htmlspecialchars($email_id);
     $query = "SELECT * FROM USER WHERE email_id = '$email_id'";
     $res = mysql_query($query);
     $row = mysql_fetch_array($res);
     if (mysql_num_rows($res) == 1){
       if ($row['registered'] >= 1){
         $confirm_code=md5(uniqid(rand()));
         $query = "UPDATE USER SET confirm_code = '$confirm_code' WHERE email_id = '$email_id'";
         if (mysql_query($query)){
           $subject="PASSWORD CHANGE LINK";
           $Body="YOUR PASSWROD CHANGE LINK \r\nClick on this link to CHANGE THE PASSWROD \r\n http://localhost/ODF/forgot_password.php?passkey=$confirm_code";
           if(sendmail($email_id,$subject,$Body)){
             echo "<script>alert('EMAIL SEND'); document.location='http://localhost/ODF/login.php' </script>";
           } // SEND EMAIL
         }
         else{
           echo "CAN'T UPDATE FORGOT PASSWROD CODE";
         }
       }
       else{
         echo "EMAIL NOT REGISTERED";
       }
     }
     else{
       echo "NOT A VALID EMAIL";
     }
   }

  elseif (isset($_POST['cancel'])) {
    header("Location: login.php");
  }
?>
