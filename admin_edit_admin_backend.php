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

    // // pass company id
    // $comid = $_SESSION['companyID'];

    // retrive id from form
    $adminid = $_POST['adminid'];

    $sql ="UPDATE admin SET
        AdminName = '$_POST[adminname]',
        AdminEmail = '$_POST[adminmail]',
        AdminPassword = '$_POST[adminpass]'
        WHERE AdminID = '$adminid'";


    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Profile details updated successfully.");
    window.location.href = "admin_account_list.php";
    </script>';
    }

?>