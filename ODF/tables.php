<?php
//require 'db.php';
function tables(){
  mysql_select_db("discussion_forum") or die(mysql_error());


  // DEPARTMENT
  $query="CREATE TABLE IF NOT EXISTS DEPARTMENT(
    dept_name varchar(255),
    PRIMARY KEY(dept_name)
  )";
  mysql_query($query) or die(mysql_error());

  // DOMAIN
  $query="CREATE TABLE IF NOT EXISTS DOMAIN(
    domain_id bigint(255) AUTO_INCREMENT,
    domain_name varchar(255) NOT NULL UNIQUE,
    dept_name varchar(255),
    PRIMARY KEY(domain_id),
    FOREIGN KEY(dept_name) REFERENCES DEPARTMENT(dept_name) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  // USER TABLE
  $query="CREATE TABLE IF NOT EXISTS USER(
    confirm_code varchar(255),
    id bigint(255) AUTO_INCREMENT,
    email_id varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    first_name varchar(255) NOT NULL,
    last_name varchar(255),
    phone_no bigint(10) UNIQUE,
    dept_name varchar(255),
    teacher_student Boolean,
    profile varchar(255),
    registered Boolean DEFAULT 0,
    PRIMARY KEY(id),
    FOREIGN KEY(dept_name) REFERENCES DEPARTMENT(dept_name) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  // FOLLOWER TABLE
  $query="CREATE TABLE IF NOT EXISTS FOLLOWER(
    id bigint(255),
    follow_id bigint(255),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(follow_id) REFERENCES USER(id) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  // QUEStION TABLE
  $query="CREATE TABLE IF NOT EXISTS QUESTION(
    id bigint(255),
    qno bigint(255) AUTO_INCREMENT,
    question text NOT NULL,
    date_updated bigint(255),
    domain_id bigint(255),
    file varchar(255),
    PRIMARY KEY(qno),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(domain_id) REFERENCES DOMAIN(domain_id) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());


  // ANSWER TABLE
  $query="CREATE TABLE IF NOT EXISTS ANSWER(
    id bigint(255),
    qno bigint(255),
    ano bigint(255) AUTO_INCREMENT,
    answer text NOT NULL,
    date_updated bigint(255),
    file varchar(255),
    PRIMARY KEY(ano),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(qno) REFERENCES QUESTION(qno) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());


  // DOMAIN_USER
  $query="CREATE TABLE IF NOT EXISTS DOMAIN_USER(
    id bigint(255),
    domain_id bigint(255),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(domain_id) REFERENCES DOMAIN(domain_id) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());


  // LIKES
  $query="CREATE TABLE IF NOT EXISTS LIKES(
    id bigint(255),
    ano bigint(255),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(ano) REFERENCES ANSWER(ano) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  //UPVOTE OF QUESTIONS
  $query="CREATE TABLE IF NOT EXISTS UPVOTE(
    id bigint(255),
    qno bigint(255),
    FOREIGN KEY(id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(qno) REFERENCES QUESTION(qno) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  // ASSIGNMENT TABLE
  $query="CREATE TABLE IF NOT EXISTS ASSIGNMENT(
    asking_id bigint(255),
    assignment_id bigint(255) AUTO_INCREMENT,
    assignment varchar(255) NOT NULL UNIQUE,
    date_updated bigint(255),
    dept_name varchar(255),
    file varchar(255),
    PRIMARY KEY(assignment_id),
    FOREIGN KEY(asking_id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(dept_name) REFERENCES DEPARTMENT(dept_name) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  // SUBMISSION TABLE
  $query="CREATE TABLE IF NOT EXISTS SUBMISSION(
    assignment_id bigint(255),
    submitting_id bigint(255),
    solution_id bigint(255) AUTO_INCREMENT,
    solution varchar(255) NOT NULL,
    date_updated bigint(255),
    file varchar(255),
    PRIMARY KEY(solution_id),
    FOREIGN KEY(assignment_id) REFERENCES ASSIGNMENT(assignment_id) ON DELETE CASCADE,
    FOREIGN KEY(submitting_id) REFERENCES USER(id)
  )";
  mysql_query($query) or die(mysql_error());

  // NOTIFICATION TABLE
  $query="CREATE TABLE IF NOT EXISTS NOTIFICATION(
    sender_id bigint(255),
    reciever_id bigint(255),
    noti_id bigint(255) AUTO_INCREMENT,
    noti_heading varchar(255),
    noti varchar(255),
    date_updated bigint(255),
    qno bigint(255),
    ano bigint(255),
    assignment_id bigint(255),
    solution_id bigint(255),
    is_read Boolean DEFAULT 0,
    PRIMARY KEY(noti_id),
    FOREIGN KEY(sender_id) REFERENCES USER(id) ON DELETE CASCADE,
    FOREIGN KEY(reciever_id) REFERENCES USER(id),
    FOREIGN KEY(qno) REFERENCES UPVOTE(qno) ON DELETE CASCADE,
    FOREIGN KEY(ano) REFERENCES LIKES(ano) ON DELETE CASCADE,
    FOREIGN KEY(assignment_id) REFERENCES ASSIGNMENT(assignment_id) ON DELETE CASCADE,
    FOREIGN KEY(solution_id) REFERENCES SUBMISSION(solution_id) ON DELETE CASCADE
  )";
  mysql_query($query) or die(mysql_error());

  //DEPARTMENT INSERTION
  $query = "INSERT INTO DEPARTMENT (dept_name) VALUES ('CSE'),('IT'),('MECHANICAL'),('CIVIL'),('EC')";
  mysql_query($query) or die(mysql_error());

  // DOMAIN INSERTION
  $query = "INSERT INTO DOMAIN (domain_name,dept_name) VALUES ('DS','CSE'),('DAA','CSE'),('DBMS','CSE'),('OS','CSE'),('AUTOMATA','CSE'),('COMPILER','CSE'),('CN','CSE'),('MATHS','CSE'),('C','CSE'),('C++','CSE'),('JAVA','CSE'),('PYTHON','CSE'),('DATA SCIENCE','CSE')";
  mysql_query($query) or die(mysql_error());

  $query = "INSERT INTO USER VALUES ('a',1,'gargvasu96@gmail.com','8fa14cdd754f91cc6554c9e71929cce7','Vasu','Garg',7417320092,'CSE',0,'Images/Profile/Profile_1.png',1)";
  mysql_query($query) or die(mysql_error());


}
 ?>
