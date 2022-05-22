<?php
    require("common/conn.php");
    $isfound = 0;

    if(isset($_GET["action"])) {
        if($_GET["action"] == "module") {
            $tablename = "module";
            $nameCol = "ModuleName";
        }
        else if($_GET["action"] == "class") {
            $tablename = "class";
            $nameCol = "ClassName";
        }
        else {
            echo "error, action is not found";
            return;
        }

        $fetchedName = mysqli_real_escape_string($con,$_GET['name']);

        $result = mysqli_query($con, "SELECT * FROM ".$tablename." WHERE ".$nameCol." = '".$fetchedName."' AND CompanyID = ".$_SESSION['companyID']."");
        if(mysqli_num_rows($result) > 0){
            $isfound = 1; 
        }
    }
    else {
        echo "err, action is not specified";
        return;
    }
    echo $isfound;
    exit;
?>