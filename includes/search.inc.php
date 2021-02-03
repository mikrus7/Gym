<?php
    require 'dbh.inc.php';
    require 'encryption.inc.php';
    session_start();
    $output = '';

    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $stmt=$conn->prepare("SELECT * FROM users WHERE uNameUsers LIKE CONCAT('%',?,'%') OR mailUsers LIKE CONCAT('%',?,'%') OR dNumUsers LIKE CONCAT('%',?,'%')");
        $stmt->bind_param("sss", $search,$search,$search);

    }else{
        $stmt=$conn->prepare("SELECT * FROM users");

    }
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $output = "<thead>
                    <tr>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Email</th>
                        <th>Member ID</th>
                        <th>User Level</th>
                    ";
                    if($_SESSION['levelUser'] > 5){
                        $output .='<th>Ban</th>';
                    }
                    $output .="</tr></thead><tbody>";
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
                            $userRank = "Driver";                                    
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
                            $userRank = "Driver";
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
                        $output .="<tr><td>" . $row["uNameUsers"] . "</td>
                                        <td>" . $firstName . "</td>
                                        <td>" . $surName . "</td>
                                        <td>" . $Dob . "</td><td>" . $row["mailUsers"] . "</td>
                                        <td>" . $driverNumber . "</td>
                                        <td>" . $driverNumber . "</td>";
                                        if($_SESSION["levelUser"] < $row['isAdminUsers']){
                                            $output .= "</tr>";
                                        }
                                        elseif ($_SESSION["idUser"] == $row["idUsers"]){
                                            $output .='</tr>';
                                        }elseif($_SESSION["levelUser"] > 5){
                                            $output .= "<td>";
                                            $output .="<form action='includes/ban.inc.php' method='post'>
                                                <input type='hidden' name='userId' value=" . $row['idUsers'] . ">
                                                <button type='submit' name='ban-submit'>Ban</button>
                                            </form></td></tr>";
                                        }else{
                                            $output .='</tr>';
                                        }
                                        $output .="</tbody>";
                                        echo $output;


                                        
    }
}else{
        echo "<h3>No Record Found</h3>";
    }

/*     Notice: Undefined index: eventsId in C:\xampp\htdocs\public_html\version2.0\qggwebsite\hub\functions.php on line 219

Notice: Trying to access array offset on value of type null in C:\xampp\htdocs\public_html\version2.0\qggwebsite\hub\functions.php on line 222

Notice: Undefined variable: _SESSION in C:\xampp\htdocs\public_html\version2.0\qggwebsite\hub\functions.php on line 222

Notice: Trying to access array offset on value of type null in C:\xampp\htdocs\public_html\version2.0\qggwebsite\hub\functions.php on line 222 */