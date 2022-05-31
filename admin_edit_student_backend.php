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

    // pass company id
    $comid = $_SESSION['companyID'];

    // retrive id from form
    $studentid = $_POST['studentid'];

    error_reporting(0);
    
    // access status
    if ($_POST['access'] == "empty"){


        $sql ="UPDATE student SET
        StudentName = '$_POST[studentname]',
        StudentGender = '$_POST[studentgender]',
        StudentEmail = '$_POST[studentmail]',
        StudentPassword = '$_POST[studentpass]',
        ClassID = '$_POST[studentclass]',
        isBanned = NULL
        WHERE StudentID = '$studentid'";


        if (!mysqli_query($con,$sql)) {
            echo ('Error: ' . mysqli_error($con));
        }

        else {
        echo '<script>alert("Student details updated successfully.");
        window.location.href = "admin_student_list.php";
        </script>';
        }

    }
    
    if (!$_POST['access']) {

        $sql ="UPDATE student SET
            StudentName = '$_POST[studentname]',
            StudentGender = '$_POST[studentgender]',
            StudentEmail = '$_POST[studentmail]',
            StudentPassword = '$_POST[studentpass]',
            ClassID = '$_POST[studentclass]',
            isBanned = 1
            WHERE StudentID = '$studentid'";


            if (!mysqli_query($con,$sql)) {
                echo ('Error: ' . mysqli_error($con));
            }

            else {
            echo '<script>alert("Student details updated successfully.");
            window.location.href = "admin_student_list.php";
            </script>';
            }
    }
?>