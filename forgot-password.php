<?php
  require "header.php";
?>

  <main>
    <div class="login-box">
    <form action="includes/reset-request.inc.php" method="post">
    <h1>Forgot Password</h1>
    <h2 class="admin">An admin will contact you with instructions on how to reset your password (May take upto 24 hours).</h2>
      <div class="textbox"><i class="fa fa-lock" aria-hidden="true"></i><input type="text" name="mail" placeholder="Enter your e-mail"></div><button type="submit" name="pwrequest-submit">Reset Password</button>
    </form>
    <?php
      if(isset($_GET["reset"])){
        if($_GET["reset"] == "success"){
          echo '<p>Wait for contact by admin</p>';
          echo '<p>Check your email</p>';
        }

      }

     ?>
    </div>
  </main>
    <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
  require "footer.php";
?>