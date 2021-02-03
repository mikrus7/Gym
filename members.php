<?php
    if(isset($_POST['submit'])){
        require 'header.php';
        require 'includes/encryption.inc.php';
    ?>
    <main> 
    <div class="form-inline">
            <label for="search" class="font-weight-bold lead text-white">
            Search Record:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="search" id="search_text" class="
            form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
        </div>
    <div class="container"> 
      <table class="table table-hover table-light table-striped" id="table-data">
      <?php
        require 'includes/dbh.inc.php';
        $sql = "SELECT * FROM users WHERE isVerified=3";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "There was an error with the database please refresh the page";
        }else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($result-> num_rows > 0){
                ?>
                <thead>
                <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date Of Birth</th>
                                <th>Email</th>
                                <th>Member ID</th>
                                <th>User Level</th>
                            <?php
                                if($_SESSION['levelUser'] > 5){
                                    echo  '<th>Ban</th>';
                                    
                                }
                                
                            ?>
                </tr>
                            
                </thead>
                <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)){
                                if($row["dNumUsers"] < 10 ){
                                    $driverNumber = "00".$row["dNumUsers"];
                                }
                                elseif($row["dNumUsers"] < 100 ){
                                    $driverNumber = "0".$row["dNumUsers"];
                                }
                                else{
                                    $driverNumber = $row["dNumUsers"];
                                }
                                if($row["isAdminUsers"] == 0){
                                    $userRank = "Member";
                                }elseif($row["isAdminUsers"] == 1){
                                    $userRank = "Staff"; 
                                }elseif($row["isAdminUsers"] == 2){
                                    $userRank = "Events Team"; 
                                }elseif($row["isAdminUsers"] == 3){
                                    $userRank = "HR Team"; 
                                }elseif($row["isAdminUsers"] == 4){
                                    $userRank = "Media Team"; 
                                }elseif($row["isAdminUsers"] == 5 or $row["isAdminUsers"] == 6){
                                    $userRank = "Managers"; 
                                }elseif($row["isAdminUsers"] == 7){
                                    $userRank = "High Management"; 
                                }elseif($row["isAdminUsers"] == 8){
                                    $userRank = "Development"; 
                                }else{
                                    $userRank = "Member";
                                }
                                if($_SESSION['levelUser'] > 5){
                                    $firstName = $row["nameUsers"];
                                    $surName = $row["surnameUsers"];
                                    $Dob = $row["dobUsers"];
                                    $firstName = decrypted($firstName,$key);
                                    $surName = decrypted($surName,$key);
                                    $Dob = decrypted($Dob,$key);
                                }else{
                                    $firstName = "Classified";
                                    $surName = "Classified";
                                    $Dob = "Classified";
                                }
                                echo"<tr><td>" . $row["uNameUsers"] . "</td><td>" . $firstName . "</td><td>" . $surName . "</td><td>" . $Dob . "</td><td>" . $row["mailUsers"] . "</td><td>" . $driverNumber . "</td>";
                                echo"<td>" . $userRank . "</td>";
                                if($_SESSION["levelUser"] < $row['isAdminUsers']){
                                    echo'</tr>';
                                }elseif ($_SESSION["idUser"] == $row["idUsers"]){
                                    echo'</tr>';
                                }elseif($_SESSION["levelUser"] > 5){
                                    echo "<td>";?>
                                    <form action="includes/ban.inc.php" method="post">
                                        <input type="hidden" name="userId" value="<?php echo $row['idUsers']; ?>">
                                        <button type="submit" name="ban-submit">Ban</button>
                                    </form><?php echo '</td></tr>';
                                }else{
                                    echo'</tr>';
                                }
                                
                                
                            }
                            ?>
                            
                            <?php
                            
            }else{
                echo "No Users found";
            }
        }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                ?>
                </tbody>    
      </table>
    </div>
    </main>
    <script type="text/javascript">
            $(document).ready(function(){
                $("#search_text").keyup(function(){
                    var search = $(this).val();
                    $.ajax({
                        url:'includes/search.inc.php',
                        method: 'post',
                        data:{query:search},
                        success:function(response){
                            $("#table-data").html(response);
                        }
                    })
                })
            });
        </script>

        <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
        require 'footer.php';
    }else{
        header("location: index.php?error");
        exit();
    }