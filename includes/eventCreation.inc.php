<?php
    if(isset($_POST['submit'])){
        require 'dbh.inc.php';
        $EDI = $_POST["eventDriverId"];
        $ETI = $_POST["eventTitle"];
        $ED = $_POST["eventDate"];
        $ET = $_POST["eventTime"];
        $ES = $_POST["eventStart"];
        $EE = $_POST["eventEnd"];
        $EI = $_POST["eventInfo"];
        $sql = "INSERT INTO events(eventsTitle, eventsCreatedById, eventsDate, eventsTime, eventsStart, eventsEnd, eventsInfo) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?stmtError");
        }else{
            mysqli_stmt_bind_param($stmt, "sssssss", $ETI, $EDI, $ED, $ET, $ES, $EE, $EI);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../createEvent.php?event=created");
            exit();
        }
    }else{
        header("location: ../index.php?error");
        exit();
    }