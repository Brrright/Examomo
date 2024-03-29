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
    $lecturerid = $_GET['id'];

    //check the exam table to see connection
    $checkex = "SELECT LecturerID FROM exam WHERE LecturerID = $lecturerid";
    $checkexrow = mysqli_query($con,$checkex);
    $checkexnow = mysqli_num_rows($checkexrow);

    //check the exam paper table to see connection
    $checkexpa = "SELECT LecturerID FROM exam_paper WHERE LecturerID = $lecturerid";
    $checkexparow = mysqli_query($con,$checkexpa);
    $checkexpanow = mysqli_num_rows($checkexparow);

    //check the student answer table to see connection
    $checkstan = "SELECT LecturerID FROM student_answer WHERE LecturerID = $lecturerid";
    $checkstanrow = mysqli_query($con,$checkstan);
    $checkstannow = mysqli_num_rows($checkstanrow);

    if($checkexnow !== 0){
        echo '<script>alert("Cannot delete when there is connection with exam.");
        window.location.href = "admin_lecturer_list.php";
        </script>';
        return;

    }
    elseif($checkexpanow !== 0){
        echo '<script>alert("Cannot delete when there is connection with exam paper.");
        window.location.href = "admin_lecturer_list.php";
        </script>';
        return;
    }
    elseif($checkstannow !== 0){
        echo '<script>alert("Cannot delete when there is connection with student answer.");
        window.location.href = "admin_lecturer_list.php";
        </script>';
        return;
    }
    else{

    $delete ="DELETE FROM lecturer WHERE LecturerID = '$lecturerid'";

    $sql = mysqli_query($con, $delete);
    
    }

    if (!mysqli_query($con,$delete)) {
     echo 'Error: ' . mysqli_error($con);
    }

    else {
    echo '<script>alert("The lecturer details deleted successfully.");
    window.location.href = "admin_lecturer_list.php";
    </script>';
    }
?>