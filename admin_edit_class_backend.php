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


    // retrive class id 
    $classid = $_POST['classid'];
    
    // get company id & selected modules'id
    $comid = $_SESSION['companyID'];
    if(!isset( $_POST['moduleselect'])) {
        echo '<script>alert("A class must have at least one related module");window.location.href = "admin_edit_class.php?id='.$classid.'"</script>';
        return;
    }
    $modules = $_POST['moduleselect']; //list


    $sqlDelete = "DELETE FROM module_class WHERE ClassID = '$classid'";
    $resultDelete = mysqli_query($con, $sqlDelete);
    if (!$resultDelete) {
        echo 'Err from deleting all record: '.mysqli_error($con);
        return;
    }
    foreach ($modules as $modID) {
        $sqlClass_Module = "INSERT INTO module_class (ModuleID, ClassID, CompanyID) VALUES ('$modID', '$classid', $comid)";
        if(!mysqli_query($con, $sqlClass_Module)) {
            echo 'Error: inseting new moduleclass'.mysqli_error($con);
            return;
        }
    }

    //update new class name to the existing class that is selected
    $sql = "UPDATE class SET ClassName = '$_POST[classname]' WHERE ClassID = '$classid'";
    if (!mysqli_query($con,$sql)) {
        echo 'Error: updating classname'.mysqli_error($con);
        return;
    }
    
    echo '<script>alert("Class details updated successfully.");
    window.location.href = "admin_class_list.php";
    </script>';

?>