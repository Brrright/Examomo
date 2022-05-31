<?php
    require "common/conn.php";
    require "common/HeadImportInfo.php";

    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];
    $quesid = $_GET['question_id'];

    $sql ="SELECT SQuestionID, Question, QuestionImage, Mark
            FROM question_structure
            WHERE PaperID = '$paperid' AND SQuestionID = '$quesid'";
    
    $result = mysqli_query($con, $sql);
    $rowcount = mysqli_num_rows($result);
    
    if(!$result) {
        echo 'err when fetching structure question'. mysqli_error($con);
    }

    $row = mysqli_fetch_array($result);
        $Title = $row['Question'];
        $Image = $row['QuestionImage'];
        $Marks = $row['Mark'];


    $existsql ="SELECT * FROM student_answer
            WHERE SQuestionID = $quesid AND StudentID = ".$_SESSION['userID']." AND PaperID = $paperid";
    $existquery = mysqli_query($con, $existsql);

    if (mysqli_num_rows($existquery) == 0){
    ob_start(); 
 ?>

            <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
            <input type="hidden" name="paper_id" value="<?=$paperid?>">
    
            <p class="fs-3 fw-bold main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Details
            </p>
            <p class="text-uppercase fw-bold  m-2  text-end">
                Marks Given: <?=$Marks ?>
            </p>  
            <p class="text-uppercase fw-bold main-color m-2">
                Question Title: 
            </p>
    
            <div class="form-floating mb-3">
                <?=$Title ?>
            </div>

            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;" onerror="this.style.display='none'">
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingInput" name="structure_answer" style="min-height:100px;" ></textarea>
                <label for="floatingInput">Answer here</label>
            </div>
            
            
<?php
    $structure_empty_question = ob_get_contents();
    ob_end_clean();
    echo $structure_empty_question;
    }

    else {
        $existrow = mysqli_fetch_array($existquery);
        if ($existrow != NULL) {
            $studentanswer = $existrow['Answer'];
        }
        else {
            $studentanswer = "";
        }
        ob_start(); 
?>

            <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
            <input type="hidden" name="paper_id" value="<?=$paperid?>">
    
            <p class="fs-3 fw-bold main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Details
            </p>
            <p class="text-uppercase fw-bold  m-2  text-end">
                Marks Given: <?=$Marks ?>
            </p>  
    
            <p class="text-uppercase fw-bold main-color m-2">
                Question Title: 
            </p>
    
            <div class="form-floating mb-3">
                <?=$Title ?>
            </div>

            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;" onerror="this.style.display='none'">
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingInput" name="structure_answer" style="min-height:100px;" ><?=$studentanswer ?></textarea>
                <label for="floatingInput">Answer here</label>
            </div>
            
<?php
    $str_empty_question = ob_get_contents();
    ob_end_clean();
    echo $str_empty_question;
    }
?>