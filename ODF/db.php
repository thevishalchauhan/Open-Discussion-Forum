<?php
require 'tables.php';
// Connect to MySQL
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
// Make discussion_forum the current database
$db_selected = mysql_select_db('discussion_forum', $link);
if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.
  $sql = 'CREATE DATABASE discussion_forum';
  if (mysql_query($sql, $link)) {
      tables();  // create all tables in the Database
  } else {
      echo 'Error creating database: ' . mysql_error() . "\n";
  }
}
?>
