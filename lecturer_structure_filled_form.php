<?php
    require "common/conn.php";

    if (!isset($_GET["id"])) {
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
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];
    $quesid = $_GET['question_id'];

    $pattern = "'[a-zA-Z0-9\s.^`~!@#$%\^&*()_+={}|[\]\\:';><?,./\x22]*'";

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

    // $AnswerString = (explode("•", $AnswerArray));

    ?>
    <?php ob_start(); ?>
    <!-- panel for question creation form -->
            <!-- pass question id to backend -->
            <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
    
            <p class="fs-3 fw-bold main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Details
            </p>

            <div class="d-flex flex-row-reverse">
                <a href="lecturer_structure_delete_backend.php?paper=<?=$paperid ?>&id=<?=$quesid?>" onclick="return confirm('Are you sure to delete this question?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2">
                Question Title
            </p>
    
            <div class="form-floating mb-3">
                <textarea class="form-control is-invalid" id="floatingInput" name="structure_title" style="min-height:100px;" placeholder="Question Title" required ><?=$Title ?></textarea>
                <label for="floatingInput">Question Title</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2">
                Insert Image (Optional)
            </p>
    
            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" name="structure_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                <button type="button" onclick="imgremove()">Remove</button>
            </div>
            <p class="text-center" style="color: #aaa;">
                "The image will remain the same unless it get removed or updated."
            </p>
            
            <p class="text-uppercase fw-bold main-color m-2">
                Given Marks
            </p>
    
            <div class="form-floating mb-3">
                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required value ="<?=$Marks ?>">
            </div>
    
<?php
    $structure_filled = ob_get_contents();
    ob_end_clean();
    echo $structure_filled;
?>