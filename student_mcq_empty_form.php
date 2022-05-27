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

    $sql ="SELECT MQuestionID, Question, QuestionImage, AnswerDescription, Mark 
    FROM question_multiple_choice
    WHERE PaperID = $paperid AND MQuestionID = $quesid";

$result = mysqli_query($con, $sql);
$rowcount = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)){
    $Title = $row['Question'];
    $Image = $row['QuestionImage'];
    $AnswerArray = $row['AnswerDescription'];
    $Marks = $row['Mark'];
}

$AnswerString = (explode("•", $AnswerArray));

?>

<?php ob_start(); ?>
            <input type="hidden" name="question_id" value="<?=$quesid?>">


            <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;">
                Question Details
            </p>

            <p class="text-uppercase fw-bold main-color m-2  ">
                Question Title:
            </p>
    
            <div class="form-floating mb-3">
                <?=$Title ?>
            </div>
    
            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
            </div>
    
            <div class="form-check">
                <input type="radio" name="mcq_answer" id="flexRadioDefault1" value="0">
                    <label class="form-check-label" for="flexRadioDefault1">
                        <?=$AnswerString[0] ?>
                    </label>
                </div>

            <div class="form-check">
                <input type="radio" name="mcq_answer" id="flexRadioDefault2" value="1">
                    <label class="form-check-label" for="flexRadioDefault2">
                        <?=$AnswerString[1] ?>
                    </label>
            </div>

            <div class="form-check">
                <input type="radio" name="mcq_answer" id="flexRadioDefault3" value="2">
                    <label class="form-check-label" for="flexRadioDefault3">
                        <?=$AnswerString[2] ?>
                    </label>
            </div>

            <div class="form-check">
                <input type="radio" name="mcq_answer" id="flexRadioDefault4" value="3">
                    <label class="form-check-label" for="flexRadioDefault4">
                        <?=$AnswerString[3] ?>
                    </label>
            </div>

            
            <p class="text-uppercase fw-bold main-color m-2  ">
                Marks Given: <?=$Marks ?>
            </p>  

            <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit">Finish</button>
        </form>
<?php
    $mcq_empty_question = ob_get_contents();
    ob_end_clean();
    echo $mcq_empty_question;
?>
