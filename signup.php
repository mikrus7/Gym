<?php
    require 'header.php';
    ?>

    <main>
    
        
            <form action="includes/register.inc.php" method="post">
            <div class="login-box">
                <h1>Register</h1>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="userName" placeholder="First Name" required>
                </div>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="userSurname" placeholder="Surname" required>
                </div>
                <div class="textbox">
                    <i class="fa fa-calendar-day" aria-hidden="true"></i>
                        <input type="date" name="userDob" placeholder="Date of Birth" required>
                </div>
                <div class="textbox">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="userMail" placeholder="Email"required>
                </div>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="userDNum" placeholder="Member ID/Locker Pin" required>
                    </div>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" name="userUName" placeholder="Username" required>
                </div>
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="userPwd" placeholder="Password" required>
                </div>
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="userCPwd" placeholder="Confirm Password" required>
                </div>  
               <p>Do you agree to the <a href="tos.php" target="_blank">Terms and Conditions</a> set by IWG? <input type="checkbox" id="userTosAgree" required></p>
               <button class="button" type="submit" name="signup-submit">Signup</button>
            </div>
            </form>


        
    
    </main>

    <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php   
    require 'footer.php';
?>