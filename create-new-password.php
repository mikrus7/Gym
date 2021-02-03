<?php
  require "header.php";
?>

  <main>
    <?php
      $selector = $_GET["selector"];
      $validator = $_GET["validator"];
      if (empty($selector) or empty ($validator)){
        die ("We could not validate your request, please contact an admin");
      }
      else{
        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
          ?>
          <form action ="includes\password-reset.inc.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input type="password" name="pwd" placeholder="Enter a new password">
            <input type="password" name="pwdConfirm" placeholder="Confirm password">
            <button type="submit" name="reset-password-submit">Reset Password</button>
          </form>

          <?php
        }
        else{
          die("Error has happened");
        }

    }
     ?>
  </main>

<?php
  require "footer.php";
?>
