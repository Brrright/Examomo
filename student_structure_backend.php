<?php
    if (!isset($_POST)) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="student_exam_list.php";</script>';
        return;
    }
    // if (!isset($_SESSION["userID"])) {
    //     echo '<script>alert("Please login before you access this page.");
    //     window.location.href="logout.php";</script>';
    // }
    // if ($_SESSION["userRole"] != "student") {
        //     echo '<script>alert("You have no access to this page.");
        //     window.location.href="logout.php";</script>';
        // }
        
    require "common/conn.php";

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    if(!isset($body['structure_answer'])) {
        $response["error"] = "0";
        echo json_encode($response);
        return;
    }

    $studentID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $PaperID = $body['paper_id'];
    $questionID = $body['question_id'];
    $studentanswer = $body['structure_answer'];


    $answersql ="SELECT question_structure.Mark, exam.ExamID
                FROM question_structure
                INNER JOIN exam ON question_structure.PaperID = exam.PaperID
                WHERE question_structure.SQuestionID = ".$questionID." AND question_structure.PaperID = ".$PaperID."";
    
    $answerquery = mysqli_query($con, $answersql);
    while ($answerrow = mysqli_fetch_array($answerquery)){
        $marks = $answerrow['Mark'];
        $examid = $answerrow['ExamID'];
    }

    $existsql ="SELECT * FROM student_answer
                WHERE SQuestionID = $questionID";
    $existquery =mysqli_query($con, $existsql);

    $numOfExisting = mysqli_num_rows($existquery);

    //insert new answer records
    if ($numOfExisting == 0){
        
        $sqlcorrect ="INSERT INTO student_answer 
                    (Answer, markReceived, MQuestionID, SQuestionID, StudentID, LecturerID, CompanyID, ExamID, PaperID)
                    VALUES ('$studentanswer', NULL, NULL,'$questionID', '$studentID', NULL, '$companyID', '$examid', '$PaperID')";

        // error message when no query found
        $resultcorrect = mysqli_query($con, $sqlcorrect);
        if(!$resultcorrect) {
            $response["error"] = 'Error occured when insert:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
    }

    //update answer records
    else {
        $sqlcorrect ="UPDATE student_answer SET
                    Answer = '$studentanswer',
                    LecturerID = NULL,
                    CompanyID = $companyID,
                    ExamID = $examid,
                    PaperID = $PaperID
                    WHERE SQuestionID = $questionID AND StudentID = $studentID";

        // error message when no query found
        $resultcorrect = mysqli_query($con, $sqlcorrect);
        if(!$resultcorrect) {
            $response["error"] = 'Error occured when update:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
    }
    echo json_encode($response);

?>