<?php
    require "common/conn.php";

    if (!isset($_GET["id"])) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_exampaper_page.php";</script>';
    }

    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Create Questions</title>
</head>
<body>
    <!-- header -->
    <?php require "common/header_lecturer.php"?>

    <br>
    <center><h1 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Create Multiple Choice Question</h1></center> 

<div class= "row" style="min-height: 450px; margin: auto;">
<!-- panel for question creation form -->
<div class="col-xl-7">
    <form class="was-validated" action="lecturer_create_mcq_backend.php" method="post">
    <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 90%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">

        <!-- pass paper id to backend -->
        <input type="hidden" name="paper-id" value="<?php echo $paperid;?> "/>

        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Question Number: 
        </p>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Question Title
        </p>

        <div class="form-floating mb-3">
            <textarea class="form-control is-invalid" id="floatingInput" name="mcq-title" placeholder="Question Title" required></textarea>
            <!-- <label for="floatingInput">Question Title</label> -->
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Insert Image (Optional)
        </p>

        <div class="input-group mb-3">
            <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 10vw; width: 10vh; margin-bottom: 20px;">
            <input type="file" class="form-control" name="mcq-image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
            <button type="button" onclick="imgremove()">Remove</button>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Option 1
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq-option" placeholder="Option 1" required>
            <label for="floatingInput">Option 1</label>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Option 2
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq-option" placeholder="Option 2" required>
            <label for="floatingInput">Option 2</label>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Option 3
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq-option" placeholder="Option 3" required>
            <label for="floatingInput">Option 3</label>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Option 4
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq-option" placeholder="Option 4" required>
            <label for="floatingInput">Option 4</label>
        </div>
        
        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Given Marks
        </p>

        <div class="form-floating mb-3">
            <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Correct Answer
        </p>

        <div class="mb-3">
            <select class="form-select" name="mcq-answer" required>
            <option value="">Please select correct answer</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>            
        </div>

    </div>
</div>

<div class="col-xl-5">

<div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: white; width: 90%; border-radius: 10px; box-shadow: 3px 3px darkseagreen; height: 600px; position: relative;">
    
    <div></div>
    <div class= "d-flex flex-wrap" style="position: absolute; bottom: 0; padding-bottom: 40px;">
        
        <div>
            <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" onclick="return confirm('Do you wish to save current question?')">Add Question</button>
            
            <div>
                <a href="lecturer_exampaper_page.php"><button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4 fin-mcq-confirm">Finish</button></a>
            </div>
        </div>
        
    </div>
    
</div>
</div>
</form>


    
<script>
    var elems = document.getElementsByClassName('fin-mcq-confirm');
    var confirmIt = function (e) {
        if (!confirm('Are you sure to conclude paper questions?')) e.preventDefault();
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