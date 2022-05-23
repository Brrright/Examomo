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

    // retrive module id 
    // $moduleid = $_POST['moduleid'];

    $lectid = $_POST['lecturerid'];

    if(!isset( $_POST['moduleselect'])) {
        echo '<script>alert("A Lecturer must have at least one related module");window.location.href = "admin_edit_lecturer.php?id='.$lectid.'"</script>';
        return;
    }

    $modselect = $_POST['moduleselect'];
    $sqlDelete = "DELETE FROM lecturer_module WHERE LecturerID = '$lectid'";
    $resultDelete = mysqli_query($con, $sqlDelete);
    if (!$resultDelete) {
        echo 'Err from deleting all record: '.mysqli_error($con);
        return;
    }
    foreach ($modselect as $modID) {
        $sqlClass_Module = "INSERT INTO lecturer_module (LecturerID, ModuleID, CompanyID) VALUES ('$lectid', '$modID', $comid)";
        if(!mysqli_query($con, $sqlClass_Module)) {
            echo 'Error: inseting new moduleclass'.mysqli_error($con);
            return;
        }
    }

    $sql ="UPDATE lecturer SET
        LecturerName = '$_POST[lecturername]',
        LecturerGender = '$_POST[lecturergender]',
        LecturerEmail = '$_POST[lecturermail]',
        LecturerPassword = '$_POST[lecturerpass]'
        WHERE LecturerID = '$lectid'";


    if (!mysqli_query($con,$sql)) {
        echo 'Error: updating classname'.mysqli_error($con);
        return;
    }

    else {
    echo '<script>alert("Lecturer details updated successfully.");
    window.location.href = "admin_lecturer_list.php";
    </script>';
    }

?>