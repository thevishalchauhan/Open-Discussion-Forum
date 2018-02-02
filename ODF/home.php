<?php
  require_once 'must.php';
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

      <!-- Navbar -->
      <div class="w3-top">
        <ul class="w3-navbar w3-theme-d2 w3-left-align w3-large">
          <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
            <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
          </li>
          <li>
            <a href="home.php" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>ODF</a>
          </li>
          <!--<li class="w3-hide-small">
            <a href="#" class="w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
          </li>-->
          <li class="w3-hide-small w3-dropdown-hover">
            <a href="#" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i>
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
          <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card-2 w3-round w3-white">
              <div class="w3-container">
                <h4 class="w3-center"><a href="profile.php?id=<?php echo $id; ?>" style="text-decoration:none;">My Profile</a></h4>
                <p class="w3-center"><a href="profile.php?id=<?php echo $id; ?>" style="text-decoration:none;"><img src="Images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></a></p>
                <hr>

                <?php
                  $query = "SELECT email_id,first_name,last_name,phone_no,dept_name,profile FROM USER WHERE id = '$id'";
                  $res = mysql_query($query);
                  $row=mysql_fetch_array($res);
                  $first_name = $row['first_name'];
                  $last_name = $row['last_name'];
                  $email_id = $row['email_id'];
                  $phone_no = $row['phone_no'];
                  $dept_name = $row['dept_name'];
                  $profile = $row['profile'];
                ?>
                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $first_name." ".$last_name; ?></p>
                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $dept_name; ?></p>
              </div>
            </div>
            <br>


            <!-- End Left Column -->
          </div>

          <!-- Middle Column -->
          <div class="w3-col m7">

            <div class="w3-row-padding">
              <div class="w3-col m12">
                <div class="w3-card-2 w3-round w3-white">
                  <div class="w3-container w3-padding">
                    <h6 class="w3-opacity">Open Discussion Forum</h6>
                    <!--changes No1-->
                    <!-- Trigger/Open the Modal -->
                    <button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-theme-d1 w3-margin-bottom">Ask Question</button>
                    <br>

                    <!-- The Modal -->
                    <div id="id01" class="w3-modal">
                      <div class="w3-modal-content">
                        <div class="w3-container">
                          <span onclick="document.getElementById('id01').style.display='none'"
                          class="w3-closebtn">&times;</span>
                          <div>
                            <div class="w3-container">
                              <h2>Ask Question</h2>
                            </div>
                            <form class="w3-container" action="" method="post">
                              <p>
                                <label class="" style="font-color:black;"><b>Question</b></label>
                                <textarea class="w3-input w3-border" name="question" type="text" autocomplete="off"></textarea>
                              </p>
                              <h4>Related To:</h4>
                              <p>
                                <select name="domain_name">
                							  <p>
                                                  <option name="none" value="0">  NOT SURE </option>
                                                <?php
                                                  $query = "SELECT domain_id, domain_name FROM domain WHERE dept_name = '$dept_name'";
                                                  $res = mysql_query($query);
                                                  while($row = mysql_fetch_array($res)):
                                                    $domain_id = $row['domain_id'];
                                                    $domain_name = $row['domain_name'];
                                                ?>
                                                  <option value="<?php echo $domain_id; ?>">
                                                  <?php echo $domain_name; ?></option></p>
                                                <?php endwhile ?>
                								</select>
                                                  <p>
                                                    <button class="w3-btn w3-theme-d1 w3-margin-bottom" type="submit" name="post">Done</button></p>
                                                  </form>
                                <?php
                                  if (isset($_POST['post'])){
                                    $domain_id =$_POST['domain_name'];
                                    $question = $_POST['question'];
                                    $date_updated = time();
                                    if ($domain_id != 0){
                                      $query = "INSERT INTO QUESTION(id, question, date_updated, domain_id) VALUES ($id, '$question', $date_updated, $domain_id)";
                                      mysql_query($query) or die(mysql_error("ERROR ENTERING RECORD"));
                                    }
                                    else {
                                      $query = "INSERT INTO QUESTION(id, question, date_updated) VALUES ($id, '$question', $date_updated)";
                                      mysql_query($query) or die(mysql_error("ERROR ENTERING RECORD"));
                                    }

                                  }
                                ?>
                                </div>

                              </div>
                              <!-- no1-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                        // QUESTIONS DATA FETCHING
                        $query = "SELECT QUESTION.qno,QUESTION.question, QUESTION.date_updated, DOMAIN.domain_name, DOMAIN.domain_id FROM DOMAIN JOIN DOMAIN_USER ON DOMAIN.domain_id = DOMAIN_USER.domain_id RIGHT JOIN QUESTION ON DOMAIN.domain_id = QUESTION.domain_id WHERE DOMAIN_USER.id = '$id'";
                        $res = mysql_query($query);
                        while($row = mysql_fetch_array($res)){
                          $qno = $row['qno'];
                          $question = $row['question'];
                          $date_updated = $row['date_updated'];
                          $domain_name = $row['domain_name'];
                          $domain_id = $row['domain_id'];
                          $query = "SELECT USER.id, USER.first_name, USER.last_name, USER.email_id, USER.dept_name FROM USER JOIN QUESTION ON QUESTION.id = USER.id WHERE QUESTION.qno = '$qno'";
                          $res2 = mysql_query($query);
                          $row2 = mysql_fetch_array($res2);
                          $user_id = $row2['id'];
                          $first_name = $row2['first_name'];
                          $last_name = $row2['last_name'];
                          $dept_name = $row2['dept_name'];
                          $email_id = $row2['email_id'];
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
			<a href="allquestion.php?id=<?php echo $user_id?>&qno=<?php echo $qno?>&question=<?php echo $question?>&date_updated=<?php echo $date_updated?>" style="text-decoration:none;"><button type="button" name="answer" class="w3-btn w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i><?php echo $no_of_answers;?>Answers</a></button>

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


                    <!-- End Grid -->
                  </div>

                  <!-- End Page Container -->
                </div>
                <br>
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
              </script>

  </body>
  </html>
