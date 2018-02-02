<?php
  require 'must.php';
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Interest</title>
  <meta charset="utf-8">
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="CSS/w3css1.css">
  <link rel="stylesheet" href="CSS/w3theme.css">
  <style>
    .block{
      margin:4% 35%;
    }
  </style>
  <body>
    <form class="w3-container w3-card-4 block" action="" method="POST">
      <h2>Interest</h2>
      <hr>
       <?php
          $query = "SELECT dept_name FROM USER WHERE ID = '$id'";
          $res = mysql_query($query);
          $row=mysql_fetch_array($res);
          $dept_name = $row['dept_name'];
          $query = "SELECT domain_id, domain_name FROM domain WHERE dept_name = '$dept_name'";
          $res = mysql_query($query);
          while($row = mysql_fetch_array($res)):
            $domain_id = $row['domain_id'];
            $domain_name = $row['domain_name'];
          ?>
      <p>
      <input class="w3-check" type="checkbox" name="check_list[]" value="<?php echo $domain_id; ?>">
      <label class="w3-validate"><?php echo $domain_name; ?></label>
      </p>
       <?php endwhile ?>
      <hr>
      <input class="w3-btn w3-theme-d1 w3-margin-bottom" name="Select" type="submit" value="Select"/>
    </form>

  </body>
</html>
<?php
  if(isset($_POST['Select'])){
    if(!empty($_POST['check_list'])) {
      foreach($_POST['check_list'] as $domain_id) {
        $query = "INSERT INTO domain_user(id, domain_id) VALUES ('$id','$domain_id')";
        if (mysql_query($query) or die(mysql_error("ERROR ENTERING RECORD"))){
          header("Location: home.php");
        }
      }
    }
    else{
      echo "<b>Please Select Atleast One Option.</b>";
    }
  }

 ?>
