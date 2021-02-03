<?php
    session_start();
    error_reporting(0);
    include_once 'includes/dbh.inc.php';
    ?>
<!DOCTYPE html>    
<html lang="en">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- TITLE AND STUFFS -->
            <title>Iron Wolf Gym</title>

        <!-- FAVION -->
            <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
        <!-- STYLE -->
            <link rel="stylesheet" href="css/main.css">
        <!--bootstrap-->
        <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            
            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="js/jquery.min.js"></script>
            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- FONT AWESOME -->
            <link rel="stylesheet" href="css/all.css">
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <!-- FONTS -->
            <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <body>
        <nav>
            <input type="checkbox" id="hCheck">
            <label for="hCheck">
                <i class="fas fa-bars" id="hBtn"></i>
                <i class="fas fa-times" id="hCancel"></i>
            </label>
            <a href="index.php"><img src="assets/img/headerlogo.png"></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <?php 
                    if($_SESSION['levelUser'] > 0){
                        if(($_SESSION['levelUser'] >= 1) && ($_SESSION['levelUser'] < 7)){
                            echo '<li><a href="modPanel.php">Moderator Panel</a></li>';
                        }if(($_SESSION['levelUser'] == 2)){
                            echo '<li><a href="eventsPanel.php">Events Panel</a></li>';
                        }elseif($_SESSION['levelUser'] == 3){
                            echo '<li><a href="hrPanel.php">HR Panel</a></li>';
                        }elseif($_SESSION['levelUser'] == 4){
                            echo '<li><a href="mediaPanel.php">Media Panel</a></li>';
                        }elseif($_SESSION['levelUser'] == 6 or $_SESSION['levelUser'] == 5){
                            echo '<li><a href="adminMPanel.php">Management Panel</a></li>';
                        }elseif($_SESSION['levelUser'] >= 7){
                            echo '<li><a href="adminMPanel.php">High Management Panel</a></li>'; 
                        }
                    }
                    if(isset($_SESSION["idUser"])){
                        ?>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="includes/signout.inc.php">Log Out</a></li>
                    <?php
                    
                    }else{
                        ?> <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Register</a></li>
                    <?php
                    }
                    
                ?>
            </ul>
        </nav> 