<?php
    if(isset($_SESSION['idUser'])){
        if($_SESSION['levelUser'] == 2 or $_SESSION['levelUser'] >= 5){
            ?><form action="createEvent.php" method="post">
                <button name="submit" type="submit">Create an Event</button>
            </form>
            <form action="eventsCalendar.php" method="post">
                <button name="submit" type="submit">Events Calendar</button>
            </form>
            
            
            <?php
        }else{
            header("location: ../index.php?error=insufficientPerms");
        }
    }else{
        header("Location: /index.php?error=insufficientPerms");
    }