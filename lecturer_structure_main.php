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
    $sql = "SELECT * FROM question_structure WHERE PaperID = $paperid";
    $sql2 = "SELECT * FROM question_structure WHERE PaperID = $paperid";
    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql);

    if(!$result) {
        echo 'err when fetching structure question'. mysqli_error($con);
    }

    if(!$result2) {
        echo 'err when fetching structure question'. mysqli_error($con);
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
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Create Structure Question</h1></center> 
    
    <div class= "row" style="min-height: 450px; margin: auto;">
        <!-- panel for question creation form -->
        <div class="col-xl-7">
            <form class="was-validated" action="lecturer_structure_insert_backend.php" method="post" id="question-form" enctype="multipart/form-data">
                <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">
                    <!-- pass paper id to backend -->

                    <input type="hidden" name="paper_id" value="<?php echo $paperid;?> "/>
                    <div id="question-content">
                        <?php 
                            if($rowcount > 0) { 
                                echo '<p class="fs-2 fw-bold p-3" style="color: #2B5EA4;" id="no-alert">
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
                                    Given Marks
                                </p>
                                
                                <div class="form-floating mb-3">
                                    <div style="width:100%;height:40px;" class="bg-light"></div>
                                </div>';
                            }
                            else {
                                $dataID = mysqli_fetch_array($result);
                                echo '<p class="fs-3 fw-bold main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                                Question Number: 
                            </p>
                    
                            <p class="text-uppercase fw-bold main-color m-2">
                                Question Title
                            </p>
                    
                            <div class="form-floating mb-3">
                                <textarea class="form-control is-invalid" id="floatingInput" name="structure_title" style="min-height:100px;" placeholder="Question Title" required></textarea>
                                <!-- <label for="floatingInput">Question Title</label> -->
                            </div>
                    
                            <p class="text-uppercase fw-bold main-color m-2">
                                Insert Image (Optional)
                            </p>
                    
                            <div class="input-group mb-3">
                                <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                                <input type="file" class="form-control" name="structure_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                                <button type="button" onclick="imgremove()">Remove</button>
                            </div>
                            
                            <p class="text-uppercase fw-bold main-color m-2">
                                Given Marks
                            </p>
                    
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required>
                            </div>';
                            }
                        ?>
                    </div>
                </div>
        </div>

    <div class="col-xl-5">   
        <div class="sticky pt-5">
            <?php 
            if($rowcount == 0) {
                echo '<div id="2-button" class="d-flex mx-auto flex-wrap shadow p-3 mb-2" style="background-color: white; width: 80%; border-radius: 15px; ">
                <button class="stubtn shadow mx-auto" id="save-add-btn" type="submit">Save & Add Question</button>
                
                <button class="stubtn shadow mx-auto fin-mcq-confirm" id="save-finish-btn" type="submit" name="isEnd" value="true">Save & Finish</button>
            </div>';
            }
            else {
                echo '<div id="2-button" class="d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-not-showing" style="background-color: white; width: 80%; border-radius: 15px; ">
                <button class="stubtn shadow mx-auto" id="save-add-btn" type="submit">Save & Add Question</button>
                
                <button class="stubtn shadow mx-auto fin-mcq-confirm" id="save-finish-btn" type="submit" name="isEnd" value="true">Save & Finish</button>
            </div>';
            }
            ?>

            
    </form>

            <div class="bg d-flex flex-wrap mx-auto flex-row p-5 m-5 shadow p-3 mb-5" id="pagination-part" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">
                <?php 
                $x = 1;
                if($rowcount > 0) { 
                    while($data = mysqli_fetch_array($result2)) {
                        $button = '<button class="btn btn-outline-secondary me-3" onclick="changeContent(\'filled\','.$data["PaperID"].','.$data["SQuestionID"].')">'.$x.'</button>';
                        $x++;
                        echo $button;
                    }
                    echo '<button class="btn btn-outline-secondary me-3"  onclick="changeContent(\'empty\','.$paperid.',null)"> '.$x.'(new) </button>';
                }
                else {
                    echo  "<button class=\"btn btn-outline-secondary me-3\"> 1 </button>";
                }
                ?>
            </div>
            <?php  
                if(!$rowcount == 0) {
                    echo '<a id="1-button" href="lecturer_exampaper_page.php" class="mb-2 ele-showing stubtn shadow fin-mcq-confirm text-center w-50 mt-3">Finish</a>';   
                }
            ?>
        </div>
    </div>

</div>

<script src="js/mingliangJS.js"></script>
    <script>
        function changeContent(form,id,qid) {
            const checkAlert = !!document.getElementById('no-alert');
            console.log(checkAlert)
            if (checkAlert == false) {
                console.log(checkAlert)
                Swal.fire({
                title: 'Do you save the changes',
                text: "Please save the changes first (if you have made any) before you go to another question. Are you sure you have save the current changes?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('2-button').setAttribute("class", "d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-showing");
                    document.getElementById('1-button').setAttribute("class", "ele-not-showing");
    
                    if (form == "empty") {
                        var path = "lecturer_structure_empty_form.php?id="+id;
                    }
                    else if(form == "filled") {
                        var path = "lecturer_structure_filled_form.php?id=" +id+"&question_id="+qid;
                    }
                    else {
                        alert("no form specified");
                    }
                    updateTable(path, 'question-content');
                }
                }) 
            }
            else {
                document.getElementById('2-button').setAttribute("class", "d-flex mx-auto flex-wrap shadow p-3 mb-2 ele-showing");
                    document.getElementById('1-button').setAttribute("class", "ele-not-showing");
    
                    if (form == "empty") {
                        var path = "lecturer_structure_empty_form.php?id="+id;
                    }
                    else if(form == "filled") {
                        var path = "lecturer_structure_filled_form.php?id=" +id+"&question_id="+qid;
                    }
                    else {
                        alert("no form specified");
                    }
                    updateTable(path, 'question-content');
            }
            
        }
    </script>
    
<script>
    var elems = document.getElementsByClassName('fin-mcq-confirm');
    var confirmIt = function (e) {
        if (!confirm('Are you sure to conclude paper questions? If you are not able to conclude it, please click the last question\'s button and click "save and finish" button')) e.preventDefault();
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
</body>
</html>