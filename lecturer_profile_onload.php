<?php
    require "common/conn.php";

    $sql= "SELECT lecturer.LecturerID, lecturer.LecturerName, lecturer.LecturerGender, lecturer.LecturerEmail, lecturer.LecturerPassword, company.CompanyName, module.ModuleName 
            FROM lecturer INNER JOIN company ON lecturer.CompanyID = company.CompanyID
            INNER JOIN lecturer_module ON lecturer.LecturerID = lecturer_module.LecturerID
            INNER JOIN module ON lecturer_module.ModuleID = module.ModuleID
            WHERE lecturer.LecturerID = ".$_SESSION["userID"]." AND lecturer.CompanyID = ".$_SESSION["companyID"]."";
    
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {

        echo "$row[LecturerID]";
        echo "$row[LecturerName]";
        echo "$row[LecturerGender]";
        echo "$row[LecturerEmail]";
        echo "$row[LecturerPassword]";
        echo "$row[CompanyName]";
        echo "$row[ModuleName]";
    }
?>