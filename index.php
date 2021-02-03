<?php
    require 'header.php';
    require 'functions.php'
    ?>
    <?php
        if(isset($_SESSION['idUser'])){
            if($_SESSION['verifiedUser'] === 3){
                ?>
                <div class="calendar_div2">
                <?php require 'calendar.php'; ?>
                </div>
                <?php
            }
        }
        
        ?>


<section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
        require 'footer.php';
?>
