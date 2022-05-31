<?php
    require "common/conn.php";
     // identify if user logged in
     if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }

    // get exam paper selection
    $paperid= "SELECT PaperID, PaperName, PaperType, ModuleID FROM exam_paper WHERE LecturerID = '".$_SESSION["userID"]."'";
    $result = mysqli_query($con, $paperid);

    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $mresult = mysqli_query($con, $moduleid);

    // get class details
    $classid = "SELECT * FROM class WHERE CompanyID = ".$_SESSION['companyID']."";
    $cresult = mysqli_query($con, $classid);

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Manage Exam</title>

  </head>
<body>

<!-- header -->
<?php require "common/header_lecturer.php"?>

<!-- Exam Creation Form -->
<form class="was-validated" action ="lecturer_create_exam_backend.php" method ="post" id="examcreate">

<div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 70%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">
    <div class="examform">
        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Create Examination
        </p>
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Module Name
        </p>
        <select name="Moduleid" class="form-select fw-light shadow-sm" style="height:58px;" id="moduleselect" onChange="GainRelatedExamPaper()" required>
            <option value="">Please select a Module</option>
            <!-- get previous selected module -->
            <?php
                while ($mdata = mysqli_fetch_array($mresult)) {
                    $moduleoption ='<option value ='.$mdata["ModuleID"].'>'.$mdata["ModuleName"].'</option>';
                    echo $moduleoption;
            }
            ?>
        </select>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Class Name
        </p>
        <select name="Classid" class="form-select fw-light shadow-sm" style="height:58px;" id="classselect" required>
            <option value="">Please select a Class</option>
            <!-- get previous selected class -->
            <?php
                while ($cdata = mysqli_fetch_array($cresult)) {
                    $classoption ='<option value ='.$cdata["ClassID"].'>'.$cdata["ClassName"].'</option>';
                    echo $classoption;
                }
            ?>
        </select>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Name
        </p>
        <div class="form-floating mb-3"  id="name-field">
            <input type="text" v-model="name" @keyup="checkName()" class="form-control is-invalid" id="floatingInput" name="Examname" pattern="[a-zA-Z0-9\s]{1,}" placeholder="ExamName" required>
            <label for="floatingInput">Exam Name</label> 
            <span class="text-danger" v-bind:id="[isAvailable?'notavailable':'available']">{{responseMessage}}</span>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Description
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name= "Examdesc"placeholder="ExamDescription" maxlength="100" required>
            <label for="floatingInput">Exam Description</label> 
        </div>

        <div class="row g-5">
        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Starting Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examstarttime" id="Startdatetime" style="width: 100%; height: 58px;" required onchange="checkDate()"/>
        </div>
        </div>
        <br>

        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Ending Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examendtime" id="Enddatetime" style="width: 100%; height: 58px;" required onchange="checkDate()"/>
        </div>
        </div>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Paper
        </p>
        
        <select name="Exampaper" id="paperselect" class="form-select fw-light shadow-sm" style="height:58px; PopupHeight: auto;" required disabled>
            <option value="">Please select an Exam paper <b>[select a module to activate]</b></option>
        </select>
        
        <br>
        <h5 style ="font-family: caveat; color: #2B5EA4; font-weight: bold; text-align: right;">*Please ensure Exam paper is created before publishing exam :)</h5>
        <br>
        
        <div class= "d-flex flex-wrap justify-content-around">
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4 stubtn" id="submit-btn1" type="submit" name= "submit" value = "draft" onclick="return confirm('Are you sure to draft exam?')">Save as Draft</button>
            </div>
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4 stubtn" id="submit-btn2" type="submit" name= "submit" value = "publish" onclick="return confirm('Are you sure to publish exam?')">Publish</button>
            </div>
        </div>
    </div>
</div>

</form>


<!-- javascript to clear all fields in form -->

<script src="js/mingliangJS.js"></script>
<script src="https://unpkg.com/vue@2"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

    function GainRelatedExamPaper() {
        var selection = document.getElementById('moduleselect');
        var selectedOption = selection.options[selection.selectedIndex].value;

        var paperSelection = document.getElementById('paperselect');
        if (selectedOption == "") {
            updateTable("lecturer_get_paper_from_module.php?moduleID="+"nodata",'paperselect');
            paperSelection.setAttribute('disabled','');
            return;
        }

        // console.log(selectedOption);
        updateTable("lecturer_get_paper_from_module.php?moduleID="+selectedOption, 'paperselect');

        // remove paperselect's disabled
        paperSelection.removeAttribute('disabled');
    }

    function resetform() {
        document.getElementById("examcreate").reset();
    }

    function checkDate() {
        var dateString = document.getElementById('Startdatetime').value;
        var dateString2 = document.getElementById('Enddatetime').value;
        var DateStart = new Date(dateString);
        var DateEnd = new Date(dateString2);
        if (DateEnd < DateStart) {
            alert("End date time cannot be less than Start date time.");
            document.getElementById("Startdatetime").value = null;
            document.getElementById("Enddatetime").value = null;
            return false;
        }
        return true;
    }

</script>
<script>
    var app = new Vue({
        el: '#name-field',
        data: {
            name: '',
            isAvailable: 0,
            responseMessage: ''
        },
        methods: {
            checkName: function(){
                var name = this.name.trim();
                if(name != ''){
            
                axios.get('backend_check_name.php?action=exam', {
                    params: {
                        name: name
                    }
                })
                .then(function (response) {
                    app.isAvailable = response.data;
                    if(response.data == 0){
                    app.responseMessage = "";
                    document.getElementById("submit-btn1").disabled = false;
                    document.getElementById("submit-btn2").disabled = false;
                    }else{
                    app.responseMessage = "Name Has been used.";
                    }
                })
                .then(function() {
                    var checkEmail = document.getElementById("notavailable");
                    if (checkEmail != null) {
                    document.getElementById("submit-btn1").disabled = true;
                    document.getElementById("submit-btn2").disabled = true;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

                }else{
                    this.responseMessage = "";
                    
                }
            }
        }
    })
</script>
<?php 
include "./common/footer_lecturer.php" ?>
</body>

</html>