<?php 
        require "common/conn.php";
        if (!isset($_GET["id"])) {
            echo '<script>alert("You have not selected an exam paper.");
            window.location.href="lecturer_completed_exam_list.php";</script>';
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

    <title>Structured Questions</title>
</head>
<body>
    <!-- header -->
    <?php require "common/header_lecturer.php"?>

    <br>
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Mark Structured Questions</h1></center> 
    
    <div class= "row" style="min-height: 450px; margin: auto;">
        <!-- panel for question creation form -->
        <div class="col-xl-7">
            <form class="was-validated" id="questionFormID">
                <input type="hidden" name="eid" value="<?php echo $_GET["eid"]?>">
                <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">
                    <div id="question-content">
                        <!-- --------------------------------------------------------------------- -->
                        <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;"  id="no-submit">
                            Question Number: <em class="fs-5" style="color: black; font-weight: normal;">(Select a question...)</em>
                        </p>
                        
                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Question Title
                        </p>
                        
                            <div class="form-floating mb-3">
                                <div style="width:100%;height:40px;" class="bg-light"></div>
                            </div>
                        
                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Image
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
                            Allocated Marks
                        </p>
                        
                        <div class="form-floating mb-3">
                            <div style="width:100%;height:40px;" class="bg-light"></div>
                        </div>    

                        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
                            Marks Given
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
                <div class="bg d-flex flex-wrap mx-auto flex-row p-5  shadow p-3 mb-5" id="pagination-part" style="background-color: white; width: 90%; border-radius: 15px; height: auto; position: relative;">
                    <?php 
                    $x = 1;
                    if($rowcount > 0) { 
                        echo '<button type="submit" id="save-btn" name="why" value="why" class="btn btn-primary me-3" style="display:none"> Save </button>';
                        while($data = mysqli_fetch_array($result2)) {
                            $button = '<button type="submit" name="question-'.$data["SQuestionID"].'" value="question-'.$data["SQuestionID"].'" id="SWITCH'.$data["PaperID"].'-'.$data["SQuestionID"].'" class="btn btn-outline-secondary me-3">'.$x.'</button>';
                            $x++;
                            echo $button;
                        }
                    }
                    else {
                        echo  "No question created OwO";
                    }
                    ?>
                </div>
                <button type="submit" id="finish-btn" class="mb-2 ele-showing stubtn shadow text-center w-50 mt-3" onclick="confirmExit()">Finish</button>
            </div>
        </div>
            </form>
    </div>

<script src="js/mingliangJS.js"></script>
    <script>
        const studentID = <?php echo $_GET['stuid']; ?>;
        function confirmExit() {
        Swal.fire({
            title: 'Finished marking?',
            text: "Are you sure to finish marking this exam paper?",
            icon: 'warning',
            padding: '3em',
            background: '#fff url() ',
            backdrop: `
            rgba(0,0,0,0.4)
            `,
            imageUrl: 'img/Vho.gif',
            imageWidth: 300,
            imageHeight: 280,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I have completed marking.'
        }).then((result) => {
        if (result.isConfirmed) {
            const saveBtn = document.getElementById("save-btn");
            saveBtn.click()
            // window.location.href="student_exam_list.php";
        }
        })                
      }

    var clickedID = "";
    const onClick = (event) => {
        clickedID = event.srcElement.id;
        if(clickedID.substring(0,6)=="SWITCH") {
            var splitID = clickedID.substring(6).split("-");
            var paperID = splitID[0];
            var questionID = splitID[1];
            if (event.target.nodeName === 'BUTTON') {
                changeContent(paperID, questionID)
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
                console.log("submitting")
                const form_data = Object.fromEntries(new FormData(event.target).entries());
                fetch("lecturer_marking_backend.php", {
                    method: "POST",
                    header: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(form_data)
                })
                .then(function(res) {
                    return res.json()
                })
                .then(function(response) {
                    if(!response.error) {
                        changeContent(paperID,questionID)
                    }
                    else {
                        console.log(response.error)
                    }
                })
            }
        } else if (clickedID == "save-btn") {
            if(document.getElementById("no-submit")) {
                // no need submit the current form (its blank)
                // console.log(clickedID) //SWITCH14-20
                window.location.href="lecturer_completed_exam_list.php";
            }
            console.log("submitting")
            const form_data = Object.fromEntries(new FormData(event.target).entries());
            fetch("lecturer_marking_backend.php", {
                method: "POST",
                header: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(form_data)
            })
            .then(function(res) {
                return res.json()
            })
            .then(function(response) {
                if(!response.error) {
                    console.log(response)
                    // window.location.href="lecturer_completed_exam_list.php";
                }
                else if(response.error == 0) {
                    console.log(response)
                    // window.location.href="lecturer_completed_exam_list.php";
                }
                else {
                    console.log(response.error)
                }
            })
        }
        else {
            return;
        }
    })

 
    function changeContent(id,qid) {
        var path = "lecturer_marking_form?id=" +id+"&question_id="+qid+"&studentid="+studentID;
        updateTable(path, 'question-content');
    }

    </script>
    

<!-- footer -->
<?php include "common/footer_lecturer.php"?>
</body>
</html>