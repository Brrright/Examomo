<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

?>

<?php
    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $mresult = mysqli_query($con, $moduleid);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 
    
    <title>Lecturer Manage Exam Paper</title>
</head>
<body>
    <?php require "common/header_lecturer.php"?>
    
    <form class="was-validated" action="lecturer_create_exampaper_backend.php" method="post">
    <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 70%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">

        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Create Examination Paper
        </p>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Paper Name
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="papername" placeholder="Paper Name" pattern="[a-zA-Z0-9\s]{1,}" required>
            <label for="floatingInput">Paper Name</label>
        </div>

        <p class="text-uppercase fw-bold main-color m-2 font-caveat">
            Module Name
        </p>

        <select name="Moduleid" class="form-select fw-light shadow-sm" style="height:58px;" id="moduleselect" required>
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
            Paper Type
        </p>

        <div class="mb-3">
            <select class="form-select" name="papertype" required>
            <option value="">Please select paper type</option>
            <option value="MCQ">Multiple Choice Questions</option>
            <option value="Structured">Structured Questions</option>
            </select>            
        </div>

        <br>
        <h5 style ="font-family: caveat; color: #2B5EA4; font-weight: bold; text-align: right;">*Clicking Save & Add Questions will draft your exam paper.</h5>
        <br>

        <div class= "d-flex flex-wrap justify-content-around">
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "draft" onclick="return confirm('Are you sure to draft exam paper?')">Save as Draft</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name="submit" value="addques">Save & Add Questions</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "create" onclick="return confirm('Are you sure to create exam paper?')">Create Paper</button>
            </div>
        </div>
    </div> 
    </form>

    
    
<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>
</html>