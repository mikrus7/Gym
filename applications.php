<?php
    if(isset($_POST['submit'])){
    require 'header.php';
    require 'includes/encryption.inc.php';
    ?>
    <main>
        
        <div class="container">
            <table>
                
                <?php
                    require 'includes/dbh.inc.php';
                    $sql = "SELECT * FROM users WHERE isVerified=0";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo 'There was an error with Database please refresh';
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
                                <th>Accept?</th>
                                <th>Deny?</th>
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
                                $firstName = $row["nameUsers"];
                                $surName = $row["surnameUsers"];
                                $Dob = $row["dobUsers"];
                                $firstName = decrypted($firstName,$key);
                                $surName = decrypted($surName,$key);
                                $Dob = decrypted($Dob,$key);
                                echo"<tr><td>" . $row["uNameUsers"] . "</td><td>" . $firstName . "</td><td>" . $surName . "</td><td>" . $Dob . "</td><td>" . $row["mailUsers"] . "</td><td>" . $driverNumber . "</td>";
                                echo"<td>";
                                ?>
                                <form action="includes/accept.inc.php" method="post">
                                    <input type="hidden" name="userId" value="<?php echo $row['idUsers']; ?>">
                                    <button type="submit" name="accept-submit">Accept</button>
                                    </form><?php echo '</td><td>'; ?><form action="includes/deny.inc.php" method="post">
                                    <input type="hidden" name="userId" value="<?php echo $row['idUsers'];?>">
                                    <button type="submit" name="deny-submit">Deny</button></form><?php echo' </td></tr> ' ;
                                
                            }
                            
                        }else{
                            echo "No User applications found";
                        }
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                ?>
                            </tbody>
            </table>
        </div>

    </main>
        <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
        require 'footer.php';
                }else{
                    header("location: index.php?error");
                    exit();
                }
        ?>