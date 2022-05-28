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

    <title>Structured Questions</title>
</head>
<body>
    <!-- header -->
    <?php require "common/header_student.php"?>

    <br>
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Structured Questions</h1></center> 
    
    <div class= "row" style="min-height: 450px; margin: auto;">
        <!-- panel for question creation form -->
        <div class="col-xl-7">
            <form class="was-validated" id="question-form">
                <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">
                    <div id="question-content">
                        <!-- --------------------------------------------------------------------- -->
                        <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;">
                            Question Number: <em class="fs-5" style="color: black; font-weight: normal;">(Select a question...)</em>
                        </p>
                        
                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Question Title
                        </p>
                        
                            <div class="form-floating mb-3">
                                <div style="width:100%;height:40px;" class="bg-light"></div>
                            </div>
                        
                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Image (Optional)
                        </p>
                        
                            <div class="form-floating mb-3">
                                <div style="width:100%;height:40px;" class="bg-light"></div>
                            </div>
                        
                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Answer:
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
                        <!-- --------------------------------------------------------------------- -->
                    </div>
                </div>
        </div>

        <div class="col-xl-5">   
            <div class="sticky pt-5">

                <div id="2-button" class="d-flex mx-auto flex-wrap shadow p-3 mb-2" style="background-color: white; width: 80%; border-radius: 15px; ">
                    <button class="stubtn shadow mx-auto" id="save-add-btn" type="submit">Previous Question</button>
                    
                    <button class="stubtn shadow mx-auto fin-mcq-confirm" id="save-finish-btn" type="submit" name="isEnd" value="true">Next Question</button>
                </div>
           
                <div class="bg d-flex flex-wrap mx-auto flex-row p-3 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">
                    <p class="text-uppercase fw-bold" style="color: #aaa;">
                        Questions :
                    </p>

                    <div class="d-flex flex-wrap mx-auto flex-row m-5" id="pagination-part" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">    
                        <!-- <button class="btn btn-outline-secondary me-3" onclick="changeContent(\'filled\','.$data["PaperID"].','.$data["MQuestionID"].')">'.$x.'</button>';
                                
                        <button class="btn btn-outline-secondary me-3"  onclick="changeContent(\'empty\','.$paperid.',null)"> '.$x.'(new) </button>

                        <button class="btn btn-outline-secondary me-3"> 1 </button> -->
                        <a id="1-button" href="#" class="ele-showing stubtn shadow fin-mcq-confirm text-center w-50 mt-3">Finish Exam</a>
                    </div>
                    
                </div>
            </div>
        </div>
</div>

</div>

<script src="js/mingliangJS.js"></script>
    <script>
        function changeContent(form,id,qid) {
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