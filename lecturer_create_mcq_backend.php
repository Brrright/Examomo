<?php
    if (isset($_SESSION['myVariable']))
    {
        $_SESSION['myVariable'] = 0;
    }
    
    if(isset($_POST['submit']))
    {
        echo $_SESSION['myVariable'] +1;  
    }
?>