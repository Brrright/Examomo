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
    $modules = $_POST['moduleselect'];


    // retrive class id 
    $classid = $_POST['classid'];

    foreach ($modules as $modID) {

        $sql = "UPDATE class SET ClassName = '$_POST[classname]' WHERE ClassID = '$classid'";
        // $sql ="UPDATE class INNER JOIN module_class ON class.ClassID = module_class.ClassID SET
        //     class.ClassName = '$_POST[classname]',
        //     module_class.ModuleID = '$modID'
        //     WHERE class.ClassID = '$classid'";

        $sql2 = "UPDATE module_class SET ModuleID = '$modID' WHERE ClassID = '$classid'";
    
        if (!mysqli_query($con,$sql)) {
            echo 'Error:'.mysqli_error($con);
            return;
        }
        if (!mysqli_query($con,$sql2)) {
            echo 'Error:'.mysqli_error($con);
            return;
        }
    }

    echo '<script>alert("Class details updated successfully.");
    window.location.href = "admin_class_list.php";
    </script>';

?>