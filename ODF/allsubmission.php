<?php require 'must.php';
if ($_GET['id']!=$id){
  $user_id = $_GET['id'];
}
else {
  $user_id = $id;
}
$assignment_id = $_GET['assignment_id'];
$assignment = $_GET['assignment'];
$date_updated1 = $_GET['date_updated'];
$file1 = $_GET['file'];
?>
<?php
$query = "SELECT USER.id, USER.first_name, USER.last_name, SUBMISSION.solution_id, SUBMISSION.solution, SUBMISSION.date_updated, SUBMISSION.file from SUBMISSION JOIN ASSIGNMENT ON SUBMISSION.assignment_id = ASSIGNMENT.assignment_id JOIN USER ON USER.ID = SUBMISSION.submitting_id where SUBMISSION.assignment_id = '$assignment_id'";
$res1 = mysql_query($query);
while ($row1 = mysql_fetch_array($res1)) {
  $user_id1 = $row1['id'];
  $first_name = $row1['first_name'];
  $last_name = $row1['last_name'];
  $solution_id = $row1['solution_id'];
  $solution = $row1['solution'];
  $date_updated = time_cal($row1['date_updated']);
  $file = $row1['file'];
  echo $first_name." ".$last_name."<br>";
  echo $solution_id."<br>";
  echo $solution."<br>";
  echo $file."<br>";
  echo "<br><br>";
}

?>
