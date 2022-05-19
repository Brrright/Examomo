<?php
    require "common/conn.php";

    // pass lecturer id and submission status
    $id = $_SESSION['userID'];
    $submit = $_POST['submit'];
    $comid = $_SESSION['companyID'];

    // retrive examid from from
    $examid = $_POST['examid'];

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

    $sql ="UPDATE exam SET
        ExamName = '$_POST[Examname]',
        ExamDescription = '$_POST[Examdesc]',
        ExamStartDateTime = '$_POST[Examstarttime]',
        ExamEndDateTime = '$_POST[Examendtime]',
        isPublished = $publish,
        LecturerID = $id,
        PaperID = '$_POST[Exampaper]',
        CompanyID = $comid,
        ModuleID = '$_POST[Moduleid]'
        WHERE ExamID = '$examid'";


    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam changes made successfully.");
    window.location.href = "lecturer_exam_page.php";
    </script>';
    }
?>