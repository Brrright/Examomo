<!-- EMPTY DIV WITH AN ID, PAGINATION, 2 BUTTON -->

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

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    
    // get paper id after exam paper creation
    $paperid = $_GET['id'];

?>

    <?php ob_start(); ?>
        <p class="fs-3 fw-bold   main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Question Number: 
        </p>

        <p class="text-uppercase fw-bold main-color m-2  ">
            Question Title
        </p>

        <div class="form-floating mb-3">
            <textarea class="form-control is-invalid" id="floatingInput" style="min-height:100px;" name="structure_title" placeholder="Question Title" required></textarea>
            <!-- <label for="floatingInput">Question Title</label> -->
        </div>

        <p class="text-uppercase fw-bold main-color m-2  ">
            Insert Image (Optional)
        </p>

        <div class="input-group mb-3">
            <img src="https://www.beelights.gr/assets/images/empty-image.png" id="file-img-preview" style="height: 400px; width: 100%; margin-bottom: 20px;">
            <input type="file" class="form-control" name="structure_image" id="file-input" accept="image/png, image/gif, image/jpeg" onchange="showPreview(event);">
            <button type="button" onclick="imgremove()">Remove</button>
        </div>
        
        <p class="text-uppercase fw-bold main-color m-2  ">
            Given Marks
        </p>

        <div class="form-floating mb-3">
            <input type="number" class="form-control is-invalid" id="floatingInput" name="givenmarks" placeholder="Given Marks" min="1" required>
        </div>

<?php
    $mcq_empty = ob_get_contents();
    ob_end_clean();
    echo $mcq_empty;
?>