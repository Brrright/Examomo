<?php
    if (!isset($_POST)) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_completed_exam_list.php";</script>';
        return;
    }
        
    require "common/conn.php";

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    if(!isset($body['givenmark'])) {
        $response["error"] = "0";
        echo json_encode($response);
        return;
    }

    $lecturerID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $PaperID = $body['paper_id'];
    $questionID = $body['question_id'];
    $studentid = $body['student_id'];
    $marking = $body['givenmark'];

    $answersql ="SELECT exam.ExamID
                FROM question_structure
                INNER JOIN exam ON question_structure.PaperID = exam.PaperID
                WHERE question_structure.SQuestionID = ".$questionID." AND question_structure.PaperID = ".$PaperID."";

    $answerquery = mysqli_query($con, $answersql);
    while ($answerrow = mysqli_fetch_array($answerquery)){
        $examid = $answerrow['ExamID'];
    }

    $sqlcorrect ="UPDATE student_answer SET
                    markReceived = '$marking',
                    LecturerID = $lecturerID,
                    CompanyID = $companyID,
                    ExamID = $examid
                    WHERE SQuestionID = $questionID AND StudentID = $studentid AND PaperID = $PaperID";

        // error message when no query found
        $resultcorrect = mysqli_query($con, $sqlcorrect);
        if(!$resultcorrect) {
            $response["error"] = 'Error occured when update:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }


    // get total marks from student answer
    $existsql ="SELECT SUM(markReceived) FROM student_answer 
                WHERE PaperID = $PaperID AND StudentID = $studentid AND ExamID = $examid";
    $existquery = mysqli_query($con, $existsql);

    $marksarray = mysqli_fetch_array($existquery);
    $totalmark = $marksarray[0];


    // check if result record exist
    $checkresultsql ="SELECT * FROM result
                        WHERE PaperID = $PaperID AND StudentID = $studentid AND ExamID = $examid";
    $checkresultquery = mysqli_query($con, $checkresultsql);

    $numOfExisting = mysqli_num_rows($checkresultquery);
    

    // insert new result record
    if ($numOfExisting == 0) {

        $sqlresults ="INSERT INTO result 
                    (TotalMark, PaperID, CompanyID, StudentID, ExamID)
                    VALUES ('$totalmark', '$PaperID', '$companyID', '$studentid', '$examid')";

        // error message when no query found
        $resultquery = mysqli_query($con, $sqlresults);
        if(!$resultquery) {
            $response["error"] = 'Error occured when insert:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
    }

    // update result record
    else {
        $updateresultsql ="UPDATE result SET
                        TotalMark = '$totalmark',
                        CompanyID = $companyID
                        WHERE PaperID = $PaperID AND StudentID = $studentid AND ExamID = $examid";

        // error message when no query found
        $resultquery2 = mysqli_query($con, $updateresultsql);
        if(!$resultquery2) {
            $response["error"] = 'Error occured when update:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
    }
    echo json_encode($response);
    
?>