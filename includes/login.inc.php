<?php
    if(isset($_POST["login"])){
        require 'dbh.inc.php';
        require 'encryption.inc.php';
        $user = $_POST["loginType"];
        $pwd = $_POST["pwd"];
        $remember = $_POST["remember"];

        $sql = "SELECT * FROM users WHERE uNameUsers=? OR mailUsers=? OR dNumUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../login.php?error=024" . mysqli_stmt_errno($stmt));
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sss", $user, $user, $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($pwd, $row['pwdUsers']);
                if($pwdCheck == false){
                    header("location: ../login.php?error=incorrectPassword");
                    exit();
                }elseif($pwdCheck == true){
                    session_start();

                    $_SESSION['idUser'] = $row['idUsers'];
                    $_SESSION['nameUser'] = decrypted($row['nameUsers'], $key);
                    $_SESSION['surnameUser'] = decrypted($row['surnameUsers'], $key);
                    $_SESSION['dobUser'] = decrypted($row['dobUsers'], $key);
                    $_SESSION['uNameUser'] = $row['uNameUsers'];
                    $_SESSION['mailUser'] = $row['mailUsers'];
                    $_SESSION['dNumUser'] = $row['dNumUsers'];
                    $_SESSION['levelUser'] = $row['isAdminUsers'];
                    $_SESSION['verifiedUser'] = $row['isVerified'];
                    if ($row['isVerified'] < 3){
                        if($row['isVerified'] == 0){
                            header("Location: ../pending.php?login=0");
                        }elseif($row['isVerified'] == 1){
                            header("Location: ../pending.php?login=1");
                        }elseif($row['isVerified'] == 2){
                            header("Location: ../banned.php?login=2");
                        }
                    }
                    elseif($row['isVerified'] == 3){
                    header("location: ../index.php?login=success");
                    exit();
                    }
                }else{
                    header("location: ../login.php?error=incorrectPassword");
                    exit();
                }
            }else{
                header("Location: ../login.php?error=noUser");
                exit();
            }
        }
    }else{
        header("location: ../login.php?invalid");
    }