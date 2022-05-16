<?php
    session_start();
    require "common/conn.php";

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

    $sql ="INSERT INTO exam (ExamName, ExamDescription, ExamStartDateTime, ExamEndDateTime, isPublished, examModule, LecturerID, PaperID, CompanyID) 
    VALUES('$_POST[Examname]', '$_POST[Examdesc]', '$_POST[Examstarttime]', '$_POST[Examendtime]', $publish,'$_POST[Modulename]', $id, '$_POST[Exampaper]', $company)";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam created successfully.");
    window.location.href = "lecturer_exam_page.php";
    </script>';
    }
?>
