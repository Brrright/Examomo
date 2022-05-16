<?php

    require("common/conn.php");
    $isfound = 0;

    if(isset($_GET["companyname"])) {
        $companyName = mysqli_real_escape_string($con,$_GET['companyname']);

        // check company name
        $result = mysqli_query($con, "SELECT * FROM company WHERE CompanyName = '".$companyName."'");
        if(mysqli_num_rows($result) > 0){
            $isfound = 1; 
        }
    }
    echo $isfound;
    exit;
?>