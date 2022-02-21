<?php
session_start();
if(isset($_SESSION['LOGGED']) && $_SESSION['LOGGED']){
    if($_SESSION['STATUS'] != 'admin'){
        echo'Vous n\'avez pas accès à la partie administration du blog car il faut être administrateur';
    }
}
else{
    header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=connectForm');
}
