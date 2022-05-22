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

    // retrive id from form
    $studentid = $_POST['studentid'];

    $sql ="UPDATE student SET
        StudentName = '$_POST[studentname]',
        StudentGender = '$_POST[studentgender]',
        StudentEmail = '$_POST[studentmail]',
        StudentPassword = '$_POST[studentpass]',
        ClassID = '$_POST[studentclass]'
        WHERE StudentID = '$studentid'";


    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Student details updated successfully.");
    window.location.href = "admin_student_list.php";
    </script>';
    }
?>