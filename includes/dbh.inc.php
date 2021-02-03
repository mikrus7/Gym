<?php

$serverip = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBName = "hub";

$conn = mysqli_connect($serverip, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Connection failed: ".mysqli_connect_error());
}
//6MhP_L-M[Z5+\\



