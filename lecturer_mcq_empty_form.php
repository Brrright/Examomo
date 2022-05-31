<?php
    require "common/conn.php";
    require "common/HeadImportInfo.php";

    if (!isset($_GET["id"])) {
        echo '<script>alert("You have not selected an exam paper.");
        window.location.href="lecturer_exampaper_page.php";</script>';
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

    ?>

    <?php ob_start(); ?>
    <!-- panel for question creation form -->

    
            <p class="fs-3 fw-bold   main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                Question Details: 
            </p>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Question Title
            </p>
    
            <div class="form-floating mb-3">
                <textarea class="form-control is-invalid" id="floatingInput"  style="min-height:100px;" name="mcq_title" placeholder="Question Title" required></textarea>
                <label for="floatingInput">Question Title</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Insert Image (Optional)
            </p>
    
            <div class="input-group mb-3">
                <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
                <input type="file" class="form-control" name="mcq_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
                <button type="button" onclick="imgremove()">Remove</button>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 1
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid regex-check" id="floatingInput" name="mcq_optionA" placeholder="Option 1" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 1</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 2
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionB" placeholder="Option 2" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 2</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 3
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionC" placeholder="Option 3" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 3</label>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Option 4
            </p>
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control is-invalid" id="floatingInput" name="mcq_optionD" placeholder="Option 4" required pattern="^[-a-zA-Z\d\s.^`~!@#$%\^&*()_+={}|[\]\\:';<>?,./\x22]*">
                <label for="floatingInput">Option 4</label>
            </div>
            
            <p class="text-uppercase fw-bold main-color m-2  ">
                Given Marks
            </p>
    
            <div class="form-floating mb-3">
                <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required>
            </div>
    
            <p class="text-uppercase fw-bold main-color m-2  ">
                Correct Answer
            </p>
    
            <div class="mb-3">
                <select class="form-select" name="mcq_answer" required>
                <option value="">Please select correct answer</option>
                    <option value="0">Option 1</option>
                    <option value="1">Option 2</option>
                    <option value="2">Option 3</option>
                    <option value="3">Option 4</option>
                </select>            
            </div>


<?php
    $mcq_empty = ob_get_contents();
    ob_end_clean();
    echo $mcq_empty;
?>