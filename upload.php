<?php
session_start();
$id = $_SESSION['idUser'];
if (isset($_POST['submit'])) {
    $file= $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if ($fileSize < 5000000) {
                $fileNameNew = "profile".$id. "." .$fileActualExt;
                $fileDestination = 'uploads/';
                move_uploaded_file($fileTmpName, $fileDestination.$fileNameNew);
                require "includes/dbh.inc.php";
                if($fileActualExt == "png")
                {
                    $results = $conn->query("UPDATE Imgs SET ImgsStatus=1 WHERE ImgsUserId='$id'");
                    header("Location: profile.php?uploadsuccess");
                } elseif($fileActualExt == "jpg"){
                    $results = $conn->query("UPDATE Imgs SET ImgsStatus=2 WHERE ImgsUserId='$id'");
                    header("Location: profile.php?uploadsuccess");
                } elseif($fileActualExt == "jpeg") {
                    $results = $conn->query("UPDATE Imgs SET ImgsStatus=3 WHERE ImgsUserId='$id'");
                    header("Location: profile.php?uploadsuccess");
                }

            } else{
                echo "Your file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }

    } else {
        echo "You cannot upload files of this type";
    }
}