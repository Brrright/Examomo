<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $adminID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];
    $modules = $_POST['moduleselect'];

    $sqlClass = "INSERT INTO class (ClassName, CompanyID) VALUE ('$_POST[className]', $companyID)";
    if(!mysqli_query($con, $sqlClass)) {
        echo 'Error:'.mysqli_error($con);

    }
    else {
        $classID = mysqli_insert_id($con);

        // class + admin------------------------------------------------------------------------
        $sqlClass_Admin = "INSERT INTO admin_class (AdminID, ClassID, CompanyID) VALUES ('$adminID', '$classID', $companyID)";
        if(!mysqli_query($con, $sqlClass_Admin)) {
            echo 'Error:'.mysqli_error($con);
        }
        else {
            // module + class------------------------------------------------------------------------
            foreach ($modules as $modID) {
                $sqlClass_Module = "INSERT INTO module_class (ModuleID, ClassID, CompanyID) VALUES ('$modID', '$classID', $companyID)";
                if(!mysqli_query($con, $sqlClass_Module)) {
                    echo 'Error:'.mysqli_error($con);
                    return;
                }
            }
            
            echo '<script>alert("Student created successfully.");
            window.location.href = "admin_class_list.php";
            </script>';
        }
    }
?>