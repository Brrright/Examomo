<?php
    require "common/conn.php";
    $adminID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $sqlClass = "INSERT INTO class (ClassName, CompanyID) VALUE ('$_POST[className]', $companyID)";
    if(!mysqli_query($con, $sqlClass)) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);

    }
    else {
        $response["successClass"] = "Class record inserted sucessfully";
        $classID = mysqli_insert_id($con);

        // class + admin------------------------------------------------------------------------
        $sqlClass_Admin = "INSERT INTO admin_class (AdminID, ClassID, CompanyID) VALUES ('$adminID', '$classID', $companyID)";
        if(!mysqli_query($con, $sqlClass_Admin)) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);

        }
        else {
            // module + class------------------------------------------------------------------------
            $moduleID = mysqli_insert_id($con);
            $sqlClass_Module = "INSERT INTO module_class (ModuleID, ClassID, CompanyID) VALUES ('$moduleID', '$classID', $companyID)";
            if(!mysqli_query($con, $sqlClass_Module)) {
                $response["error"] = 'Error:'.mysqli_error($con);
                echo json_encode($response);

            }
            else {
            echo '<script>alert("Student created successfully.");
            window.location.href = "admin_add_class.php";
            </script>';
            } 
        }
    }
?>