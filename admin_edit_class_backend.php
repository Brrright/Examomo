<?php
    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // pass company id
    $comid = $_SESSION['companyID'];

    // retrive class id 
    $classid = $_POST['classid'];

    $sql ="UPDATE class INNER JOIN module_class ON class.ClassID = module_class.ClassID SET
        class.ClassName = '$_POST[classname]',
        module_class.ModuleID = '$_POST[adminmodule]'
        WHERE class.ClassID = '$classid'";


    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Class details updated successfully.");
    window.location.href = "admin_class_list.php";
    </script>';
    }

?>