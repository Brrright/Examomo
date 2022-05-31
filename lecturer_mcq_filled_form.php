<?php
    require "common/conn.php";

    if (!isset($_GET["id"])) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_exampaper_page.php";</script>';
    }

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

    $pattern = "'[a-zA-Z0-9\s.^`~!@#$%\^&*()_+={}|[\]\\:';><?,./\x22]*'";

    $sql ="SELECT MQuestionID, Question, QuestionImage, AnswerDescription, Mark, CorrectAnswer 
            FROM question_multiple_choice
            WHERE PaperID = $paperid AND MQuestionID = $quesid";
    
    $result = mysqli_query($con, $sql);
    $rowcount = mysqli_num_rows($result);

    while ($row = mysqli_fetch_array($result)){
        $Title = $row['Question'];
        $Image = $row['QuestionImage'];
        $AnswerArray = $row['AnswerDescription'];
        $CorrectAns = $row['CorrectAnswer'];
        $Marks = $row['Mark'];

    }
    
    $AnswerString = (explode("•", $AnswerArray));

    ?>
    <?php ob_start(); ?>
            <input type="hidden" name="question_id" value="<?=$quesid?>">
            <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;">
                Question Details
            </p>

            <div class="d-flex flex-row-reverse">
                <a href="lecturer_mcq_delete_backend.php?paper=<?=$paperid ?>&id=<?=$quesid?>" onclick="return confirm('Are you sure to delete this question?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
            </div>

            <p class="text-uppercase fw-bold main-color m-2  ">
                Question Title
            </p>
    
            <div class="form-floating mb-3">
                <textarea class="form-control is-invalid" id="floatingInput" name="mcq_title" style="min-height:100px;" placeholder="Question Title" required ><?=$Title ?></textarea>
                <label for="floatingInput">Question Title</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Insert Image (Optional)
            </p>
            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" style="width:30px" name="mcq_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                <button type="button" onclick="imgremove()">Remove</button>
            </div>
            <p class="text-center" style="color: #aaa;">
                "The image will remain the same unless it get removed or updated."
            </p>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 1
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionA" placeholder="Option 1" value="<?=$AnswerString[0] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 1</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 2
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionB" placeholder="Option 2" value="<?=$AnswerString[1] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 2</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 3
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionC" placeholder="Option 3" value="<?=$AnswerString[2] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 3</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 4
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionD" placeholder="Option 4" value="<?=$AnswerString[3] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 4</label>
            </div>
            
            <p class="text-uppercase fw-bold main-color m-2  ">
                Given Marks
            </p>
    
            <div class="form-floating mb-3">
                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required value ="<?=$Marks ?>">
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Correct Answer
            </p>
    
            <div class="mb-3">
                <select class="form-select" name="mcq_answer" required>
                <option value="">Please select correct answer</option>
                    <option value="0" <?php if($CorrectAns =="0") echo "selected='selected'"; ?>>Option 1</option>
                    <option value="1" <?php if($CorrectAns =="1") echo "selected='selected'"; ?>>Option 2</option>
                    <option value="2" <?php if($CorrectAns =="2") echo "selected='selected'"; ?>>Option 3</option>
                    <option value="3" <?php if($CorrectAns =="3") echo "selected='selected'"; ?>>Option 4</option>
                </select>            
            </div>
    


<?php
    $mcq_filled = ob_get_contents();
    ob_end_clean();
    echo $mcq_filled;
?>
