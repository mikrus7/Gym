<?php
require 'header.php';
?>

<main>

    <?php
    if (isset($_GET["mail"])) {
        if($_GET["mail"] == "send") {
            echo '<p>Your email has been send</p>';
        }

    }
    else {
        ?>
        <div class="login-box">
        <h1>Contact Us</h1>
        <form action="includes/contactform.inc.php" method="post"><br>
        <div class="textbox">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" name="name" placeholder="Full name" required></div>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" name="mail" placeholder="Your Email" required></div>
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="subject" placeholder="Subject" required></div>
                    <div class="textbox">
                        <textarea name="message" placeholder="Message" required></textarea></div>
        <button type="submit" name="submit" class="button">SEND</button>
        </form></div>
        <?php } ?>
</main>

<section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
require 'footer.php';
?>

