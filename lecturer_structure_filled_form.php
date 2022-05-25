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
    <div class= "row" style="min-height: 450px; margin: auto;">
    <!-- panel for question creation form -->
    <div class="col-xl-7">
        <form class="was-validated" action="lecturer_structure_insert_backend.php" method="post" enctype="multipart/form-data">
        <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 90%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">
    
            <!-- pass paper id to backend -->
            <input type="hidden" name="paper_id" value="<?=$paperid ?>"/>

            <!-- pass question id to backend -->
            <input type="hidden" name="question_id" value="<?=$quesid ?>"/>
    
            <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Number: 
            </p>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Question Title
            </p>
    
            <div class="form-floating mb-3">
                <textarea class="form-control is-invalid" id="floatingInput" name="structure_title" placeholder="Question Title" required ><?=$Title ?></textarea>
                <label for="floatingInput">Question Title</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Insert Image (Optional)
            </p>
    
            <div class="input-group mb-3">
                <img src = '<?=$Image ?>' id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" name="structure_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                <button type="button" onclick="imgremove()">Remove</button>
            </div>
            
            <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                Given Marks
            </p>
    
            <div class="form-floating mb-3">
                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required value ="<?=$Marks ?>">
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