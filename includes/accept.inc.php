<?php
    require 'dbh.inc.php';
    if(isset($_POST['accept-submit'])){
        $user = $_POST['userId'];
        $sql = "UPDATE users SET isVerified = 3 WHERE idUsers= $user";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../hrPanel.php?Success=userAccepted");
            exit();
        }
    }else{
        header("Location: ../index.php?error");
        exit();
    }