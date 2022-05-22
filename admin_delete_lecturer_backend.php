<?php
    require "common/conn.php";

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

    $lecturerid = $_GET['id'];

    //check the student answer table to see connection
    $checkstan = "SELECT LecturerID FROM lecturer WHERE LecturerID = $lecturerid";
    $checkstanrow = mysqli_query($con,$checkstan);
    $checkstannow = mysqli_num_rows($checkstanrow);

    if($checkstannow !== 0){
        echo '<script>alert("Cannot delete when there is connection with student answer.");
        window.location.href = "admin_lecturer_list.php";
        </script>';
        return;

    }else{
    $delete ="DELETE FROM lecturer WHERE LecturerID = '$lecturerid'";

    $sql = mysqli_query($con, $delete);
    
    }

    if (!mysqli_query($con,$delete)) {
    die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("The lecturer details deleted successfully.");
    window.location.href = "admin_lecturer_list.php";
    </script>';
    }
?>