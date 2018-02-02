<?php
  function time_cal($dat_day){  // CONVERT TIME INTO UPDATES
    $today = time();
    $diff = $today-$dat_day;
    $minutes = floor($diff / (60));
    $hours = floor($diff / (60*60));
    $days = floor($diff / (60*60*24));
    $months = floor($diff / (60*60*24*30));
    $years = floor($diff / (60*60*24*30*365));
    if ($years > 0){
      return $years. " years ago ";
    }
    elseif ($months > 0){
      return  $months." months ago ";
    }
    elseif ($days > 0){
      return  $days." days ago ";
    }
    elseif ($hours > 0){
      return $hours." hours ago ";
    }
    elseif ($minutes > 0){
      return  $minutes." minutes ago ";
    }
    else {
      return $diff." seconds ago";
    }
  }

  function sendmail($email_id,$subject,$Body){   // SEND MAILS
    require_once('/PHPMailer-master/class.phpmailer.php');
    $mail = new PHPMailer;
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'shekharr0143@gmail.com';          // SMTP username
    $mail->Password = '9927314236'; // SMTP password
    $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                          // TCP port to connect to

    $mail->setFrom('shekharr0143@gmail.com', 'ODF');
    $mail->addReplyTo('shekharr0143@gmail.com', 'ODF');
    $mail->addAddress($email_id);   // Add a recipient
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    $mail->Body = $Body;
    $mail->Subject = $subject;
    $mail->isHTML(true);  // Set email format to HTML
    //$mail->addAttachment('/var/tmp/file.tar.gz');
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else {
        return True;
    }
  }

?>
