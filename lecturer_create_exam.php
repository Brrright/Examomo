<?php
    require "common/conn.php";
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
?>

<?php
    // get exam paper selection
    $paperid= "SELECT PaperID, PaperName, PaperType, ModuleID FROM exam_paper WHERE LecturerID = '".$_SESSION["userID"]."'";
    $result = mysqli_query($con, $paperid);
?>

<?php
    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $mresult = mysqli_query($con, $moduleid);
    
?>

<?php
    $selectpaper ="SELECT exam_paper.PaperID, exam_paper.PaperName, exam_paper.PaperType, module.ModuleID FROM exam_paper INNER JOIN module ON exam_paper.ModuleID = module.ModuleID WHERE exam_paper.LecturerID = '".$_SESSION["userID"]."'";
    $spaper = mysqli_query($con, $selectpaper);
    // $paperarray = mysqli_fetch_array($spaper);
?>



<!-- <script>
    function getmodule() {
        var m = document.getElementById("moduleselect");
        var getmod = m.value;
        // var sltmodule = value;
        console.log(getmod);
    }
</script> -->

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
        <select name="Moduleid" class="form-select fw-light shadow-sm" style="height:58px;" id="moduleselect"  required>
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
            Exam Name
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="Examname" pattern="[a-zA-Z0-9\s]{1,}" placeholder="ExamName" required>
            <label for="floatingInput">Exam Name</label> 
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
            <input type="datetime-local" placeholder="ExamDateTime" name="Examstarttime" style="width: 100%;" required>
        </div>
        </div>
        <br>

        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Ending Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examendtime" style="width: 100%;" required>
        </div>
        </div>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Paper
        </p>
        
        <select name="Exampaper" id="paperselect" class="form-select fw-light shadow-sm" style="height:58px; PopupHeight: auto;" required>
            <option value="">Please select an Exam paper</option>
            <?php
                while ($paperdata = mysqli_fetch_array($result)) {
                    $paperoption ='<option value ='.$paperdata["PaperID"].'>'.$paperdata["PaperName"].' - '.$paperdata["PaperType"].'</option>';
                    echo $paperoption;
                }
            ?>
        </select>
        <br>
        <h5 style ="font-family: caveat; color: #2B5EA4; font-weight: bold; text-align: right;">*Please ensure Exam paper is created before publishing exam :)</h5>
        <br>
        
        <div class= "d-flex flex-wrap justify-content-around">
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "draft" onclick="return confirm('Are you sure to draft exam?')">Save as Draft</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="reset" onclick ="resetform()">Clear All</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "publish" onclick="return confirm('Are you sure to publish exam?')">Publish</button>
            </div>
        </div>
    </div>
</div>

</form>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type ="text/javascript" src='jquery-3.3.1.min.js'></script>
<script>
    $(document).ready(function()){
        $(#moduleselect).on('change', function()) {
            var mod = $(this).val();


            $.ajax({
                type: 'POST',
                data: {ajax: 1, mod: mod},
                success: function(response){
                    $('#response').text('module: ' + response);
                }
            });
        }
    }
</script> -->

<!-- <script>
var options=""; //store the dynamic options
$("#moduleselect").on('change',function(){
    var value=$(this).val(); //get its selected value
    alert(value);
    while($paperarray = mysqli_fetch_array($spaper)){
        // options="<option>Select Your Name</option>"
        if(value==$paperarray['ModuleID'])
        {
            options='<option value ='.$paperdata["PaperID"].'>'.$paperdata["PaperName"].' - '.$paperdata["PaperType"].'</option>';
            $("#paperselect").html(options);
        }
        else
            $("#paperselect").find('option').remove() //if first default text option is selected empty the select
        }
});
</script> -->

<!-- javascript to clear all fields in form -->
<script>
    function resetform() {
        document.getElementById("examcreate").reset();
    }
</script>

<!-- footer -->
<?php 

include "./common/footer_lecturer.php" ?>
</body>

</html>