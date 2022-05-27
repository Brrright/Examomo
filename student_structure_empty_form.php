<?php
    require "common/conn.php";
    require "common/HeadImportInfo.php";

    if (!isset($_GET["id"])) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_exampaper_page.php";</script>';
    }
    
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];
    $quesid = $_GET['question_id'];

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
?>
<?php ob_start(); ?>
        <form action="student_structure_insert_backend.php" method="post">
            <!-- pass question id to backend -->
            <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
            <input type="hidden" name="paper_id" value="<?=$paperid?>">
    
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
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingInput" name="structure_answer" style="min-height:100px;" required ></textarea>
                <label for="floatingInput">Answer here</label>
            </div>
            
            <p class="text-uppercase fw-bold main-color m-2">
                Given Marks: <?=$Marks ?>
            </p>
        </form>
<?php
    $structure_empty_question = ob_get_contents();
    ob_end_clean();
    echo $structure_empty_question;
?>