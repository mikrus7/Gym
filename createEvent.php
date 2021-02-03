<?php
    require 'header.php';
    if(isset($_SESSION['idUser'])){
    if(($_SESSION['levelUser'] == 2) or ($_SESSION['levelUser'] >= 5)){
        
        require 'includes/dbh.inc.php';
        ?>
        <main> <div class="login-box">
                    <h3 class="eveheader">Create An Event</h3>
            <form action="includes/eventCreation.inc.php" method="post">
                <input type="hidden" name="eventDriverId" value="<?php echo $_SESSION['idUser']; ?>">
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="eventTitle" required placeholder="Title for Event"></div>
                <div class="textbox">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <input type="date" name="eventDate" required></div>
                <div class="textbox">
                    <i class="fa fa-clock" aria-hidden="true"></i>
                  <input type="time" name="eventTime" required></div>
                <div class="textbox">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                <input type="text" name="eventStart" required placeholder="Start of the Event"></div>
                <div class="textbox">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                   <input type="text" name="eventEnd" required placeholder="End of the Event"></div>
                <div class="textbox">
                    <i class="fa fa-info" aria-hidden="true"></i>
                <textarea id="eventInfo" name="eventInfo" rows="5" required class="eveinfo" >
                </textarea></div>
                <button type="submit" name="submit" class="button" >Create Event</button>
            </form></div>
        
        
        
        
        
        
        
        </main>





        <section> </section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



    <?php
        require 'footer.php';
    }}
    else{
        header("location: index.php?error");
    }