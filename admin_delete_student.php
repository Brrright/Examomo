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

    $studentid = $_GET['id'];

    $delete ="DELETE FROM student WHERE StudentID = '$studentid'";

    $sql = mysqli_query($con, $delete);
    
    if (!mysqli_query($con,$delete)) {
    die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("All student details deleted successfully.");
    window.location.href = "admin_student_list.php";
    </script>';
    }
?>