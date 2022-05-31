<?php
    require "common/conn.php";
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
    $adminID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $sql = "INSERT INTO module (ModuleName, CompanyID) VALUE ('$_POST[moduleName]', $companyID)";
    if(!mysqli_query($con, $sql)) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);

    }
    else {
        $response["successModule"] = "Module record inserted sucessfully";
        $moduleID = mysqli_insert_id($con);

        // module + admin------------------------------------------------------------------------
        $sqlModule_Admin = "INSERT INTO admin_module (AdminID, ModuleID, CompanyID) VALUES ('$adminID', '$moduleID', $companyID)";
        if(!mysqli_query($con, $sqlModule_Admin)) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);

        }
        else {
            echo '<script>alert("Module created successfully.");
            window.location.href = "admin_add_module.php";
            </script>';
            } 
        }
?>