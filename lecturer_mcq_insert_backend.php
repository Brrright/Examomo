
<?php
    require "common/conn.php";
    if (!isset($_POST)) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_exampaper_page.php";</script>';
    }
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $PaperID =$_POST['paper_id'];
    $companyID = $_SESSION['companyID'];


    if (isset($_POST['question_id'])){
        $QuestionID =$_POST['question_id'];
        if(!file_exists($_FILES['mcq_image']['tmp_name']) || !is_uploaded_file($_FILES['mcq_image']['tmp_name'])) {

            $stringAnswerDescription = $_POST['mcq_optionA']."•".$_POST['mcq_optionB']."•".$_POST['mcq_optionC']."•".$_POST['mcq_optionD'];
            $stringanswer = htmlspecialchars($stringAnswerDescription);

            //Convert all to have special chars
            $Title = $_POST['mcq_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="UPDATE question_multiple_choice SET
                Question = '$stringtitle',
                AnswerDescription = '$stringanswer',
                Mark = '$_POST[givenmarks]',
                CorrectAnswer = '$_POST[mcq_answer]',
                PaperID = $PaperID,
                CompanyID = $companyID
                WHERE PaperID = '$PaperID' AND MQuestionID = '$QuestionID'";  
            
            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    if (isset($_POST["isEnd"])) {
                        echo '<script>alert("One question updated successfully.");
                                window.location.href = "lecturer_exampaper_page.php";
                                </script>';
                    }
                    else {
                        echo '<script>alert("One question updated successfully.");
                        window.location.href = "lecturer_mcq_main.php?id='.$PaperID.'";
                        </script>';
                    } 
                }
        }
        else {
            $upload_dir = "img/questionimg/";
            $target_file = $upload_dir . basename($_FILES["mcq_image"]["name"]);
        
            $i = 1;
            while (file_exists($target_file)) {
        
                $target_file = $upload_dir .$i. basename($_FILES["mcq_image"]["name"]);
                $i++;
            }
        
                move_uploaded_file($_FILES["mcq_image"]["tmp_name"], $target_file);


            $stringAnswerDescription = $_POST['mcq_optionA']."•".$_POST['mcq_optionB']."•".$_POST['mcq_optionC']."•".$_POST['mcq_optionD'];
            $stringanswer = htmlspecialchars($stringAnswerDescription);

            //Convert all to have special chars
            $Title = $_POST['mcq_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="UPDATE question_multiple_choice SET
                Question = '$stringtitle',
                QuestionImage = '$target_file',
                AnswerDescription = '$stringanswer',
                Mark = '$_POST[givenmarks]',
                CorrectAnswer = '$_POST[mcq_answer]',
                PaperID = $PaperID,
                CompanyID = $companyID
                WHERE PaperID = '$PaperID' AND MQuestionID = '$QuestionID'";
            
            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    if (isset($_POST["isEnd"])) {
                        echo '<script>alert("One question updated successfully.");
                                window.location.href = "lecturer_exampaper_page.php";
                                </script>';
                    }
                    else {
                        echo '<script>alert("One question updated successfully.");
                        window.location.href = "lecturer_mcq_main.php?id='.$PaperID.'";
                        </script>';
                    }
                    } 
            }
    }




    else{
   // insert new question
        if(!file_exists($_FILES['mcq_image']['tmp_name']) || !is_uploaded_file($_FILES['mcq_image']['tmp_name'])) {

            $stringAnswerDescription = $_POST['mcq_optionA']."•".$_POST['mcq_optionB']."•".$_POST['mcq_optionC']."•".$_POST['mcq_optionD'];


            $sql ="INSERT INTO question_multiple_choice (Question, QuestionImage, AnswerDescription, Mark, CorrectAnswer,PaperID, CompanyID)
            VALUES('$_POST[mcq_title]', NULL, '$stringAnswerDescription', '$_POST[givenmarks]','$_POST[mcq_answer]', $PaperID, $companyID)";

            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    echo '<script>alert("One question created successfully.");
                    window.location.href = "lecturer_mcq_main.php?id='.$PaperID.'";
                    </script>';
                    } 
            }
            else {
            $upload_dir = "img/questionimg/";
            $target_file = $upload_dir . basename($_FILES["mcq_image"]["name"]);
        
            $i = 1;
            while (file_exists($target_file)) {
        
                $target_file = $upload_dir .$i. basename($_FILES["mcq_image"]["name"]);
                $i++;
            }
        
                move_uploaded_file($_FILES["mcq_image"]["tmp_name"], $target_file);
            
            
            $stringAnswerDescription = $_POST['mcq_optionA']."•".$_POST['mcq_optionB']."•".$_POST['mcq_optionC']."•".$_POST['mcq_optionD'];
                $stringanswer = htmlspecialchars($stringAnswerDescription);
            
            //Convert all to have special chars
            $Title = $_POST['mcq_title'];
            $stringtitle = htmlspecialchars($Title);
            
            
            $sql ="INSERT INTO question_multiple_choice (Question, QuestionImage, AnswerDescription, Mark, CorrectAnswer,PaperID, CompanyID)
            VALUES('$stringtitle', '$target_file', '$stringanswer', '$_POST[givenmarks]','$_POST[mcq_answer]', $PaperID, $companyID)";
            
            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
            
            }
                else {
                    if (isset($_POST["isEnd"])) {
                        echo '<script>alert("One question updated successfully.");
                                window.location.href = "lecturer_exampaper_page.php";
                                </script>';
                    }
                    else {

                        echo '<script>alert("One question created successfully.");
                        window.location.href = "lecturer_mcq_main.php?id='.$PaperID.'";
                        </script>';
                    }
                } 
            }
    }

?>
