<?php
  ob_start();
  session_start();
  require_once 'db.php';
  require 'functions.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>LogIn SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/w3css1.css">
    <link rel="stylesheet" href="CSS/w3theme.css">
    <script type="text/javascript" src="register.js"></script>
    <style>
       .block{
        margin:2% 35%;
        }
       table,td  {padding:12px;}
       td:focus   {background-color:#0000FF;}
      .button{
        background-color: #607d8b; /* Green */
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
    </style>
  </head>
  <body>
    <div class="w3-container block">
      <h2 class="w3-center">Open Discussion Forum</h2>
      <div class="w3-row main">
        <a href="javascript:void(0)" onclick="openCity(event, 'LogIn');">
          <div class="w3-col s6 tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">LogIn</div>
        </a>
        <a href="javascript:void(0)" onclick="openCity(event, 'SignUp');">
          <div class="w3-col s6 tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">SignUp</div>
        </a>
      </div>
      <div id="LogIn" class="page" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">   <!-- login section-->
        <div class="main">
          <table>
            <form method="POST" action="">
              <tr>
  	             <td>Email Id:</td>
  	             <td><input class="name" type="text" name="email_id"></td>
  	          </tr>
  	          <tr>
  	             <td>Password:</td>
  	             <td><input class="pass" type="password"name="password"></td>
  	          </tr>
  	          <tr>
                  <td></td>
  	              <td>
  	                 <input class="button w3-theme" type="submit" value="Log In" name="login">
  	              </td>
  	          </tr>
  	          <tr>
	           <td></td>
  	             <td><a href="http://localhost/ODF/preforgotpassword.php">Forget Password</a></td>
  	          </tr>
            </form>
          </table>
        </div>
      </div>
      <div id="SignUp" class="w3-container page" style="padding-left:10px; display:none; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">

  	<div class="main">
    <table>
     <form method="POST" name = "form1" action="" onsubmit="return formValidation()">
     <tr>
  	<tr>
      <tr>
  	<td>Firstname:</td>
  	<td><input class="name" type="text" name="first_name"></td>
  	</tr>
  	<tr>
  	 <tr>
  	<td>Lastname:</td>
  	<td><input class="name" type="text" name="last_name"></td>
  	</tr>
  	<tr>
  	 <tr>
  	<td>E-mail:</td>
  	<td><input class="name" type="text" name="email_id"></td>
  	</tr>
  	<tr>
  	 <tr>
  	<td>Password:</td>
  	<td><input class="name" type="password" name = "password1"></td>
  	</tr>
  	<tr>
  	<td>Re-Password:</td>
  	<td><input class="pass" type="password" name="password"><td>
  	</tr>
  	<tr>
  	<td>Phone No.:</td>
  	<td><input class="name" type="text" name="phone_no"></td>
    </tr>
    <tr>
	<td>Department:</td>
	<td><select name = "dept_name"><?php

          $query = "SELECT dept_name from DEPARTMENT";
          $res = mysql_query($query);
          while ($row = mysql_fetch_array($res)) {
         $dept_name = $row['dept_name'];?>
	<option value="<?php echo $dept_name; ?>"> <?php echo $dept_name; ?> </option>
	<?php	}
                ?>
       </select>
	</td>
	</tr>
    <tr>
    <td></td>
    <td>
  	<input class="button" type="submit" value="Sign Up" name="register">
  	</td>
      	</tr>
     </form>
     <table>
    </div>

    </div>
    </div>
    <script>
      function openCity(evt, name) {
        var i, x, tablinks;
        x = document.getElementsByClassName("page");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" w3-border-black", "");
        }
        document.getElementById(name).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-black";
      }
    </script>
  </body>
</html>
<?php
if (isset($_SESSION['id'])){
  header("Location: home.php");
}
if (isset($_POST['login'])){
   $email_id = trim($_POST['email_id']); //TAKING EMAIL
   $email_id = strip_tags($email_id);
   $email_id = htmlspecialchars($email_id);

   $password = trim($_POST['password']); //TAKING PASSWORD
   $password = strip_tags($password);
   $password = htmlspecialchars($password);
   $password = md5($password);// password hashing using SHA256

   $query = "SELECT id,password,registered FROM USER WHERE email_id = '$email_id'";
   $res = mysql_query($query);
   $row=mysql_fetch_array($res);
   echo $row['password']."<br>";
   echo $password;
   if ($row['password']==$password){
     echo "yes";
   }
   if( mysql_num_rows($res) == 1 && $row['password']==$password){
     if ($row['registered'] > 0 ){
       $_SESSION['id'] = $row['id'];
       $id = $row['id'];
       $registered = $row['registered'];
       $query2 = "UPDATE USER SET registered = '$registered'+1 WHERE id = '$id'";
       mysql_query($query2) or die("UNABLE TO UPDATE");
       if ($row['registered'] == 1){
         header("Location: prehome.php");
       }
       else{
         header("Location: home.php");
       }
     }
     else{
       echo "<script>alert('ACCOUNT NOT ACTIVATED');</script>";
     }
   }
   else{
     echo "<script>alert('INVALID CREDENTIALS');</script>";
   }
 }
elseif (isset($_POST['register'])){          // IF REGISTER BUTTION IS PRESSED
    $first_name = trim($_POST['first_name']);
    $first_name = strip_tags($first_name);
    $first_name = htmlspecialchars($first_name);

    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);

    $email_id = trim($_POST['email_id']);
    $email_id = strip_tags($email_id);
    $email_id = htmlspecialchars($email_id);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);
    $password = md5($password);

    $dept_name = $_POST['dept_name'];

    if(1 === preg_match('~[0-9]~', $email_id)){
      $teacher_student = 0;
    }
    else{
      $teacher_student = 1;
    }

    $phone_no = $_POST['phone_no'];

    $query = "SELECT COUNT(*) FROM USER WHERE email_id = '$email_id'";
    $res = mysql_query($query);
    $row = mysql_fetch_array($res);
    if ($row[0] == 0){
      $confirm_code=md5(uniqid(rand()));  // RANDOM CODE FOR CONFIRMATION
      //INSTERTING INTO DATABASE
      $query = "INSERT INTO USER(confirm_code,email_id,password,first_name,last_name,phone_no,dept_name,teacher_student) VALUES ('$confirm_code','$email_id', '$password', '$first_name', '$last_name', $phone_no, '$dept_name', $teacher_student)";
      if (mysql_query($query) or die(mysql_error())){
        $subject = "Your confirmation link here";
        $Body = "CLICK ON THIS LINK TO ACTIVATE \r\n <br> http://localhost/ODF/confirmation.php?passkey=$confirm_code"; // ADDING CONFIRMATION CODE AT THE END OF HTE LINK;
        if(sendmail($email_id,$subject,$Body)){
          unset($first_name);// IF INSTERTED THEN CLEAR THE SESSION VARIABLES
          unset($last_name);
          unset($email_id);
          unset($password);
          echo "<script>alert('ACTIVATION EMAIL SEND'); document.location='http://localhost/ODF/login.php' </script>";
        }
      }
      else{
        echo "ERROR ENTERING RECORD";
      }
    }
    else{
      echo "<script>alert('ALREADY REGISTERED');</script>";
    }
  }

?>
