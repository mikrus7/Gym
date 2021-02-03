<?php
    require 'header.php';

    ?>

    <main>
    
    <form action="includes/login.inc.php" method="post">
        <div class="login-box">
            <h1>Login</h1>
 
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username"
                         name="loginType" value="">
            </div>
 
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password"
                         name="pwd" value="">
            </div>
 
            <input class="button" type="submit"
                     name="login" value="Sign In">

    </form>
        <form action="forgot-password.php" method="POST">
            <input class="button" type="submit"
                   name="login" value="Forgot Password"></form>
    </div>
    
    </main>

    <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php   
    require 'footer.php';
    ?>