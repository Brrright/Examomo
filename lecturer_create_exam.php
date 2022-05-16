<?php

    // identify if user logged in
    session_start();

    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    require "common/conn.php";

    // get exam paper selection
    $paperid= "SELECT PaperID, PaperName, PaperModule FROM exam_paper WHERE LecturerID = '".$_SESSION["userID"]."'";
    $result = mysqli_query($con, $paperid);
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

    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
        var forms = document.getElementsByClassName("needs-validation");
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener("submit", function(event) {
                if (!form.checkValidity() === false){
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");           
            }, false);
        });
        }, false);
    })();
    </script>

  </head>
<body>

<!-- header -->
<?php require "common/header_lecturer.php"?>

<!-- Exam Creation Form -->
<form action ="lecturer_create_exam_backend.php" method ="post" id="examcreate">

<div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 70%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">
    <div class="examform">
        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Create Examination
        </p>
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Module Name
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="Modulename" placeholder="ModuleName" required>
            <label for="floatingInput">Module Name</label> 
        </div>
        <div class = "invalid-feedback">
            Must have Module name
        </div>  

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Name
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="Examname" placeholder="ExamName" required>
            <label for="floatingInput">Exam Name</label> 
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Description
        </p>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name= "Examdesc"placeholder="ExamDescription" required>
            <label for="floatingInput">Exam Description</label> 
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Starting Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examstarttime" required>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Ending Date & Time
        </p>
        <div class="form datetime">
            <input type="datetime-local" placeholder="ExamDateTime" name="Examendtime" required>
        </div>
        <br>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Exam Paper
        </p>
        <select name="Exampaper" class="form-select fw-light shadow-sm" style="height:58px; PopupHeight: auto;" required>
            <option>Please select an Exam paper</option>
            <?php
                while ($data = mysqli_fetch_array($result)) {
                    $paperoption ='<option value ='.$data["PaperID"].'>'.$data["PaperName"].' - '.$data["PaperModule"].'</option>';
                    echo $paperoption;
                }
            ?>
        </select>
        <br>
        <h5 style ="font-family: caveat; text-align: right;">*Please ensure Exam paper is created before publishing exam :)</h5>
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

<!-- javascript to clear all fields in form -->
<script>
    function resetform() {
        document.getElementById("examcreate").reset();
    }
</script>


<!-- javascript for form validation
<script>
    $('submit').click(function() {

        var name = $("Examname").val();
        var module = $("Modulename").val();
        var desc = $("Examdesc").val();
        var start = $("Examstarttime").val();
        var end = $("Examendtime").val();
        var paper = $("Exampaper").val();

        if(name =='' || module =='' || desc =='' || start =='' || end =='' || paper =='') {

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="">Why do I have this issue?</a>'
            })
        };
    });
</script> -->

<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>

</html>