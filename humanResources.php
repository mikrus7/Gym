<?php

if(isset($_SESSION['idUser'])){
    if(($_SESSION['levelUser'] == 3) or ($_SESSION['levelUser'] >= 5)){
        ?> <form action="applications.php" method="post">
            <button name="submit" type="submit">Applications</button>
        </form>
        <form action="members.php" method="post">
            <button name="submit" type="submit">Members</button>
    </form>
        <?php

    }else{
        header("Location: /index.php?error=insufficientPerms"); 
    }
}else{
    header("Location: /index.php?error=insufficientPerms");
}