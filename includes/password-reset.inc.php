<?php
if (isset($_POST["reset-password-submit"])){
  require 'dbh.inc.php';
  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordConfirm = $_POST["pwdConfirm"];
  $currentDate = date("U");
  if(empty($password) or empty($passwordConfirm)){
    header("Location: ../create-new-password.php?selector=".$selector."&validator=".$token);
    exit();
  }
  elseif($password != $passwordConfirm){
    header("Location: ../create-new-password.php?selector=".$selector."&validator=".$token);
    exit();
  }

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    die("There was an error, Invalid Request or Request Timed out");
  }
  else{
    mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)){
      die("Request is invalid please re-submit request");
    }
    else{
      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
      if($tokenCheck === false){
        die("Request is invalid please re-submit request");
      }
      elseif($tokenCheck === true){
        $tokenEmail = $row['pwdResetEmail'];
        $sql = "SELECT * FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          die("There was an error invalid request");
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($result)){
            die("Request is invalid please re-submit request");
          }
          else{
            $sql="UPDATE users SET pwdUsers=? WHERE mailUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
              die("There was an error invalid request");
            }
            else{
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $tokenEmail);
              mysqli_stmt_execute($stmt);
              $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)){
                die("There was an error, delete error");
              }
              else{
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
              }
              mysqli_stmt_close($stmt);
              mysqli_close($conn);
              header("Location: ../login.php?passwordReset=success");
              exit();
            }
          }
        }
      }
      else{
        die("Request is invalid please re-submit request");
      }
    }
  }

}
else{
  header("Location: ../index.php?error");
}
