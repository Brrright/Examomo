<?php
    require("common/conn.php");
    $isfound = 0;

    if(isset($_GET["role"])) {
        if($_GET["role"] == "admin") {
            $tablename = "admin";
            $emailCol = "AdminEmail";
        }
        else if($_GET["role"] == "student") {
            $tablename = "student";
            $emailCol = "StudentEmail";
        }
        else if($_GET["role"] == "lecturer") {
            $tablename = "lecturer";
            $emailCol = "LecturerEmail";
        }
        else {
            echo "error, role is not found";
            return;
        }

        $emailname = mysqli_real_escape_string($con,$_GET['email']);

        $result = mysqli_query($con, "SELECT * FROM ".$tablename." WHERE ".$emailCol." = '".$emailname."' AND CompanyID = ".$_SESSION['companyID']."");
        if(mysqli_num_rows($result) > 0){
            $isfound = 1; 
        }
    }
    
    else {
        echo "err, role is not specified";
        return;
    }
    echo $isfound;
    exit;
?>