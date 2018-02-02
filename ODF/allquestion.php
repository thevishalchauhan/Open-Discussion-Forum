<?php
  require 'must.php';
   if ($_GET['id']!=$id){
    $user_id = $_GET['id'];
  }
  else {
    $user_id = $id;
  }
    $qno = $_GET['qno'];
  $question = $_GET['question'];
  $date_updated1 = $_GET['date_updated'];
?>
<!DOCTYPE html>
<html>
<title>ODF</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/w3css1.css">
<link rel="stylesheet" href="CSS/w3theme.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">
<?php
								 // USER DATA FETCHING

  //$user_id = $id;
  $query = "SELECT email_id,first_name,last_name,phone_no,dept_name,teacher_student FROM USER WHERE id = '$user_id'";
  $res = mysql_query($query);
  $row=mysql_fetch_array($res);
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $email_id = $row['email_id'];
  $phone_no = $row['phone_no'];
  $dept_name = $row['dept_name'];
  $teacher_student = $row['teacher_student'];   // 0 for student and 1 for teacher..
?>
<!-- Navbar -->
<div class="w3-top">
 <ul class="w3-navbar w3-theme-d2 w3-left-align w3-large">
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  </li>
  <li><a href="home.php" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>ODF</a></li>

  <!-- changes No2-->
  <li class="w3-hide-small w3-right">
    <form class="" action="" method="post">
      <input method="post" type="submit" name="logout" class="w3-btn w3-theme-d1 w3-padding-large w3-hover-white" value="LogOut">
    </form>
    <?php
    if (isset($_POST['logout'])){
      echo $_SESSION['id'];
      unset($_SESSION['id']);
      session_unset();
      session_destroy();
      header("Location: index.php");
    }?>
    </li>
 </ul>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-theme">
    <li><a class="w3-padding-large" href="#">Link 1</a></li>
    <li><a class="w3-padding-large" href="#">Link 2</a></li>
    <li><a class="w3-padding-large" href="#">Link 3</a></li>
    <li><a class="w3-padding-large" href="#">My Profile</a></li>
  </ul>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">

  <!-- The Grid -->
	<div class="w3-row">
    <!-- Left Column -->
  <?php  if ($id == $user_id){
  ?>
		<div class="w3-col m3">
      <!-- Profile -->
			<div class="w3-card-2 w3-round w3-white">
				<div class="w3-container">
					<h4 class="w3-center">My Profile</h4>
					<p class="w3-center"><a href = 'profile.php?id=<?php echo $id;?>'><img src="Images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></a></p>
					<hr>
					<p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $first_name." ".$last_name?></p>
					<p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> CSE</p>
				</div>
			</div>
			<br>
		</div>
<?php }
else{?>
  <div class="w3-col m3">
  <div class="w3-card-2 w3-round w3-white">

  <div class="w3-container w3-center">
    <h3><?php echo $first_name." ".$last_name?></h3>
    <img src="Images/avatar3.png" alt="Avatar" style="width:80%">

    <div class="w3-section">
<?php
  $query = "SELECT DISTINCT * FROM FOLLOWER WHERE id = '$id' and follow_id = '$user_id'";
  $res = mysql_query($query);
?>
    <form action="" method="post">
<?php
  if (mysql_num_rows($res) == 0){
?>
      <button name = "follow" type="submit" class="w3-btn w3-green">Follow</button>
<?php }
  else {
?>
      <button name = "unfollow" value="unfollow" type="submit" class="w3-btn w3-green">Unfollow</button>
    </form>
<?php } ?>
      <!--<button class="w3-button w3-red">Cancel</button>-->
      <?php
      $time = time();
      if(isset($_POST['follow'])){
        $query = "INSERT INTO FOLLOWER(id, follow_id) VALUES ($id, $user_id)";
        if (mysql_query($query) or die(mysql_error())) {
          $query = "select first_name, last_name from user where id = '$id'";
          $res = mysql_query($query);
          $row = mysql_fetch_array($res);
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $content = $first_name." ".$last_name." is Following You";
          $query = "INSERT INTO NOTIFICATION(sender_id, reciever_id, noti_heading, noti, date_updated) VALUES($id, $user_id, 'FOLLOW', '$content','$time')";
          mysql_query($query) or die(mysql_error());
          header("Location: profile.php?id=$user_id");
        }
      }
      else if (isset($_POST['unfollow'])) {
        $query = "DELETE FROM FOLLOWER WHERE id = '$id' and follow_id = '$user_id'";
        if (mysql_query($query) or die(mysql_error())) {
          $query = "DELETE FROM NOTIFICATION WHERE sender_id = '$id' and reciever_id = '$user_id' and noti_heading = 'FOLLOW'";
          mysql_query($query) or die(mysql_error());
          header("Location: profile.php?id=$user_id");
        }
      }
      ?>
    </div>

  </div>
  </div>
 </div>
 <?php
}?>
		<!-- Middle Column -->
          <div class="w3-col m7">

            <div class="w3-row-padding">
			<?php //yaha se uthega #id,qno,quesiton,date_updated ?>
               <div class="w3-container w3-card w3-white w3-round w3-margin-left">
              <!-- The Modal -->
                    <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
                      <img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px">
                      <span class="w3-right w3-opacity">
                      </span>
                      <h4>
