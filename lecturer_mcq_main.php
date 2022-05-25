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
    $sql = "SELECT * FROM question_multiple_choice WHERE PaperID = $paperid";
    $sql2 = "SELECT * FROM question_multiple_choice WHERE PaperID = $paperid";

    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql);

    if(!$result) {
        echo 'err when fetching mcq question'. mysqli_error($con);
    }

    if(!$result2) {
        echo 'err when fetching mcq question'. mysqli_error($con);

    }
    $rowcount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        require "common/HeadImportInfo.php" 
    ?>
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Create Questions</title>
</head>
<body>
    <!-- header -->
    <?php require "common/header_lecturer.php"?>

    <br>
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Create Multiple Choice Question</h1></center> 

<div class= "row" style="min-height: 450px; margin: auto;">
<!-- panel for question creation form -->
    <div class="col-xl-7" >
        <!-- <form class="was-validated" id="question-form"> -->
        <form class="was-validated" action="lecturer_mcq_insert_backend.php" method="post" id="question-form" enctype="multipart/form-data">
        <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">

            <!-- pass paper id to backend -->
            <input type="hidden" name="paper_id" value="<?php echo $paperid;?>">
            <div id="question-content">
                <?php 
                if($rowcount > 0) { 
        // if got record, display blank as default, user have to select specific question to view, or add new question
                    echo '<p class="fs-2 fw-bold p-3" style="color: #2B5EA4;">
                        Question Number: <em class="fs-5" style="color: black; font-weight: normal;">(Select a question...)</em>
                    </p>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Question Title
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Insert Image (Optional)
                    </p>

                        <div style="width:100%;height:40px;" class="bg-light"></div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Option 1
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Option 2
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Option 3
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Option 4
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>
                    
                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Given Marks
                    </p>

                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>

                    <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                        Correct Answer
                    </p>

                        <div class="mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>';
                    }
                    else {
                        $dataID = mysqli_fetch_array($result);
                        //if no data at all, empty form, receive user input
                        echo '<p class="fs-3 fw-bold   main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                                Question Number: 
                            </p>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Question Title
                            </p>
                    
                            <div class="form-floating mb-3">
                                <textarea class="form-control is-invalid" id="floatingInput" name="mcq_title" style="min-height:40px;" placeholder="Question Title" required></textarea>
                                <label for="floatingInput">Question Title</label>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Insert Image (Optional)
                            </p>
                    
                            <div class="input-group mb-3">
                                <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                                <input type="file" class="form-control" name="mcq_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                                <button type="button" onclick="imgremove()">Remove</button>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Option 1
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-invalid regex-check" id="floatingInput" name="mcq_optionA" placeholder="Option 1" required pattern="^[-a-zA-Z\\d\\s.^`~!@#$%\\^&*()_+={}|[\\]\\\:\';<>?,./\\x22]*">
                                <label for="floatingInput">Option 1</label>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Option 2
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionB" placeholder="Option 2" required pattern="^[-a-zA-Z\\d\\s.^`~!@#$%\\^&*()_+={}|[\\]\\\:\';<>?,./\\x22]*">
                                <label for="floatingInput">Option 2</label>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Option 3
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionC" placeholder="Option 3" required pattern="^[-a-zA-Z\\d\\s.^`~!@#$%\\^&*()_+={}|[\\]\\\:\';<>?,./\\x22]*">
                                <label for="floatingInput">Option 3</label>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Option 4
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionD" placeholder="Option 4" required pattern="^[-a-zA-Z\\d\\s.^`~!@#$%\\^&*()_+={}|[\\]\\\:\';<>?,./\\x22]*">
                                <label for="floatingInput">Option 4</label>
                            </div>
                            
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Given Marks
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required>
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2  ">
                                Correct Answer
                            </p>
                    
                            <div class="mb-3">
                                <select class="form-select" name="mcq_answer" required>
                                <option value="">Please select correct answer</option>
                                    <option value="0">Option 1</option>
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select>            
                            </div>';
                    }
                ?>
            </div>
            

        </div>
    </div>

    <div class="col-xl-5">   
        <div class="sticky pt-5">
            <div id="2-button" class="d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-not-showing" style="background-color: white; width: 80%; border-radius: 15px; ">
                <button class="stubtn shadow mx-auto" id="save-add-btn" type="submit">Save & Add Question</button>
                <!-- <button class="stubtn shadow mx-auto" type="submit" name= "submit" value="submit">Save & Add Question</button> -->
                
                <button class="stubtn shadow mx-auto fin-mcq-confirm" id="save-finish-btn" type="submit" name="isEnd" value="true">Save & Finish</button>
                <!-- <a href="lecturer_exampaper_page.php" class="stubtn shadow mx-auto fin-mcq-confirm" type="submit" value="submit">Save & Finish</a> -->
            </div>

            
    </form>
            <!-- <div  class="d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-showing" style="background-color: white; width: 70%; border-radius: 15px;"> -->
                        <a id="1-button" href="lecturer_exampaper_page.php" class="mb-2 ele-showing stubtn shadow fin-mcq-confirm text-center w-50">Finish</a>
            <!-- </div> -->

            <!-- move -->
            <div class="bg d-flex flex-wrap mx-auto flex-row p-5 m-5 shadow p-3 mb-5" id="pagination-part" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">
                <?php 
                $x = 1;
                if($rowcount > 0) { 
                    while($data = mysqli_fetch_array($result2)) {
                        $button = '<button class="btn btn-secondary rounded-circle me-3" onclick="changeContent(\'filled\','.$data["PaperID"].','.$data["MQuestionID"].')">'.$x.'</button>';
                        $x++;
                        echo $button;
                    }
                    echo '<button class="btn btn-secondary rounded-circle me-3"  onclick="changeContent(\'empty\','.$paperid.',null)"> '.$x.' </button>';
                }
                else {
                    echo  "<button> 1 </button>";
                }
                ?>
            </div>
        </div>
    </div>

</div>


<script src="js/mingliangJS.js"></script>
<script>

        // add new form?

        function changeContent(form,id,qid) {
            document.getElementById('2-button').setAttribute("class", "d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-showing");
            document.getElementById('1-button').setAttribute("class", "ele-not-showing");

            if (form == "empty") {
                var path = "lecturer_mcq_empty_form.php?id="+id;
            }
            else if(form == "filled") {
                var path = "lecturer_mcq_filled_form.php?id=" +id+"&question_id="+qid;
            }
            else {
                alert("no form specified");
            }
            updateTable(path, 'question-content');
        }
    </script>
    
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
<!-- footer -->
<?php include "./common/footer_lecturer.php"?>
<br><br><br><br>
</body>
</html>