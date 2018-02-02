<?php
  require 'must.php';
  if ($_GET['id']!=$id){
    $user_id = $_GET['id'];
  }
  else {
    $user_id = $id;
  }
?>
<?php
  if(isset($_POST['follow_noti'])){
    $noti_id1 = $_POST['follow_noti'];
    $query = "UPDATE NOTIFICATION SET is_read = 1 where noti_id = '$noti_id1'";
    mysql_query($query) or die(mysql_error());
  }
  if(isset($_POST['assignment_noti'])){
    $noti_id1 = $_POST['assignment_noti'];
    $query = "UPDATE NOTIFICATION SET is_read = 1 where noti_id = '$noti_id1'";
    mysql_query($query) or die(mysql_error());
  }
  if(isset($_POST['upvote_noti'])){
    $noti_id1 = $_POST['upvote_noti'];
    $query = "UPDATE NOTIFICATION SET is_read = 1 where noti_id = '$noti_id1'";
    mysql_query($query) or die(mysql_error());
  }

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
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="#" class="w3-padding-large w3-hover-white" title="Follow"><i class="fa fa-user"></i>
      <?php  // FOLLOW NOTIFICATION
      $query = "SELECT noti_id, noti_heading, noti, date_updated, sender_id FROM NOTIFICATION WHERE reciever_id = '$id' and noti_heading = 'FOLLOW' and is_read = 0 order by date_updated desc";
      $res = mysql_query($query);
      $total_noti = mysql_num_rows($res);?>

      <span class="w3-badge w3-right w3-small w3-green"><?php if ($total_noti >0 ){echo $total_noti;} ?></span><!--follow notifcation-->
    </a>
    <div class="w3-dropdown-content w3-white w3-card-4">
      <?php
      while ($row = mysql_fetch_array($res)) {
        $noti_id = $row['noti_id'];
        $noti_heading = $row['noti_heading'];
        $noti = $row['noti'];
        $date_updated = time_cal($row['date_updated']);
        $sender_id = $row['sender_id'];
?>
      <form method="post" action="profile.php?id=<?php echo $id?>"><?php //profile.php?id=php echo $id; ?>
        <button type="submit" class="w3-btn w3-theme-d1 w3-padding-large w3-hover-white" value="<?php echo $noti_id?>" name="assignment_noti"><?php echo $noti; ?></button>
      </form>
      <?php }
      ?>
    </div>
  </li>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="#" class="w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i>
      <?php  // FOLLOW NOTIFICATION
      $query = "SELECT noti_id, noti_heading, noti, date_updated, sender_id FROM NOTIFICATION WHERE reciever_id = '$id' and noti_heading = 'ASSIGNMENT' and is_read = 0 order by date_updated desc";
      $res = mysql_query($query);
      $total_noti = mysql_num_rows($res);?>
      <span class="w3-badge w3-right w3-small w3-green"><?php if ($total_noti >0 ){echo $total_noti;} ?></span><!--//assignment notifcation-->
    </a>
    <div class="w3-dropdown-content w3-white w3-card-4">
      <?php
      while ($row = mysql_fetch_array($res)) {
        $noti_id = $row['noti_id'];
        $noti_heading = $row['noti_heading'];
        $noti = $row['noti'];
        $date_updated = time_cal($row['date_updated']);
        $sender_id = $row['sender_id'];
?>
      <form method="post" action="profile.php?id=<?php echo $id?>"><?php //profile.php?id=php echo $id; ?>
        <button type="submit" class="w3-btn w3-theme-d1 w3-padding-large w3-hover-white" value="<?php echo $noti_id?>" name="follow_noti"><?php echo $noti; ?></button>
      </form>
      <?php }
      ?>
    </div>
  </li>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="#" class="w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i>
      <?php  // FOLLOW NOTIFICATION
      $query = "SELECT noti_id, noti_heading, noti, date_updated, sender_id FROM NOTIFICATION WHERE reciever_id = '$id' and noti_heading = 'UPVOTE' and is_read = 0 order by date_updated desc";
      $res = mysql_query($query);
      $total_noti = mysql_num_rows($res);?>
      <span class="w3-badge w3-right w3-small w3-green"><?php if ($total_noti >0 ){echo $total_noti;} ?></span><!--upvote notifcation-->
    </a>
    <div class="w3-dropdown-content w3-white w3-card-4">
      <?php
      while ($row = mysql_fetch_array($res)) {
        $noti_id = $row['noti_id'];
        $noti_heading = $row['noti_heading'];
        $noti = $row['noti'];
        $date_updated = time_cal($row['date_updated']);
        $sender_id = $row['sender_id'];
?>
      <form method="post" action="profile.php?id=<?php echo $id?>"><?php //profile.php?id=php echo $id; ?>
        <button type="submit" class="w3-btn w3-theme-d1 w3-padding-large w3-hover-white" value="<?php echo $noti_id?>" name="upvote_noti"><?php echo $noti; ?></button>
      </form>
      <?php }
      ?>
    </div>
  </li>
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
		<div class="w3-col m9">
			<div class="w3-row-padding">
				<div class="w3-col m12">
					<div class="w3-card-2 w3-round w3-white">
						<div class="w3-container w3-padding">
							<div class="w3-row">
								<a href="javascript:void(0)" onclick="openCity(event, 'personal');">
									<div class="w3-col s2 tablink w3-hover-light-grey w3-padding w3-center w3-grey">Personal</div>
								</a>
								<a href="javascript:void(0)" onclick="openCity(event, 'question');">
									<div class="w3-col s2 tablink w3-hover-light-grey w3-padding w3-center">Question</div>
								</a>
								<a href="javascript:void(0)" onclick="openCity(event, 'answer');">
									<div class="w3-col s2 tablink w3-hover-light-grey w3-padding w3-center">Answer</div>
								</a>
								<a href="javascript:void(0)" onclick="openCity(event, 'assignment');">
									<div class="w3-col s2 tablink w3-hover-light-grey w3-padding w3-center">Assignment</div>
								</a>
								<a href="javascript:void(0)" onclick="openCity(event, 'following');">
									<div class="w3-col s2 tablink  w3-hover-light-grey w3-padding w3-center">Follower</div>
								</a>
								<a href="javascript:void(0)" onclick="openCity(event, 'follower');">
									<div class="w3-col s2 tablink  w3-hover-light-grey w3-padding w3-center">Following</div>
								</a>
								<br>
								<hr>
 							<div id="personal" class="page">   <!-- perosnal Info-->
                <div class="w3-container">

                  <table class="w3-table w3-bordered">
                    <tr>
                      <th>Name</th>
                      <td><?php echo $first_name." ".$last_name;?></td>
                    </tr>
                    <tr>
                      <th>E-Mail</th>
                      <td><?php echo $email_id; ?></td>
                    </tr>
                    <tr>
                      <th>Phone No.</th>
                      <td><?php echo $phone_no;?></td>
                    </tr>
                    <tr>
                      <th>Branch</th>
                      <td>CSE</td>
                    </tr>
                  </table>
                </div>
                <br><br>
                <h2>Interests:</h2>
                <div class="w3-container">
                  <?php
                  if ($user_id == $id){?>
                    <form method="post" action="">
                    <table class="w3-table w3-bordered">
                      <?php
                  $query = "SELECT DOMAIN.domain_id FROM DOMAIN JOIN DOMAIN_USER ON DOMAIN_USER.domain_id = DOMAIN.domain_id WHERE DOMAIN_USER.id = '$user_id' and DOMAIN.dept_name = '$dept_name'";
                  $res1 = mysql_query($query);
                  //$row1 = mysql_fetch_array($res1);
                  $domain_user = [];
                  while($row1 = mysql_fetch_assoc($res1)) {
                     $domain_user[] = $row1['domain_id'];
                  }
                  $query = "SELECT domain_id, domain_name FROM domain where dept_name = '$dept_name'";
                  $res = mysql_query($query);
                  while($row = mysql_fetch_array($res)){
                    $domain_id = $row['domain_id'];
                    $domain_name = $row['domain_name'];
                    if (in_array($domain_id, $domain_user)){?>
                      <tr>
                      <td style="width:75%"><?php echo $domain_name;?></td>
                      <td><button type="submit" name="unsubscribe" value="<?php echo $domain_id; ?>" class="w3-btn w3-teal">Unsubscribe</button></td>
                  	</tr>
                  	<?php
                    }
                    else {?>
                      <tr>
                      <td style="width:75%"><?php echo $domain_name;?></td>
                        <td><button type="submit" name="subscribe" value="<?php echo $domain_id; ?>" class="w3-btn w3-teal">Subscribe</button></td>
                  	</tr>
                  	  <?php
                    }
                  }
                  ?>
                    </table>
                    </form>
                <?php  }

                  else{?>

                    <form method="post" action="">
                    <table class="w3-table w3-bordered">
                      <?php
                  $query = "SELECT DOMAIN.domain_id, DOMAIN.domain_name FROM DOMAIN JOIN DOMAIN_USER ON DOMAIN_USER.domain_id = DOMAIN.domain_id WHERE DOMAIN_USER.id = '$user_id' and DOMAIN.dept_name = '$dept_name'";
                  $res = mysql_query($query);
                  while($row = mysql_fetch_array($res)){
                    $domain_id = $row['domain_id'];
                    $domain_name = $row['domain_name'];
              ?>
                      <tr>
                      <td style="width:75%"><?php echo $domain_name;?></td>
                  	</tr>
                  	<?php
                    }
                  ?>
                    </table>
                    </form>

                <?php  }?>

                </div>
                  <?php
                   if (isset($_POST["unsubscribe"])){
                     $domain_id = $_POST["unsubscribe"];
                  $query = "DELETE FROM DOMAIN_USER WHERE id = '$id' AND domain_id = '$domain_id'";
                  mysql_query($query) or die(mysql_error());
                  header("Location: profile.php?id=$user_id");
                   }
                   else if(isset($_POST["subscribe"])){
                     $domain_id = $_POST["subscribe"];
                	 $query = "INSERT INTO DOMAIN_USER(id, domain_id) VALUES ('$id', '$domain_id')";
                  mysql_query($query) or die(mysql_error());
                  header("Location: profile.php?id=$user_id");
                   }
                ?>
							</div>
                            <div id="question" class="page" style="display:none">   <!-- question-->
                              <?php  //QUESTIONS FETCHING IN QUESTIONS TokyoTyrantTable
                                $query = "SELECT QUESTION.qno,QUESTION.question, QUESTION.date_updated, USER.id, USER.first_name, USER.last_name, USER.email_id from QUESTION JOIN USER ON QUESTION.id = USER.id where QUESTION.id = '$user_id' ORDER BY QUESTION.date_updated DESC";
                                $res = mysql_query($query);
                                while($row = mysql_fetch_array($res)){
                                  $qno = $row['qno'];
                                  $question = $row['question'];
                                  $date_updated = $row['date_updated'];
                                  $first_name = $row['first_name'];
                                  $last_name = $row['last_name'];
                                  $email_id = $row['email_id'];
                              // ANSWER FETCHING K LIYE SAME JO AAJ WAHA KARA THA bas qno, question, date updated and id yaha se pass ho jayega
                              ?>
                                 <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
                                 <p> <form action="home.php" method="post">

                                    <img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px">
                                    <span class="w3-right w3-opacity">
                              <?php
                                  echo time_cal($date_updated);
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
                                  echo $question."?";
                              ?>
                                    </p>
                                    <div class="w3-row-padding" style="margin:0 -16px">
                                      <!--<div class="w3-half">
                                      <img src="/" style="width:100%" alt="Image" class="w3-margin-bottom">
                                    </div>-->
                                  </div>
          <?php  //NO OF UPVOTES
          $query = "SELECT DISTINCT * FROM UPVOTE WHERE qno = '$qno'";
          $res3 = mysql_query($query);
          $no_of_upvotes = mysql_num_rows($res3);
          ?>
          <?php  //NO OF ANSWERS
          $query = "SELECT DISTINCT * FROM ANSWER WHERE qno = '$qno'";
          $res5 = mysql_query($query);
          $no_of_answers = mysql_num_rows($res5);
          ?>

                      <button type="submit" value = "<?php echo $qno; ?>" class="w3-btn w3-theme-d1 w3-margin-bottom" name="upvote"><i class="fa fa-thumbs-up"></i><?php echo $no_of_upvotes; ?>UpVote</button>
              <a href="allquestion.php?id=<?php echo $user_id?>&qno=<?php echo $qno?>&question=<?php echo $question?>&date_updated=<?php echo $date_updated?> " style="text-decoration:none;"><button type="button" name="answer" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i><?php echo $no_of_answers;?>Answers</a></button>

              </form>   </div>
          <?php   //ON UPVOTE BUTTON CLICK
          if (isset($_POST['upvote'])) {
            if (($user_id != $id)&&($qno == $_POST['upvote'])) {
              $query = "SELECT DISTINCT * from UPVOTE WHERE id = '$id' and qno = '$qno'";
              $res1 = mysql_query($query);
              $row1 = mysql_fetch_array($res1);
              if (mysql_num_rows($res1) == 0){
                $time = time();
                $query = "INSERT INTO UPVOTE(id, qno) VALUES ($id,$qno)";
                if (mysql_query($query) or die(mysql_error())){
                  $query = "INSERT INTO NOTIFICATION(sender_id, reciever_id, noti_heading, noti, date_updated, qno) VALUES($id, $user_id, 'UPVOTE', 'NOTIFICATION', '$time', $qno)";
                  mysql_query($query) or die(mysql_error());
                  $query = "INSERT INTO QUESTION(id, question, date_updated, domain_id) VALUES($id, '$question', '$time', $domain_id)";
                  mysql_query($query) or die(mysql_error());
                  header("location: home.php");
                }
              }
              else{
                $query = "DELETE FROM UPVOTE WHERE id = '$id' and qno = '$qno'";
                if (mysql_query($query) or die(mysql_error())){
                  $query = "DELETE FROM QUESTION WHERE id = '$id' and question = '$question'";
                  mysql_query($query) or die(mysql_error());
                  header("location: home.php");
                }
              }
            }
          }
          ?>
                              <?php
                                  }
                              ?>
                              <!-- End Middle Column -->
                            </div>