<?php
    echo "<a href=\"profile.php?id=$user_id\">$first_name".' '."$last_name</a>";
?>
<span class="w3-right w3-opacity">
<?php
  //$date_updated = $_GET['date_updated'];
echo time_cal($date_updated1);
?>
</span>
                      </h4>
                      <hr class="w3-clear">
                      <p>
<?php
   echo $question."?";
?>
                      </p>

                    </div>
                      <form class="w3-container" action="" method="post">
                        <p>
                          <label class="" style="font-color:black;"><b>Post Your Answer:</b></label>
                          <textarea class="w3-input w3-border" name="answer" type="text" autocomplete="off"></textarea>
                        </p>
                        <button value = "<?php echo $qno; ?>" class="w3-btn w3-theme-d1" type="submit" name="postans">Post</button>
                      </form>
                      <?php // UPLOADING ANSWERS
                        if(isset($_POST['postans'])){
                          if ($qno == $_POST['postans']) {
                            $answer = $_POST['answer'];
                            $date_updated = time();
                            $query = "INSERT INTO ANSWER(id, qno, answer, date_updated) VALUES ('$id','$qno','$answer','$date_updated')";
                            mysql_query($query) or die(mysql_error("ERROR ENTERING RECORD"));
//header("location: home.php");
                          }
                        }
                      ?>

                <hr>
                <h3 class="w3-container">Answers</h3>
<!-- answers by diff user-->
<?php // FETCHING ANSWERS

  //echo $qno."<br>";
  $query = "SELECT ANSWER.ano, ANSWER.answer, ANSWER.date_updated, USER.id, USER.first_name, USER.last_name, USER.email_id FROM ANSWER JOIN USER ON ANSWER.id = USER.id WHERE ANSWER.qno = '$qno'";
  $res4 = mysql_query($query);
  while($row4 = mysql_fetch_array($res4)){
  $ano = $row4['ano'];
  $answer = $row4['answer'];
  $date_updated = time_cal($row4['date_updated']);
  $user_id = $row4['id'];
  $first_name = $row4['first_name'];
  $last_name = $row4['last_name'];
  $email_id = $row4['email_id'];
?>
              <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
                <img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px">
                <span class="w3-right w3-opacity">
<?php
  echo $date_updated;
?>
                </span>
                <h4>
<?php
  echo "<a href=\"profile.php?id=$user_id\">$first_name".' '."$last_name</a>";
?>
                </h4>
                <hr class="w3-clear">
                <p>
<?php
  echo $answer;
?>
</p>

              </div>
<?php }?>
        <?php //yaha tak uthega ?>

			</div>
            </div>
                      <!-- End Middle Column -->
          </div>

                  <!-- End Page Container -->


    </div>
</div>
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
function openCity(evt, name) {
  var i, x, tablinks;
  x = document.getElementsByClassName("page");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-grey", "");
  }
  document.getElementById(name).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-grey";
}

</script>

</body>
</html>
