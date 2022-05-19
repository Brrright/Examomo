<?php

    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
?>

<?php
    // get exam paper selection
    $paperid= "SELECT PaperID, PaperName, PaperType, ModuleID FROM exam_paper WHERE LecturerID =".$_SESSION["userID"]."";
    $result = mysqli_query($con, $paperid);

?>

<?php
    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $mresult = mysqli_query($con, $moduleid);
    
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
    $records = "SELECT * FROM exam WHERE ExamID ='$examid'";
    $editexamresult = mysqli_query($con, $records);
    while($row = mysqli_fetch_array($editexamresult)){
        $starttime = date("Y-m-d\TH:i:s", strtotime($row['ExamStartDateTime']));
        $endtime = date("Y-m-d\TH:i:s", strtotime($row['ExamEndDateTime']));

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
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Module Name
        </p>
        <select name="Moduleid" class="form-select fw-light shadow-sm" style="height:58px;" id="moduleselect" required>

            <!-- get previous selected module -->
            <?php
                while ($mdata = mysqli_fetch_array($mresult)) {
                if ($row['ModuleID'] == $mdata['ModuleID']){
                    echo '<option value ='.$mdata["ModuleID"].' selected>'.$mdata["ModuleName"].'</option>';                   
                }
                
                else {
                    echo'<option value ='.$mdata["ModuleID"].'>'.$mdata["ModuleName"].'</option>';                    
                }
            }
            ?>
            
        </select>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Name
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="Examname" placeholder="ExamName" pattern="[a-zA-Z0-9\s]{1,}" required value = "<?php echo $row['ExamName']?>">
            <label for="floatingInput">Exam Name</label> 
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Description
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name= "Examdesc"placeholder="ExamDescription" required value = "<?php echo $row['ExamDescription']?>">
            <label for="floatingInput">Exam Description</label> 
        </div>

        <div class="row g-5">
        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Starting Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examstarttime" style="width: 100%;" required value = "<?php echo $starttime; ?>">
        </div>
        </div>
        <br>

        <div class="col-sm-6">
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Ending Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examendtime" style="width: 100%;" required value = "<?php echo $endtime; ?>">
        </div>
        </div>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Paper
        </p>
        <select name="Exampaper" class="form-select fw-light shadow-sm" style="height:58px;" id="paperselect" required>

            <!-- get previous selected exam paper -->
            <?php
            while ($data = mysqli_fetch_array($result)) {
                if ($data['PaperID'] == $row['PaperID']){
                    echo '<option value ='.$data["PaperID"].' selected>'.$data["PaperName"].' - '.$data["PaperType"].'</option>';                   
                }
                
                else {
                    echo'<option value ='.$data["PaperID"].'>'.$data["PaperName"].' - '.$data["PaperType"].'</option>';                    
                }
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
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="reset" onclick="resetform()">Reset</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "publish" onclick="return confirm('Are you sure to publish exam?')">Publish</button>
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
</script>

<!-- footer -->
<?php 
}
include "./common/footer_lecturer.php" ?>
</body>

</html>