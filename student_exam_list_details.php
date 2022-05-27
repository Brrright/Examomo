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
    ?>

        <table class="table table-borderless text-start">
        <?php    
        echo    '<div class="text-start">
            <tr>
                <td>Exam Name</td>
                <td>'.$details["ExamName"].'</td>
            </tr>
            <tr>
                <td>Exam Description</td>
                <td>'.$details["ExamDescription"].'</td>
            </tr>
            <tr>
                <td>Exam Starts at</td>
                <td>'.$details["ExamStartDateTime"].'</td>
            </tr>
            <tr>
                <td>Exam Ends at</td>
                <td>'.$details["ExamEndDateTime"].'</td>
            </tr>
            <tr>
                <td>Lecturer Name</td>
                <td>'.$details["LecturerName"].'</td>
            </tr>
            <tr>
                <td>Paper Type</td>
                <td><span id"paper-type">'.$details["PaperType"].'</span></td>
            </tr>
            </div>';
        }
        ?>
        </table>
