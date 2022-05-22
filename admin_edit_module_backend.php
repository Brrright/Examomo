<?php
    require "common/conn.php";

    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
      }


    //Get id from edit module
    $Modid = $_POST['moduleid'];

    // //used to get the admin id to change
    // $adminID = $_SESSION['userID'];


    $sql = "UPDATE module SET
    ModuleName = '$_POST[modulename]'
    WHERE ModuleID = $Modid";

    $modulesql = mysqli_query($con, $sql);


    if (!mysqli_query($con, $sql)) {
        die('Error: '.mysqli_error($con));
    }

    else{
        echo '<script>alert("Module details updated successfully.");
        window.location.href = "admin_module_list.php";
        </script>';
    }
    
?>