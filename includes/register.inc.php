<?php
    if(isset($_POST["signup-submit"])){
        require 'dbh.inc.php';
        require 'encryption.inc.php';
        $userName = $_POST['userName'];
        $userSurname = $_POST['userSurname'];
        $userDob = $_POST['userDob'];
        $userMail = $_POST['userMail'];
        $userUName = $_POST['userUName'];
        $userDNum = $_POST['userDNum'];
        $userPwd = $_POST['userPwd'];
        $userCPwd = $_POST['userCPwd'];

        if(!filter_var($userMail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userUName)){
            header("Location: ../signup.php?error=invalidEmailUid");
            exit();
          }
        if(!filter_var($userMail, FILTER_VALIDATE_EMAIL)){
          header("Location: ../signup.php?error=invalidEmail&uid");
          exit();
        }
        if(!preg_match("/^[a-zA-Z0-9]*$/", $userUName)){
          header("Location: ../signup.php?error=invalidUsername");
          exit();
        }
        if(!preg_match("/^[a-zA-Z]*$/", $userName) or !preg_match("/^[a-zA-Z]*$/", $userSurname)){
          header("Location: ../signup.php?error=invalidNames");
          exit();
        }
        if ($userPwd !== $userCPwd){
          header("Location: ../signup.php?error=passwordCheck");
          exit();
        }
        if (strlen($userPwd) < 8){
          header("Location: ../signup.php?error=passwordTooShort");
          exit();
        }
        if($userDNum > 999){
          header("Location: ../signup.php?error=memberNumberTooLong");
          exit();
        }
     
        $userName = encryption($userName, $key);
        $userSurname = encryption($userSurname, $key);
        $userDob = encryption($userDob, $key);

        $sql = "SELECT * FROM users WHERE uNameUsers=? OR mailUsers=? OR dNumUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=024&" . mysqli_stmt_error($stmt));
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sss", $userUName, $userMail, $userDNum);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            if($userUName == $row['uNameUsers']){
                header("Location: ../signup.php?error=usernameTaken");
                exit();
            }elseif($userMail == $row['mailUsers']){
                header("location: ../signup.php?error=mailTaken");
                exit();
            }elseif($userDNum == $row['dNumUsers']){
                header("Location: ../signup.php?error=driverNumberTaken");
                exit();
            }else{
                $sql = "INSERT INTO users (nameUsers, surnameUsers, dobUsers, uNameUsers, mailUsers, dNumUsers, pwdUsers) VALUES (?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=025&" . mysqli_stmt_errno($stmt));
                    exit();
                }else{
                    $hashedPwd = password_hash($userPwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssssss", $userName, $userSurname, $userDob, $userUName, $userMail, $userDNum, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    $sql = "SELECT * FROM users WHERE mailUsers='$userMail'";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=026&" . mysqli_stmt_errno($stmt));
                        exit();
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $imageId = $row['idUsers'];
                    $sql = "INSERT INTO Imgs(ImgsUserId) VALUES ('$imageId')";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../signup.php?error=027&" . mysqli_stmt_errno($stmt));
                            exit();
                        } else {
                            mysqli_stmt_execute($stmt);
                            header("Location: ../pending.php?application=pending");
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                        }
                    }
                }
            }
        }


    }else{
        header("Location: ../../index.php?invalid");
        exit();
    }