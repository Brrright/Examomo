<?php
    require "common/conn.php";
    require "common/HeadImportInfo.php";

     // identify if user logged in
     if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];
    $quesid = $_GET['question_id'];
    $studentid = $_GET['studentid'];

    $sql ="SELECT SQuestionID, Question, QuestionImage, Mark
            FROM question_structure
            WHERE PaperID = '$paperid' AND SQuestionID = '$quesid'";
    
    $result = mysqli_query($con, $sql);
    $rowcount = mysqli_num_rows($result);

    while ($row = mysqli_fetch_array($result)){
        $Title = $row['Question'];
        $Image = $row['QuestionImage'];
        $Marks = $row['Mark'];
    }

    $existsql ="SELECT * FROM student_answer
                WHERE SQuestionID = $quesid AND StudentID = $studentid AND PaperID = $paperid";
    $existquery = mysqli_query($con, $existsql);

    $existrow = mysqli_fetch_array($existquery);
    if ($existrow != NULL) {
        $studentanswer = $existrow['Answer'];

        if ($existrow['markReceived'] != NULL){
            $Marked = $existrow['markReceived'];
        }
        else {
            $Marked = "";
        }
    }
    else {
        $studentanswer = "(NOT ANSWERED)";
        $Marked = 0;
    }

    ob_start(); 
?>
    <form action="student_structure_insert_backend.php" method="post">
        <!-- pass question id to backend -->
        <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
        <input type="hidden" name="paper_id" value="<?=$paperid?>">
        <input type="hidden" name="student_id" value="<?=$studentid?>">

        <p class="fs-3 fw-bold main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Question Details
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

        <p class="text-uppercase fw-bold main-color m-2">
            Answer: 
        </p>

        <div class="form-floating mb-3">
            <?=$studentanswer ?>
        </div>
        <br>
        
        <p class="text-uppercase fw-bold main-color m-2">
            Allocated Marks: <?=$Marks ?>
        </p>

        <p class="text-left" style="color: #aaa;">
                "Marks given cannot exceed allocated marks or set below 0."
        </p>
        <br>

        <label for="mark">Marks Given:</label>
        <input type="number" id="mark" name="givenmark" min="0" max="<?=$Marks ?>" value ="<?=$Marked?>">

<?php
    $structure_question = ob_get_contents();
    ob_end_clean();
    echo $structure_question;

?>