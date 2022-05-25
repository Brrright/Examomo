<?php
   require "common/conn.php";

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


    if (isset($_POST['question_id'])) {
        $QuestionID = $_POST['question_id'];
        if(!file_exists($_FILES['structure_image']['tmp_name']) || !is_uploaded_file($_FILES['structure_image']['tmp_name'])) {

            //Convert all to have special chars
            $Title = $_POST['structure_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="UPDATE question_structure SET
                    Question = '$stringtitle',
                    Mark = '$_POST[givenmarks]',
                    PaperID = $PaperID,
                    CompanyID = $companyID
                    WHERE PaperID = '$PaperID' AND SQuestionID = '$QuestionID'";

            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    echo '<script>alert("One question updated successfully.");
                    window.location.href = "lecturer_structure_main.php?id='.$PaperID.'";
                    </script>';
                    } 

                }
        // update with image
        else{
            $upload_dir = "img/questionimg/";
            $target_file = $upload_dir . basename($_FILES["structure_image"]["name"]);

            $i = 1;
            while (file_exists($target_file)) {

                $target_file = $upload_dir .$i. basename($_FILES["structure_image"]["name"]);
                $i++;
            }

                move_uploaded_file($_FILES["structure_image"]["tmp_name"], $target_file);

            //Convert all to have special chars
            $Title = $_POST['structure_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="UPDATE question_structure SET
                    Question = '$stringtitle',
                    QuestionImage = '$target_file',
                    Mark = '$_POST[givenmarks]',
                    PaperID = $PaperID,
                    CompanyID = $companyID
                    WHERE PaperID = '$PaperID' AND SQuestionID = '$QuestionID'";

            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    echo '<script>alert("One question updated successfully.");
                    window.location.href = "lecturer_structure_main.php?id='.$PaperID.'";
                    </script>';
                    } 

                }
        
    }


    else{

        // insert new without file
        if(!file_exists($_FILES['structure_image']['tmp_name']) || !is_uploaded_file($_FILES['structure_image']['tmp_name'])) {

            //Convert all to have special chars
            $Title = $_POST['structure_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="INSERT INTO question_structure (Question, QuestionImage, Mark, PaperID, CompanyID)
            VALUES('$stringtitle', NULL, '$_POST[givenmarks]', $PaperID, $companyID)";

            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    echo '<script>alert("One question created successfully.");
                    window.location.href = "lecturer_structure_main.php?id='.$PaperID.'";
                    </script>';
                    } 

            }

        // insert new with file
        else{
            $upload_dir = "img/questionimg/";
            $target_file = $upload_dir . basename($_FILES["structure_image"]["name"]);

            $i = 1;
            while (file_exists($target_file)) {

                $target_file = $upload_dir .$i. basename($_FILES["structure_image"]["name"]);
                $i++;
            }

                move_uploaded_file($_FILES["structure_image"]["tmp_name"], $target_file);


            //Convert all to have special chars
            $Title = $_POST['structure_title'];
            $stringtitle = htmlspecialchars($Title);

            $sql ="INSERT INTO question_structure (Question, QuestionImage, Mark, PaperID, CompanyID)
            VALUES('$stringtitle', '$target_file', '$_POST[givenmarks]', $PaperID, $companyID)";

            if(!mysqli_query($con, $sql)) {
                echo 'Error:'.mysqli_error($con);
                // echo json_encode($response);

            }
                else {
                    echo '<script>alert("One question created successfully.");
                    window.location.href = "lecturer_structure_main.php?id='.$PaperID.'";
                    </script>';
                    } 

                }
    }
?>