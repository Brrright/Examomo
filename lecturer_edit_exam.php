<?php

    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // get exam paper selection
    $paperid= "SELECT PaperID, PaperName, PaperType, ModuleID FROM exam_paper WHERE LecturerID =".$_SESSION["userID"]."";
    $result = mysqli_query($con, $paperid);


    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $mresult = mysqli_query($con, $moduleid);
    
    // get class details
    $classid ="SELECT class.ClassID, class.ClassName FROM lecturer_module 
        INNER JOIN module_class ON lecturer_module.ModuleID = module_class.ModuleID
        INNER JOIN class ON module_class.ClassID = class.ClassID
        WHERE lecturer_module.CompanyID =".$_SESSION['companyID']." AND lecturer_module.LecturerID =".$_SESSION['userID']."";
    $cresult = mysqli_query($con, $classid);

    // get 
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Manage Exam</title>

  </head>
<body>

<!-- get selected exam details -->
<?php
    $examid = $_GET['id'];
    $records = "SELECT * FROM exam
                INNER JOIN exam_class ON exam.ExamID = exam_class.ExamID 
                WHERE exam.ExamID ='$examid'";
    $editexamresult = mysqli_query($con, $records);
    while($row = mysqli_fetch_array($editexamresult)){
        $starttime = date("Y-m-d\TH:i:s", strtotime($row['ExamStartDateTime']));
        $endtime = date("Y-m-d\TH:i:s", strtotime($row['ExamEndDateTime']));
        $modid = $row['ModuleID'];
        $class = $row['ClassID'];
        $examname = $row['ExamName'];
        $examdesc = $row['ExamDescription'];
        $paperselect = $row['PaperID'];
    }
?>

<!-- header -->
<?php require "common/header_lecturer.php"?>

<!-- Exam Creation Form -->
<form class="was-validated createexamform" action ="lecturer_edit_exam_backend.php" method ="post" id="examcreate">

<!-- send exam id to backend -->
<input type="hidden" name="examid" value="<?php echo $examid; ?>" />

<div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 70%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">
    <div class="examform">
        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Edit Examination
        </p>
        <p class="text-uppercase fw-bold main-color m-2">
            Module Name
        </p>
        <select name="Moduleid" class="form-select fw-light shadow-sm" style="height:58px;" id="moduleselect" required>

            <!-- get previous selected module -->
            <?php
                while ($mdata = mysqli_fetch_array($mresult)) {
                if ($modid == $mdata['ModuleID']){
                    echo '<option value ='.$mdata["ModuleID"].' selected>'.$mdata["ModuleName"].'</option>';                   
                }
                
                else {
                    echo'<option value ='.$mdata["ModuleID"].'>'.$mdata["ModuleName"].'</option>';                    
                }
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
                    if ($class == $cdata['ClassID']){
                        echo '<option value ='.$cdata["ClassID"].' selected>'.$cdata["ClassName"].'</option>';
                    }

                    else {
                        echo '<option value ='.$cdata["ClassID"].'>'.$cdata["ClassName"].'</option>';
                    }
                }
            ?>
        </select>

        <p class="text-uppercase fw-bold main-color m-2">
            Exam Name
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="Examname" placeholder="ExamName" pattern="[a-zA-Z0-9\s]{1,}" required value = "<?php echo $examname; ?>">
            <label for="floatingInput">Exam Name</label> 
        </div>

        <p class="text-uppercase fw-bold main-color m-2">
            Exam Description
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name= "Examdesc"placeholder="ExamDescription" required value = "<?php echo $examdesc; ?>">
            <label for="floatingInput">Exam Description</label> 
        </div>

        <div class="row g-5">
        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2">
            Exam Starting Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examstarttime" id="Startdatetime" style="width: 100%; height: 58px;" required value = "<?php echo $starttime; ?>" onchange="checkDate()">
        </div>
        </div>
        <br>

        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2">
            Exam Ending Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examendtime" id="Enddatetime" style="width: 100%; height: 58px;" required value = "<?php echo $endtime; ?>" onchange="checkDate()">
        </div>
        </div>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2">
            Exam Paper
        </p>
        <select name="Exampaper" class="form-select fw-light shadow-sm" style="height:58px;" id="paperselect" required>
            <!-- get previous selected exam paper -->
            <?php
            while ($data = mysqli_fetch_array($result)) {
                if ($data['PaperID'] == $paperselect){
                    echo '<option value ='.$data["PaperID"].' selected>'.$data["PaperName"].' - '.$data["PaperType"].'</option>';                   
                }
                
                else {
                    echo'<option value ='.$data["PaperID"].'>'.$data["PaperName"].' - '.$data["PaperType"].'</option>';                    
                }
            }
            ?>
            
        </select>
        <br>
        <h5 style ="color: #2B5EA4; font-weight: bold; text-align: right; font-family: caveat;">*Please ensure Exam paper is created before publishing exam :)</h5>
        <br>
        
        <div class= "d-flex flex-wrap justify-content-around">
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "draft" onclick="return confirm('Are you sure to draft exam?')">Mark as Draft</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="reset" onclick="resetform()">Discard Changes</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "publish" onclick="return confirm('Are you sure to publish exam?')">Save as published</button>
            </div>
        </div>
    </div>
</div>

</form>

<!-- javascript to reset all fields in form -->
<script>
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
            document.getElementById("Startdatetime").value = "<?php echo $starttime; ?>";
            document.getElementById("Enddatetime").value = "<?php echo $endtime; ?>";
            return false;
        }
        return true;
    }
</script>

<!-- footer -->
<?php 

include "./common/footer_lecturer.php" ?>
</body>

</html>