</div>
							</div>
							<div id="answer" class="page" style="display:none">   <!-- answer-->
                <?php  // ANSWER TAB
                  $query = "SELECT QUESTION.qno,QUESTION.question, QUESTION.date_updated, USER.id, USER.first_name, USER.last_name, USER.email_id from ANSWER JOIN QUESTION ON ANSWER.qno = QUESTION.qno JOIN USER ON QUESTION.id = USER.id where ANSWER.id = '$user_id' ORDER BY ANSWER.date_updated DESC";
                  $res = mysql_query($query);
                  while($row = mysql_fetch_array($res)){
                  $user_id1 = $row['id'];
                  $qno = $row['qno'];
                  $question = $row['question'];
                  $date_updated = $row['date_updated'];
                  $first_name = $row['first_name'];
                  $last_name = $row['last_name'];
                  $email_id = $row['email_id'];
                // ANSWER SAME LEKIN US PARTICULAR USER KA LANA H TO KAR SKTA HU LKEIN AGAR SARE LANE H AUR USKA UPAR LANA H TO DKEHNA PADEGA
                ?>
                   <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
                   <p> <form action="home.php" method="post">

                      <img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px">
                      <span class="w3-right w3-opacity">
                <?php
                    echo time_cal($date_updated);
                ?>
                      </span>
                      <h4>
                <?php
                    echo "<a href=\"profile.php?id=$user_id1\">$first_name".' '."$last_name</a>";
                ?>
                      </h4>
                      <hr class="w3-clear">
                      <p>
                <?php
                    echo $question."?";
                ?>
                      </p>
                      <div class="w3-row-padding" style="margin:0 -16px">
                        <!--<div class="w3-half">
                        <img src="/" style="width:100%" alt="Image" class="w3-margin-bottom">
                      </div>-->
                    </div>
                <?php  //NO OF UPVOTES
                $query = "SELECT DISTINCT * FROM UPVOTE WHERE qno = '$qno'";
                $res3 = mysql_query($query);
                $no_of_upvotes = mysql_num_rows($res3);
                ?>
                <?php  //NO OF ANSWERS
                $query = "SELECT DISTINCT * FROM ANSWER WHERE qno = '$qno'";
                $res5 = mysql_query($query);
                $no_of_answers = mysql_num_rows($res5);
                ?>

                <button type="submit" value = "<?php echo $qno; ?>" class="w3-btn w3-theme-d1 w3-margin-bottom" name="upvote"><i class="fa fa-thumbs-up"></i><?php echo $no_of_upvotes; ?>UpVote</button>
                <a href="allquestion.php?id=<?php echo $user_id1?>&qno=<?php echo $qno?>&question=<?php echo $question?>&date_updated=<?php echo $date_updated?> " style="text-decoration:none;"><button type="button" name="answer" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i><?php echo $no_of_answers;?>Answers</a></button>

                </form>   </div>
                <?php   //ON UPVOTE BUTTON CLICK
                if (isset($_POST['upvote'])) {
                if (($user_id != $id)&&($qno == $_POST['upvote'])) {
                $query = "SELECT DISTINCT * from UPVOTE WHERE id = '$id' and qno = '$qno'";
                $res1 = mysql_query($query);
                $row1 = mysql_fetch_array($res1);
                if (mysql_num_rows($res1) == 0){
                $time = time();
                $query = "INSERT INTO UPVOTE(id, qno) VALUES ($id,$qno)";
                if (mysql_query($query) or die(mysql_error())){
                  $query = "select first_name, last_name from user where id = '$id'";
                  $res = mysql_query($query);
                  $row = mysql_fetch_array($res);
                  $first_name = $row['first_name'];
                  $last_name = $row['last_name'];
                  $content = $first_name." ".$last_name." has upvoted your question";
                $query = "INSERT INTO NOTIFICATION(sender_id, reciever_id, noti_heading, noti, date_updated, qno) VALUES($id, $user_id, 'UPVOTE', '$content', '$time', $qno)";
                mysql_query($query) or die(mysql_error());
                $query = "INSERT INTO QUESTION(id, question, date_updated, domain_id) VALUES($id, '$question', '$time', $domain_id)";
                mysql_query($query) or die(mysql_error());
                header("location: home.php");
                }
                }
                else{
                $query = "DELETE FROM UPVOTE WHERE id = '$id' and qno = '$qno'";
                if (mysql_query($query) or die(mysql_error())){
                $query = "DELETE FROM QUESTION WHERE id = '$id' and question = '$question'";
                mysql_query($query) or die(mysql_error());
                header("location: home.php");
                }
                }
                }
                }
                ?>
                <?php
                    }
                ?>
                <!-- End Middle Column -->
                </div>

							</div><!-- end of answer section-->




							<div id="follower" class="page" style="display:none">   <!-- follower-->
