<?php
    require "common/conn.php";

    $companyID = $_SESSION['companyID'];

    $sql ="INSERT INTO lecturer (LecturerName, LecturerGender, LecturerEmail, LecturerPassword, CompanyID)
    VALUES('$_POST[lecturerName]', '$_POST[lecturerGender]', '$_POST[lecturerEmail]', '$_POST[lecturerPassword]', $companyID)";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else 
    {
        $lecturerid = mysqli_insert_id($con);
        $modules = $_POST['moduleselect'];

        foreach ($modules as $moditem)
        {
            $modulesql ="INSERT INTO lecturer_module (LecturerID, ModuleID, CompanyID) VALUES ($lecturerid, $moditem, $companyID)";
            $modulerun = mysqli_query($con, $modulesql);
        }
        
            if (!$modulerun)
            {
                die('Error: ' . mysqli_error($con));
            }

            else{
                echo '<script>alert("Lecturer created successfully.");
                window.location.href = "admin_add_lecturer.php";
                </script>';
            }
    }
?>