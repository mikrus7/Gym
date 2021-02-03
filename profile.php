<?php
require "header.php";
if(isset($_SESSION['idUser'])) {
    $firstName = $_SESSION['nameUser'];
    $sureName = $_SESSION['surnameUser'];
    $memberId = $_SESSION['dNumUser'];
    $id = $_SESSION['idUser'];
require "includes/dbh.inc.php";
$result = $conn->query("SELECT * FROM Imgs WHERE ImgsUserId='$id'");
if($result->num_rows>0){

while ($row = mysqli_fetch_assoc($result)) {

    echo "<div class='profile'>";
    if ($row['imgsStatus'] == 1) {

        echo "<img src='uploads/profile" . $id . ".png'>";
    } elseif($row['imgsStatus'] == 2) {
        echo "<img src='uploads/profile" . $id . ".jpg'>";
    } elseif($row['imgsStatus'] == 3) {
        echo "<img src='uploads/profile" . $id . ".jpeg'>";
    } elseif($row['imgsStatus'] == 0){
        echo "<img src='uploads/profiledefault.jpg'>";
    }

    echo "<p>".$firstName. " " .$sureName."<br>";
    echo "Member ID: ". $memberId."</p>";

}}
else {
    echo "no rows found";
}
    ?>
   <form action='upload.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='file'>
        <button type='submit' name='submit' class="button">Upload</button>
   </form>
</div>
    <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
    require "footer.php";
    }
    else{
    header("Location: login.php");
    }
    ?>