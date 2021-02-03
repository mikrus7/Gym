<?php
    require 'dbh.inc.php';
    $output = '';
    if(isset($_POST['submit'])){
        $id = $_POST['event'];
        $user = $_POST['driver'];
        $sql = ('INSERT INTO eventsattendance(eventsAttendanceLinkedId, eventsAttendanceDriverId) VALUES (?,?)');
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            die("error");
            $output .='0';
        }else{
            mysqli_stmt_bind_param($stmt, "ss", $id, $user);
            mysqli_stmt_execute($stmt);
            $output .='1';
        }
    
    echo $output;
    }