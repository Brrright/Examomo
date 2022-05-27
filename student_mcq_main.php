<!DOCTYPE html>
<html lang="en">
<head>

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
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Student | Exam MCQ</title>
</head>
<body>
    <!-- header -->
    <?php require "common/header_student.php"?>

    <br>
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Create Multiple Choice Question</h1></center> 

<div class= "row" style="min-height: 450px; margin: auto;">
<!-- panel for question creation form -->
    <div class="col-xl-7" >
            <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">
                <input type="hidden" name="paper_id" value="<?php echo $paperid;?>">
                <div id="question-content">
                    <!-- --------------------------------------------------------------------- -->
                    <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;" id="no-submit">
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
                        
    <form class="was-validated" id="questionFormID">
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
                        Your Answer
                    </p>

                    <div class="mb-3">
                        <div style="width:100%;height:70px;" class="bg-light"></div>
                    </div>
                <!-- ------------------------------------------------------------------------ -->
                </div>
            </div>
    </div>

    <div class="col-xl-5">   
        <div class="sticky pt-5">
            <div class="bg d-flex flex-wrap mx-auto flex-row p-5  shadow p-3 mb-5" id="pagination-part" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">
                <?php 
                $x = 1;
                if($rowcount > 0) { 
                    while($data = mysqli_fetch_array($result2)) {
                        $button = '<button type="submit" id="SWITCH'.$data["PaperID"].'-'.$data["MQuestionID"].'" class="btn btn-outline-secondary me-3">'.$x.'</button>';
                        $x++;
                        echo $button;
                    }
                }
                else {
                    echo  "No question created OwO";
                }
                ?>
            </div>
            <a href="student_exam_list.php" class="mb-2 ele-showing stubtn shadow fin-mcq-confirm text-center w-50 mt-3">Finish</a>
        </div>
    </div>
    </form>
</div>


<script src="js/mingliangJS.js"></script>
<script>
    var clickedID = "";
    const onClick = (event) => {
        event.preventDefault();
        clickedID = event.srcElement.id;
        if(clickedID.substring(0,6)=="SWITCH") {
            var splitID = clickedID.substring(6).split("-");
            var paperID = splitID[0];
            var questionID = splitID[1];
            if (event.target.nodeName === 'BUTTON') {
                console.log(splitID)
                console.log(clickedID)
                if(document.getElementById("no-submit")) {
                    // no need submit the current form (its blank)
                    // console.log(clickedID) //SWITCH14-20
                        changeContent(paperID, questionID)
                }
                else {
                    submitForm(paperID, questionID)
                }
            }
        }
        
    }

    window.addEventListener('click', onClick);

    const questionForm = document.getElementById("questionFormID");
    questionForm.addEventListener("submit", function(event){
        event.preventDefault();
        if(clickedID.substring(0,6)=="SWITCH") {
            var splitID = clickedID.substring(6).split("-");
            var paperID = splitID[0];
            var questionID = splitID[1];
            // console.log(splitID)
            if(document.getElementById("no-submit")) {
                // no need submit the current form (its blank)
                // console.log(clickedID) //SWITCH14-20
                changeContent(paperID, questionID)
            }else {
                console.log("NEED SUBMIT"+splitID)
            }
        }
    })

    function submitForm(p_id, q_id) {
        var form = document.getElementById('questionFormID');
        // console.log(form)
        // var formData = new FormData(form)
        var form_data = Object.fromEntries(new FormData(form).entries());
        console.log(form_data)
        
        // need submit the form
        fetch("student_mcq_backend.php", {
            method: "POST",
            header: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(form_data)
        })
        .then(function(res) {
            return response => response.json()
        })
        .then(function(response) {
            if(!response.error) {
                changeContent(p_id,q_id)
            }
            else {
                console.log(response.error)
            }
        })
    }
        
    function changeContent(id,qid) {
        var path = "student_mcq_form?id=" +id+"&question_id="+qid;
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
<?php include "./common/footer_student.php"?>
<br><br><br><br>
</body>
</html>