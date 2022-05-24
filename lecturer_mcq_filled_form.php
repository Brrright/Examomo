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

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];

    $pattern = "'[a-zA-Z0-9\s.^`~!@#$%\^&*()_+={}|[\]\\:';><?,./\x22]*'";

    $sql ="SELECT MQuestionID, Question, QuestionImage, AnswerDescription, Mark, CorrectAnswer 
            FROM question_multiple_choice
            WHERE PaperID = $paperid";
    
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
    <div class= "row" style="min-height: 450px; margin: auto;">
    <!-- panel for question creation form -->
    <div class="col-xl-7">
        <form class="was-validated" action="lecturer_create_mcq_backend.php" method="post">
        <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 90%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">
    
            <!-- pass paper id to backend -->
            <input type="hidden" name="paper_id" value="<?=$paperid ?>"/>
    
            <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Number: 
            </p>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Question Title
            </p>
    
            <div class="form-floating mb-3">
                <textarea class="form-control is-invalid" id="floatingInput" name="mcq_title" placeholder="Question Title" required ><?=$Title ?></textarea>
                <label for="floatingInput">Question Title</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Insert Image (Optional)
            </p>
    
            <div class="input-group mb-3">
                <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" name="mcq_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);" value ="<?=$Image ?>">
                <button type="button" onclick="imgremove()">Remove</button>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Option 1
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionA" placeholder="Option 1" value="<?=$AnswerString[0] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 1</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Option 2
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionB" placeholder="Option 2" value="<?=$AnswerString[1] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 2</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Option 3
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionC" placeholder="Option 3" value="<?=$AnswerString[2] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 3</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Option 4
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionD" placeholder="Option 4" value="<?=$AnswerString[3] ?>" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 4</label>
            </div>
            
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Given Marks
            </p>
    
            <div class="form-floating mb-3">
                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required value ="<?=$Marks ?>">
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
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
    
        </div>
        </div>
        <div class="col-xl-5">

    <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: white; width: 90%; border-radius: 10px; box-shadow: 3px 3px darkseagreen; height: 600px; position: relative;">

        <div></div>
        <div class= "d-flex flex-wrap" style="position: absolute; bottom: 0; padding-bottom: 40px;">
            
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value="submit">Save & Add Question</button>

            <div>
                <a href="lecturer_exampaper_page.php"><button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4 fin-mcq-confirm" type="submit" value="submit">Save & Finish</button></a>
            </div>
        </div>

    </div>

    </div>
    </div>
    </form>

<?php
    $mcq_filled = ob_get_contents();
    ob_end_clean();
    echo $mcq_filled;
?>

<script>
    var elems = document.getElementsByClassName('fin-mcq-confirm');
    var confirmIt = function (e) {
        if (!confirm('Are you sure to conclude paper questions?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

<!-- javascript to preview image -->
<script>
    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-img-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }

    
    function imgremove(){
        document.getElementById('file-img-preview').src ="https://www.beelights.gr/assets/images/empty-image.png";
        var inputfile = document.getElementById("file-input");
        inputfile.value ="";
    }
</script>