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
        $examID = $_GET['eid'];
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

        $sql3 = "SELECT exam.ExamEndDateTime FROM question_multiple_choice 
                INNER JOIN exam ON question_multiple_choice.PaperID = exam.PaperID WHERE question_multiple_choice.PaperID = $paperid  AND exam.isPublished = 1 AND exam.ExamID = $examID";

        $sqlquery = mysqli_query($con,$sql3);
        if(!$sqlquery) {
            echo 'err when fetching mcq and exam question'. mysqli_error($con);
        }

        $examDetails = mysqli_fetch_array($sqlquery);
        $examEndDate = $examDetails["ExamEndDateTime"];
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
    <div class="d-flex justify-content-evenly">
    <div class="profilecontainer main-color h3 m-0 p-2" id="timer"><div class="spinner-grow text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

</div>
        <h1 class="text-center" style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Multiple Choice Question</h1>
        <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" id="addFB" data-bs-toggle="dropdown" aria-expanded="false" style="display:block; margin-right: 15%; margin-left:auto;">Add New Feedback</button>
        <form class="dropdown-menu p-4 shadow p-3 mb-5" id="feedbackForm" aria-labelledby="addFB" style="width: 100%">
        <!-- <form class="dropdown-menu p-4 shadow p-3 mb-5" action="student_feedback_insert_backend.php" method="POST" aria-labelledby="addFB" style="width: 60%"> -->
            <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="fb_content" placeholder="Enter feedback here..." required>
            <br>
            <div class= "d-flex flex-wrap justify-content-around">
            <button type="submit" class="btn btn-primary" style="border:none;">Submit</button>
            </div>
        </form>
    </div>
    </div>

<div class= "row" style="min-height: 450px; margin: auto;">
<!-- panel for question creation form -->
    <div class="col-xl-7">
        <form class="was-validated" id="questionFormID">
            <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">
                <input type="hidden" name="exam_id" value="<?php echo $examID;?>">

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
                    
                    <input type="hidden" name="paper_id" value="<?php echo $paperid;?>">

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
                        echo '<button type="submit" id="save-btn" name="why" value="why" class="btn btn-primary me-3" style="display:none"> Save </button>';
                        while($data = mysqli_fetch_array($result2)) {
                            $button = '<button type="submit" name="question-'.$data["MQuestionID"].'" value="question-'.$data["MQuestionID"].'" id="SWITCH'.$data["PaperID"].'-'.$data["MQuestionID"].'" class="btn btn-outline-secondary me-3">'.$x.'</button>';
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
     window.addEventListener("load", onloadAgreement) 
     async function onloadAgreement(){
        const { value: accept } = await Swal.fire({
        title: 'Honesty is the best policy',
        input: 'checkbox',
        imageUrl: 'img/lecturer/exampaper.jpg',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        imageAlt: 'Custom image',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        inputValue: 1,
        inputPlaceholder:
            'I understand and wish to continue',
        confirmButtonText:
            'Continue <i class="fa fa-arrow-right"></i>',
        inputValidator: (result) => {
            return !result && 'You need to agree in order to take the exam'
        }
        })

        if (accept) {
                let timerInterval
            Swal.fire({
                title: 'Goodluck with your exam :)',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
            }
    }
    var numOfSwitchTab = 0;
    document.addEventListener("visibilitychange", function() {
        // console.log(document.hidden);
        if (document.visibilityState != "visible") {
        numOfSwitchTab = numOfSwitchTab + 1;

        if (numOfSwitchTab == 1){
            console.log("1");
        }
        else if (numOfSwitchTab == 2) {
            console.log("2");
        }
        else if (numOfSwitchTab == 3) {
            console.log("3");
            const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'warning',
            title: 'Are you cheating?'
            })
        }
        else if (numOfSwitchTab == 4) {
            let timerInterval
            Swal.fire({
            icon: 'warning',
            title: 'You break the rules!',
            html: 'Find admin to activate your account again, Good Bye!.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href="logout.php"
            }
            })
        }
        }
    });

    var countDownDate = <?php echo strtotime($examEndDate); ?> * 1000;
    //This is the get current time or change to get clicked
    
    // Update the count down every 1 second
    var Timerinterval = setInterval(function() {
        var Timernow =  new Date().getTime();
        // console.log("end: " +countDownDate + ", now:" + Timernow);

        
        // Find the distance between now an the count down date
        var Timerdistance = countDownDate - Timernow;
        Timerdistance = Timerdistance - 28800000;
        
        // Time calculations for days, hours, minutes and seconds
        var Timerdays = Math.floor(Timerdistance / (1000 * 60 * 60 * 24));
        var Timerhours = Math.floor((Timerdistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var Timerminutes = Math.floor((Timerdistance % (1000 * 60 * 60)) / (1000 * 60));
        var Timerseconds = Math.floor((Timerdistance % (1000 * 60)) / 1000);

        // Output the result in an element with id="timer"
        document.getElementById("timer").innerHTML = Timerdays + "d " + Timerhours + "h " +
        Timerminutes + "m " + Timerseconds + "s ";
        
        // If the count down is over, write some text 
        if (Timerdistance < 0) {
            clearInterval(Timerinterval);
            document.getElementById("timer").innerHTML = "Time over";
            let timerInterval
            Swal.fire({
            title: 'Time\'s up!',
            html: 'Good job! I will close in <b></b> milliseconds.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href="student_exam_list.php"
            }
            })
        }
        
    }, 1000);

    const feedback_Form = document.getElementById("feedbackForm")
    feedback_Form.addEventListener("submit", function(event){
        event.preventDefault();
        const form_data_object = Object.fromEntries(new FormData(event.target).entries());
        console.log(form_data_object)
        fetch("student_feedback_backend.php", {
            method: "POST",
            header: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(form_data_object)
        })
        .then(function(res) {
            return res.json()
        })
        .then(function(response) {
            if(!response.error) {
                Swal.fire({
                    title: "Feedback sent Successfully",
                    icon: "success",
                    text: "We will reply the feedback as soon as possible! Thanks for reporting!",
                    showConfirmButton: false,
                    timer:1500
                })
            }
            else {
                Swal.fire({
                    title: "Oops...Login failed.",
                    icon: "error",
                    text: response.error
                })
                return;
            }
        })
    })

    function confirmExit() {
        Swal.fire({
            title: 'Wait a second, are you sure?',
            text: "You can always join back when the exam is still ongoing !",
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
            confirmButtonText: 'Yes, I have done the exam!'
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
                fetch("student_mcq_backend.php", {
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
                window.location.href="student_exam_list.php";
            }
            console.log("submitting")
            const form_data = Object.fromEntries(new FormData(event.target).entries());
            fetch("student_mcq_backend.php", {
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
                    // console.log(response)
                    window.location.href="student_exam_list.php";
                }
                else if(response.error == 0) {
                    // console.log(response)
                    window.location.href="student_exam_list.php";
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