<?php
    // fetching FOLLOWER
  $query = "SELECT DISTINCT USER.id,USER.first_name, USER.last_name, USER.email_id, USER.dept_name, USER.teacher_student FROM USER JOIN FOLLOWER ON USER.id = FOLLOWER.follow_id WHERE FOLLOWER.id = '$user_id'";
  $res = mysql_query($query);
  while ($row=mysql_fetch_array($res)) {
    $user_id1 = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email_id = $row['email_id'];
    $dept_name = $row['dept_name'];
    $teacher_student = $row['teacher_student'];   // 0 FOR STUDENT AND 1 FOR TEACHER
?>
<div class="w3-container">
  <table class="w3-table w3-bordered">
    <tr>
      <td style="width:75%;"><img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px"><?php echo "<a href=\"profile.php?id=$user_id1\">$first_name".' '."$last_name</a>";?></td>
    </tr>
  </table>
</div>
<?php }
?>
	</div>



<div id="following" class="page" style="display:none">   <!-- following-->
<?php
    // fetching FOLLOWING
  $query = "SELECT DISTINCT USER.id,USER.first_name, USER.last_name, USER.email_id, USER.dept_name, USER.teacher_student FROM USER JOIN FOLLOWER ON USER.id = FOLLOWER.id WHERE FOLLOWER.follow_id = '$user_id'";
  $res = mysql_query($query);
  while ($row=mysql_fetch_array($res)) {
    $user_id1 = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email_id = $row['email_id'];
    $dept_name = $row['dept_name'];
    $teacher_student = $row['teacher_student'];   // 0 FOR STUDENT AND 1 FOR TEACHER
?>
	<div class="w3-container">
  <table class="w3-table w3-bordered">
    <tr>
      <td style="width:75%;"><img src="Images/avatar2.png" alt="Profile Pic" class="w3-left w3-circle w3-margin-right" style="width:50px"><?php echo "<a href=\"profile.php?id=$user_id1\">$first_name".' '."$last_name</a>";?></td>
    </tr>
  </table>
</div>      <?php } ?>
							</div>

							<!--end of following-->

	<div id="assignment" class="page" style="display:none"> <!-- assignment-->
    <?php
    $query = "SELECT email_id,first_name,last_name,phone_no,dept_name,teacher_student FROM USER WHERE id = '$user_id'";
    $res = mysql_query($query);
    $row=mysql_fetch_array($res);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email_id = $row['email_id'];
    $phone_no = $row['phone_no'];
    $dept_name = $row['dept_name'];
    $teacher_student = $row['teacher_student']; // 0 for student and 1 for teacher..

   if($teacher_student == 0){
    ?>


 <div class="w3-container">
   <?php   //fetching assignment
   $query = "SELECT USER.first_name, USER.last_name, USER.email_id, ASSIGNMENT.assignment_id, ASSIGNMENT.assignment, ASSIGNMENT.date_updated, ASSIGNMENT.file from USER JOIN ASSIGNMENT ON USER.ID = ASSIGNMENT.asking_id WHERE USER.dept_name = ASSIGNMENT.dept_name";
   $res = mysql_query($query);
   ?>
   <table class="w3-table-all">
     <thead>
       <tr class="w3-teal">
         <th>Subject</th>
         <th>By</th>
         <th>File</th>
         <th>Response</th>
       </tr>
     </thead>
     <?php
   while ($row = mysql_fetch_array($res)) {
     $first_name = $row['first_name'];
     $last_name = $row['last_name'];
     $email_id = $row['email_id'];
     $assignment_id = $row['assignment_id'];
     $assignment = $row['assignment'];
     $date_updated = time_cal($row['date_updated']);
     $file = $row['file'];
   ?>

    <tr>
      <td><?php echo $assignment; ?></td>
      <td><?php echo $first_name." ".$last_name; ?></td>
      <td><?php echo "<a href = ".$file."> $file </a>";?></td>
      <td><button onclick="document.getElementById('id02').style.display='block'" class="w3-btn w3-theme-d1">Submit</button></td>
	  <!-- The Modal -->
                    <div id="id02" class="w3-modal">
                      <div class="w3-modal-content">
                        <div class="w3-container">
                          <span onclick="document.getElementById('id02').style.display='none'" class="w3-closebtn">&times;</span>
                              <h5>File Upload</h2>
							  <hr>
                          <form action="profile.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">

						<input class="w3-theme-d1" type="file" name="file" value='file' id='file'>
								<br>
							    <label>Remark(Optional):</label>
                                <textarea class="w3-input w3-border" name="solution" type="text" autocomplete="off"></textarea>
								<br>
								<button class="w3-btn w3-theme-d1 w3-margin-bottom" type="submit" name="submit">Submit</button>
                                  </form>

                                  <?php
                                    if (isset($_POST['submit'])){
                                      $solution = $_POST['solution'];
                                      $time = time();
                                      $file_name = $_FILES['file']['name'];          // IMAGE NAME
                                      $temp_name = $_FILES['file']['tmp_name'];      // TEMPERORY name
                                      $file_type = pathinfo($file_name,PATHINFO_EXTENSION);    //EXTENDION
                                      $target_file = "File/Assignment/Answer/Answer_".$assignment_id."_".$user_id.".".$file_type;   // ASSIGNMENT ANSWERS
                                      $uploadOk = 1;

                                      if(file_exists("$target_file")){    // CHECK IF FILE EXIST THEN DELETE THE PREVIOUS ONE
                                        echo "ONLY ONE FILE IS ALLOWED";
                                        $uploadOk = 0;
                                      }

                                      if ($_FILES["file"]["size"] > 50000000) {   // CHECKING FILE SIZE
                                          echo "Sorry, your file is too large.";
                                          $uploadOk = 0;
                                      }
                                      // Allow certain file formats
                                      if($file_type != "pdf") {   // IMAGE FORMAT RESTRICITON
                                          echo "Sorry, only PDF is allowed.";
                                          $uploadOk = 0;
                                      }
                                      // Check if $uploadOk is set to 0 by an error
                                      if ($uploadOk == 0) {
                                          echo "Sorry, your file was not uploaded.";
                                      // if everything is ok, try to upload file
                                      }
                                      else {
                                        if (move_uploaded_file($temp_name, $target_file)) {    //UPLOADING THE FILE
                                          echo "<a href = ".$target_file."> $file_name </a>";       // DISPLAYING THE FILE
                                          $query = "INSERT INTO SUBMISSION(assignment_id, submitting_id, solution, date_updated, file) values ($assignment_id, $user_id, '$solution', '$time', '$target_file')";
                                          mysql_query($query) or die(mysql_error());
                                        }
                                        else {
                                          echo "Sorry, there was an error uploading your file.";
                                        }
                                      }
                                    }
                                  ?>
                                </div>
                              </div>
                            </div>
	  </tr>
    <?php }?>
  </table>
			</div>
  <?php  }
    else if($teacher_student == 1){
	?>
			<!-- end of the student's assignment section-->
 <!-- teacher's section of assignment-->
 <div class="w3-container">
 <br>
 <button onclick="document.getElementById('id03').style.display='block'" class="w3-btn w3-theme-d1 w3-margin-bottom">Assignment Upload</button>
                    <br>

                    <!-- The Modal -->
                    <div id="id03" class="w3-modal">
                      <div class="w3-modal-content">
                        <div class="w3-container">
                          <span onclick="document.getElementById('id03').style.display='none'"
                          class="w3-closebtn">&times;</span>
                          <div>
                            <div class="w3-container">
                              <h2>Assignment</h2>
                            </div>
                            <form class="w3-container" action="" method="post" enctype="multipart/form-data">
                              <p>
                                <label class=""  style="font-color:black;"><b>Subject :</b></label>
                                <input class="w3-input w3-border" name="assignment" type="text" autocomplete="off"></input>
                              </p>
                              <h6>DEPARTMENT:</h6>
                              <p>
							  <select name="dept_name">
							  <p>
                                <?php
                                  $query = "SELECT dept_name FROM DEPARTMENT";
                                  $res = mysql_query($query);
                                  while($row = mysql_fetch_array($res)):
                                    $dept_name = $row['dept_name'];
                                ?>
                                  <option value="<?php echo $dept_name; ?>">
                                  <?php echo $dept_name; ?></option></p>
                                <?php endwhile ?>
								</select>
              </p>

<input class="w3-theme-d1" type="file" name="file" value='file' id='file'>
                                  <p class="w3-container">
          <button class="w3-btn w3-theme-d1 w3-margin-bottom" type="submit" name="post">Done</button></p>
                                  </form>
                                </div>
<?php
if (isset($_POST['post'])){
  $time = time();
  $assignment = $_POST['assignment'];
  $dept_name = $_POST['dept_name'];
  $file_name = $_FILES['file']['name'];          // IMAGE NAME
  $temp_name = $_FILES['file']['tmp_name'];      // TEMPERORY name
  $file_type = pathinfo($file_name,PATHINFO_EXTENSION);    //EXTENDION
  $target_file = "File/Assignment/Question/Question_".$assignment."_".$time.".".$file_type;   // ASSIGNMENT QUESTIONS
  $uploadOk = 1;

  if(file_exists("$target_file")){    // CHECK IF FILE EXIST THEN DELETE THE PREVIOUS ONE
    echo "ONLY ONE FILE IS ALLOWED";
    $uploadOk = 0;
  }

  if ($_FILES["file"]["size"] > 50000000) {   // CHECKING FILE SIZE
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($file_type != "pdf") {   // IMAGE FORMAT RESTRICITON
      echo "Sorry, only PDF is allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  }
  else {
    if (move_uploaded_file($temp_name, $target_file)) {    //UPLOADING THE FILE
      echo "<a href = ".$target_file."> $file_name </a>";       // DISPLAYING THE FILE
      $query = "INSERT INTO ASSIGNMENT(asking_id, assignment, date_updated, dept_name, file) values ($user_id, '$assignment', '$time', '$dept_name', '$target_file')";
      if (mysql_query($query) or die(mysql_error())){
        $query = "SELECT assignment_id from ASSIGNMENT where file = '$target_file'";
        $res = mysql_query($query);
        $row=mysql_fetch_array($res);
        $assignment_id = $row['assignment_id'];
        $query = "SELECT id FROM USER WHERE dept_name = '$dept_name'";
        $res = mysql_query($query);
        while ($row=mysql_fetch_array($res)) {
          $reciever_id = $row['id'];
          $query = "select first_name, last_name from user where id = '$id'";
          $res = mysql_query($query);
          $row = mysql_fetch_array($res);
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $content = $first_name." ".$last_name." has sent you an assignment";
          $query = "INSERT INTO NOTIFICATION(sender_id, reciever_id, noti_heading, noti, date_updated, assignment_id) values ($user_id, $reciever_id, 'ASSIGNMENT', '$content', '$time', $assignment_id)";
          mysql_query($query) or die(mysql_error());
        }
      }
      else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
}
?>
                              </div>
                              <!-- no1-->
                            </div>
                          </div>
						<!-- section for view submission-->
  <table class="w3-table-all">
      <tr class="w3-teal">
        <th style="width:25%;">Subject</th>
        <th style="width:55%;">File</th>
        <th style="width:25%;">Response</th>
      </tr>
    </table>
    <?php  //fetching submittion
    $query = "SELECT ASSIGNMENT.assignment_id, ASSIGNMENT.assignment, ASSIGNMENT.date_updated, ASSIGNMENT.file from USER JOIN ASSIGNMENT ON USER.ID = ASSIGNMENT.asking_id WHERE USER.id = '$user_id'";
    $res = mysql_query($query);
    while ($row = mysql_fetch_array($res)) {
      $assignment_id = $row['assignment_id'];
      $assignment = $row['assignment'];
      $date_updated = $row['date_updated'];
      $file = $row['file'];
  ?><table class="w3-table-all">
    <tr>
      <td style="width:25%;"><?php echo $assignment; ?></td>
      <td style="width:55%;"><?php echo "<a href = ".$file."> $file </a>";?></td>
      <td style="width:25%;"><a href="allsubmission.php?id=<?php echo $user_id?>&assignment_id=<?php echo $assignment_id?>&assignment=<?php echo $assignment?>&date_updated=<?php echo $date_updated?>&file=<?php echo $file?> " style="text-decoration:none;"><button name = "submission" onclick="document.getElementById('id04').style.display='block'" class="w3-btn w3-theme-d1">View</button></a></td>
	  </tr>
  </table>
<?php }?>
</div>
<?php } ?>

							</div><!-- assignment section end-->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
