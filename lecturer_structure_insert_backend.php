<?php
   require "common/conn.php";

    $PaperID =$_POST['paper_id'];
    $companyID = $_SESSION['companyID'];

    $upload_dir = "img/questionimg/";
    $target_file = $upload_dir . basename($_FILES["structure_image"]["name"]);
    $uOk = 1;

    if(file_exists($target_file))
    {
        echo "That File Already Exist";
        $uOk = 0;
    }

    if ($uOk == 0) {
        echo "Your file was not uploaded.<br>";
        return;
    } 
    else{
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
            window.location.href = "lecturer_structure_filled_form.php";
            </script>';
            } 

    }

?>