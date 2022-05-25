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

    $sql ="INSERT INTO admin (AdminName, AdminEmail, AdminPassword, CompanyID)
    VALUES('$_POST[adminName]', '$_POST[adminEmail]', '$_POST[adminPassword]', $companyID)";

    if(!mysqli_query($con, $sql)) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);

    }
        else {
            echo '<script>alert("Admin created successfully.");
            window.location.href = "admin_add_admin.php";
            </script>';
            } 
?>