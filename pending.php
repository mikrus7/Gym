<?php
    require 'header.php';
    ?>

    <main>
        <?php  
            if($_SESSION['verifiedUser'] == 0){
                echo"<p>Your application is currently pending please wait for a message from the HR Team</p>";

            }elseif($_SESSION['verifiedUser'] == 1){
                echo"<p>Your application has been denied you can reapply in 3 days. <br> If you do not plan to reapply we will keep your data on our systems for the next 30 days if you'd like you can click the button underneath and we'll delete your data now.</p>";
                ?> <form action="includes/deleteData.inc.php" method="post">
                    <input type="hidden" name="UserId" value="<?php echo $_SESSION['idUser'];?>">
                    <button id=submit type="submit">Delete My Data</button>
                </form>
                <?php
            } else{
                echo"<p>Your application is currently pending please wait for a message from the HR Team</p>";
            }
        
        
        ?>
            
    
    
    </main>
    <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
    require 'footer.php';
    ?>