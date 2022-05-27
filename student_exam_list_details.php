<?php
    if(!isset($_GET))
        return;

    require("common/conn.php");


    $fetch = "SELECT * FROM ((exam 
            INNER JOIN lecturer ON exam.LecturerID = lecturer.LecturerID) 
            INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID) WHERE ExamID =$_GET[id]";
    $modaldetails = mysqli_query($con, $fetch);
    if(!$modaldetails) {
        echo 'Err'.mysqli_error($con);

    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');

    while ($details = mysqli_fetch_array($modaldetails)) {
    echo    '<div class="text-start">
            <p class="m-2">
                Exam Name        : '.$details["ExamName"].'
            </p>
            <p class="m-2">
                Exam Description : '.$details["ExamDescription"].'
            </p>
            <p class="m-2">
                Exam Starts at   : '.$details["ExamStartDateTime"].'
            </p>
            <p class="m-2">
                Exam Ends at     : '.$details["ExamEndDateTime"].'
            </p>
            <p class="m-2">
                Lecturer Name    : '.$details["LecturerName"].'
            </p>
            <p class="m-2">
                Paper Type       : <span id"paper-type">'.$details["PaperType"].'</span>
            </p>
            </div>';
    }
?>