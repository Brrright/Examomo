<?php
    require "common/conn.php";

    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }

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

    $sql ="UPDATE exam, exam_class SET
        exam.ExamName = '$_POST[Examname]',
        exam.ExamDescription = '$_POST[Examdesc]',
        exam.ExamStartDateTime = '$_POST[Examstarttime]',
        exam.ExamEndDateTime = '$_POST[Examendtime]',
        exam.isPublished = $publish,
        exam.LecturerID = $id,
        exam.PaperID = '$_POST[Exampaper]',
        exam.CompanyID = $comid,
        exam.ModuleID = '$_POST[Moduleid]',
        exam_class.ClassID = '$_POST[Classid]'
        WHERE exam.ExamID = '$examid' AND exam_class.ExamID = '$examid'";


    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam changes made successfully.");
    window.location.href = "lecturer_exam_page.php";
    </script>';
    }
?>