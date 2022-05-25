<!-- <?php
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

    
?> -->

<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        require "common/HeadImportInfo.php" 
    ?>
    <link rel="stylesheet" href="css/weestyle.css">
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
<div class="col-xl-7" id="question-content">
    <form class="was-validated" action="lecturer_create_mcq_backend.php" method="post">
    <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 10px;">

        <!-- pass paper id to backend -->
        <input type="hidden" name="paper-id" value="<?php echo $paperid;?> "/>

        <p class="fs-2 fw-bold p-3" style="color: #2B5EA4;">
            Question Number: <em class="fs-5" style="color: black; font-weight: normal;">(Select a question...)</em>
        </p>

        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
            Question Title
        </p>

            <div class="form-floating mb-3">
                <div style="width:100%;height:40px;" class="bg-light"></div>
                <!-- <textarea class="form-control is-invalid" id="floatingInput" name="mcq-title" placeholder="Question Title" required></textarea>
                <label for="floatingInput">Question Title</label> -->
            </div>

        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
            Insert Image (Optional)
        </p>

            <div style="width:100%;height:40px;" class="bg-light"></div>
            <!-- <div class="input-group mb-3">
                <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" name="mcq-image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                <button type="button" onclick="imgremove()">Remove</button>
            </div> -->

        
        <p class="text-uppercase fw-bold main-color m-2" style="color: #aaa;">
            Given Marks
        </p>

            <div class="form-floating mb-3">
                <div style="width:100%;height:40px;" class="bg-light"></div>
                <!-- <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required> -->
            </div>



    </div>
    </div>

<div class="col-xl-5">

    <div class="bg d-flex mx-auto flex-column p-5 m-5 shadow p-3 mb-5" style="background-color: white; width: 90%; border-radius: 15px; height: 600px; position: relative;">
    </div>
        <div class="d-flex mx-auto flex-wrap shadow p-3 mb-5" style="background-color: white; width: 70%; border-radius: 15px;">
            <button class="stubtn shadow mx-auto" type="submit" name= "submit" value="submit">Save & Add Question</button>
            
            <a href="lecturer_exampaper_page.php" class="stubtn shadow mx-auto fin-mcq-confirm" type="submit" value="submit">Save & Finish</a>
        </div>
    </div>

</div>

</div>
</div>
</form>

<script src="js/mingliangJS.js"></script>
    <script>
        function changeContent(id) {
            var path = "lecturer_structure_filled_form.php?id=" +id;
            updateTable(path, 'question-content')
        }
    </script>
    
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