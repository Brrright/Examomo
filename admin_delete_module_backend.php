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

    $moduleid = $_GET['id'];

    //check the module class table to see connection
    $checkadmo = "SELECT ModuleID FROM module_class WHERE ModuleID = $moduleid";
    $checkadmorow = mysqli_query($con,$checkadmo);
    $checkadmonow = mysqli_num_rows($checkadmorow);

    //check the lecturer module table to see connection
    $checklemo = "SELECT ModuleID FROM lecturer_module WHERE ModuleID = $moduleid";
    $checklemorow = mysqli_query($con,$checklemo);
    $checklemonow = mysqli_num_rows($checklemorow);

    //check the exam table to see connection
    $checkex = "SELECT ModuleID FROM exam WHERE ModuleID = $moduleid";
    $checkexrow = mysqli_query($con,$checkex);
    $checkexnow = mysqli_num_rows($checkexrow);

    //check the exam paper table to see connection
    $checkexpa = "SELECT ModuleID FROM exam_paper WHERE ModuleID = $moduleid";
    $checkexparow = mysqli_query($con,$checkexpa);
    $checkexpanow = mysqli_num_rows($checkexparow);

    if($checkadmonow !== 0){
        echo '<script>alert("Cannot delete when there is connection with class.");
        window.location.href = "admin_module_list.php";
        </script>';
        return;
    }
    elseif($checklemonow !== 0){
        echo '<script>alert("Cannot delete when there is connection with lecturer.");
        window.location.href = "admin_module_list.php";
        </script>';
        return;
    }
    elseif($checkexnow !== 0){
        echo '<script>alert("Cannot delete when there is connection with exam.");
        window.location.href = "admin_module_list.php";
        </script>';
        return;
    }
    elseif($checkexpanow !== 0){
        echo '<script>alert("Cannot delete when there is connection with exam paper.");
        window.location.href = "admin_module_list.php";
        </script>';
        return;
    }
    else{

    $delete = "DELETE FROM module WHERE ModuleID = '$moduleid'";

    $sql = mysqli_query($con,$delete);

    }
    if (!mysqli_query($con, $delete)) {
        echo 'Error: '.mysqli_error($con);
    }

    else{
        echo '<script>alert("Module detail deleted successfully.");
        window.location.href = "admin_module_list.php";
        </script>';
    }
    
?>