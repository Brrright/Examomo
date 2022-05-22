<?php

    require "common/conn.php";

    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // pass lecturer id and submission status
    $id = $_SESSION['userID'];
    $submit = $_POST['submit'];
    $company = $_SESSION['companyID'];

    // condition to verify draft or publish
    if ($submit == "publish") {
        $publish = 1;
    }

    else if ($submit == "draft") {
        $publish = 0;
    }

    else {
        echo "Error occured. Please try again.";
        return;
    }

    $sql ="INSERT INTO exam (ExamName, ExamDescription, ExamStartDateTime, ExamEndDateTime, isPublished, ModuleID, LecturerID, PaperID, CompanyID) 
    VALUES('$_POST[Examname]', '$_POST[Examdesc]', '$_POST[Examstarttime]', '$_POST[Examendtime]', $publish,'$_POST[Moduleid]', $id, '$_POST[Exampaper]', $company)";

    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
        return;
    }

    else {
        $last_id = mysqli_insert_id($con);
        $classsql ="INSERT INTO exam_class (ExamID, ClassID, CompanyID) VALUES ('$last_id', '$_POST[Classid]', $company)";
    
    }

    if (!mysqli_query($con,$classsql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam created successfully.");
    window.location.href = "lecturer_exam_page.php";
    </script>';
    }
?>
