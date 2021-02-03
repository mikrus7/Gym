<?php
if(isset($_POST["pwrequest-submit"])){
  require 'dbh.inc.php';
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);
  $url = "http://hub.quantumgaminggroup.co.uk/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
  $expires = date("U") + 1800;
  $userEmail = $_POST["mail"];

  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    die("There was an error, delete error");
    }
  else{
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }
  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires, pwdResetUrl) VALUES (?, ?, ?,?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    die("There was an error, insert error");
    }
  else{
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $userEmail, $selector, $hashedToken, $expires, $url);
    mysqli_stmt_execute($stmt);
    
    $to = $userEmail;

    $subject = 'Reset your password for Quantum Hub';

    $message = 'We received a password reset request. The link to reset your password is down below.
    if you did not make this request. You can ignore this email. However if you feel like your password
    is not secure enough you may reset your password either by the link below or in your user panel.';

    $message .= 'Please click the link here to reset your password: ';
    $message .= "<a href=" . $url . "</a>";

    $headers = "From: noreply@quantumgaminggroup.co.uk";
    $headers .= "Reply to: support@quantumgaminggroup.co.uk";
    $headers .= "Content-type: text/html\r\n";
    

    mail($to, $subject, $message, $headers); 
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header("Location: ../forgot-password.php?reset=success");
  }
}
else{
  header("Location: ../index.php?falseentry");
}
