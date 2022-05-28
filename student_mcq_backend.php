<?php

    if (!isset($_POST)) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="student_exam_list.php";</script>';
        return;
    }
    // if (!isset($_SESSION["userID"])) {
    //     echo '<script>alert("Please login before you access this page.");
    //     window.location.href="guest_home_page.php";</script>';
    // }
    // if ($_SESSION["userRole"] != "student") {
    //     echo '<script>alert("You have no access to this page.");
    //     window.location.href="guest_home_page.php";</script>';
    // }

    require("common/conn.php");
    
    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];
    
    if(!isset($body['mcq_answer'])) {
        $response["error"] = "no need save, no answer specified";
        echo json_encode($response);
        return;
    }

    $studentID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $PaperID = $body['paper_id'];
    $questionID = $body['question_id'];
    $studentanswer = $body['mcq_answer'];


    $wronganswer = 0;

    $answersql ="SELECT question_multiple_choice.Mark, question_multiple_choice.CorrectAnswer, exam.ExamID
                FROM question_multiple_choice
                INNER JOIN exam ON question_multiple_choice.PaperID = exam.PaperID
                WHERE question_multiple_choice.MQuestionID = ".$questionID." AND question_multiple_choice.PaperID = ".$PaperID."";

    $answerquery = mysqli_query($con, $answersql);
    if(!$answerquery) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);
        return;
    }

    $answerrow = mysqli_fetch_array($answerquery);
    $correct = $answerrow['CorrectAnswer'];
    $marks = $answerrow['Mark'];
    $examid = $answerrow['ExamID'];

    $existsql ="SELECT * FROM student_answer
                WHERE MQuestionID = $questionID AND StudentID = $studentID";
    $existquery =mysqli_query($con, $existsql);

    if(!$existquery) {
        $response["error"] = 'Error when fetching student answer: '.mysqli_error($con);
        echo json_encode($response);
        return;
    }

    $numOfExisting = mysqli_num_rows($existquery);

    //insert new answer records
    if ($numOfExisting == 0){
        $response["hey"] = "i reach insert new record";
        if ($studentanswer == $correct){
            $sqlcorrect ="INSERT INTO student_answer 
                        (Answer, markReceived, MQuestionID, SQuestionID, StudentID, LecturerID, CompanyID, ExamID, PaperID)
                        VALUES ('$studentanswer', '$marks', '$questionID', NULL, '$studentID', NULL, '$companyID', '$examid', '$PaperID')";

            // error message when no query found
            $resultcorrect = mysqli_query($con, $sqlcorrect);
            if(!$resultcorrect) {
                $response["error"] = 'Error when inserting student answer (correct):'.mysqli_error($con);
                echo json_encode($response);
                return;
            }
        }

        else {
            $sqlwrong ="INSERT INTO student_answer 
                        (Answer, markReceived, MQuestionID, SQuestionID, StudentID, LecturerID, CompanyID, ExamID, PaperID)
                        VALUES ('$studentanswer', '$wronganswer', '$questionID', NULL, '$studentID', NULL, '$companyID', '$examid', '$PaperID')";

            // error message when no query found
            $resultwrong = mysqli_query($con, $sqlwrong);
            if(!$resultwrong) {
                $response["error"] = 'Error  when inserting student answer (wrong):'.mysqli_error($con);
                echo json_encode($response);
                return;
            }
        }
    }

    //update answer records
    else {
        $response["hey"] = "i reach update new record";
        if ($studentanswer == $correct){
            $sqlcorrect ="UPDATE student_answer SET
                        Answer = $studentanswer,
                        markReceived = $marks,
                        SQuestionID = NULL,
                        LecturerID = NULL,
                        CompanyID = $companyID,
                        ExamID = $examid,
                        PaperID = $PaperID
                        WHERE MQuestionID = $questionID AND StudentID = $studentID";

            // error message when no query found
            $resultcorrect = mysqli_query($con, $sqlcorrect);
            if(!$resultcorrect) {
                $response["error"] = 'Error when updating student answer (correct):'.mysqli_error($con);
                echo json_encode($response);
                return;
            }
        }

        else {
            $sqlwrong ="UPDATE student_answer SET
                        Answer = $studentanswer,
                        markReceived = $wronganswer,
                        SQuestionID = NULL,
                        LecturerID = NULL,
                        CompanyID = $companyID,
                        ExamID = $examid,
                        PaperID = $PaperID
                        WHERE MQuestionID = $questionID AND StudentID = $studentID";

            // error message when no query found
            $resultwrong = mysqli_query($con, $sqlwrong);
            if(!$resultwrong) {
                $response["error"] = 'Error when updating student answer (wrong) :'.mysqli_error($con);
                echo json_encode($response);
                return;
            }
        }
    }
    echo json_encode($response);

?>