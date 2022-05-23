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

    // get company id & selected modules'id
    $comid = $_SESSION['companyID'];
    $modules = $_POST['moduleselect']; //list


    // retrive class id 
    $classid = $_POST['classid'];

    // get all class record from module_class
    $classFromM_C = "SELECT * FROM module_class WHERE ClassID = '$classid'";
    $result_from_classes = mysqli_query($classFromM_C)
    if (!$result_from_classes) {
        echo 'Err from fetching classes from mod_class: '.mysqli_error($con);
    }

    $classFromM_C2 = "SELECT * FROM module_class WHERE ClassID = '$classid'";
    $result_from_classes2 = mysqli_query($classFromM_C2)
    if (!$result_from_classes2) {
        echo 'Err from fetching classes from mod_class: '.mysqli_error($con);
    }

    $remainSame = array(); //module ID that didn't need to update
    while ($class_module = mysqli_fetch_array($result_from_classes)) { //every record that matches classID in m_c table
        foreach($modules as $modID) {
            if($class_module["ModuleID"] == $modID) {
                array_push($remainSame, $class_module["ModuleID"]); 
            }
        }
    }
    $numberOfRemainSameList = count($remainSame);
    while ($class_module2 = mysqli_fetch_array($result_from_classes2)) {
        for($i=0; $i<$numberOfRemainSameList; $i++)) {
            if($class_module2["ModuleID"] == $remainSame[$i]) {
                
            }
        }
    }

    foreach ($modules as $modID) {

        // $sql2 = "UPDATE module_class SET ModuleID = '$modID' WHERE ClassID = '$classid'";
        // // $sql ="UPDATE class INNER JOIN module_class ON class.ClassID = module_class.ClassID SET
        // //     class.ClassName = '$_POST[classname]',
        // //     module_class.ModuleID = '$modID'
        // //     WHERE class.ClassID = '$classid'";
        
        
        // if (!mysqli_query($con,$sql2)) {
        //     echo 'Error:'.mysqli_error($con);
        //     return;
        //     // continue;
        // }
        
    }

    //update new class name to the existing class that is selected
    $sql = "UPDATE class SET ClassName = '$_POST[classname]' WHERE ClassID = '$classid'";
    if (!mysqli_query($con,$sql)) {
        echo 'Error:'.mysqli_error($con);
        return;
    }
    
    echo '<script>alert("Class details updated successfully.");
    window.location.href = "admin_class_list.php";
    </script>';

?>