<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have not access to this page.");
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
    <!-- get selected exam details -->
    <?php
        $paperid = $_GET['id'];
        $records = "SELECT * FROM exam_paper WHERE PaperID ='$paperid'";
        $papersql = mysqli_query($con, $records);
        while($row = mysqli_fetch_array($papersql)){
            $papertype = $row['PaperType'];
            $papername = $row['PaperName'];
            $remove = '@\(.*?\)@';
    ?>

    <?php require "common/header_lecturer.php"?>
    
    <!-- Exam paper form -->
    <form class="was-validated" action="lecturer_edit_exampaper_backend.php" method="post">
    <div class="bg d-flex mx-auto flex-column p-5 m-5" style="background-color: #E2F8DB; width: 70%; border-radius: 10px; box-shadow: 3px 3px darkseagreen;">

        <!-- pass paperid to backend -->
        <input type="hidden" name="paperid" value="<?php echo $paperid; ?>" />

        <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
            Edit Examination Paper
        </p>

        <p class="text-uppercase fw-bold main-color m-2">
            Paper Name
        </p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control is-invalid" id="floatingInput" name="papername" placeholder="Paper Name" pattern="[a-zA-Z0-9\s]{1,}" required value = "<?php echo preg_replace($remove,'',$papername)?>">
            <label for="floatingInput">Paper Name</label>
        </div>

        <p class="text-uppercase fw-bold main-color m-2">
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

        <p class="text-uppercase fw-bold main-color m-2">
            Paper Type
        </p>

        <div class="mb-3">
            <select class="form-select" name="papertype" required>
            <option value="MCQ" <?php if($papertype=="MCQ") echo 'selected="selected"'; ?>>Multiple Choice Questions</option>
            <option value="Structured" <?php if($papertype=="Structured") echo 'selected="selected"'; ?>>Structured Questions</option>
            </select>            
        </div>
        <br>

        <div class= "d-flex flex-wrap justify-content-around">
            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "draft" onclick="return confirm('Are you sure to draft exam paper?')">Mark as Draft</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="reset">Discard Changes</button>
            </div>

            <div>
                <button class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" type="submit" name= "submit" value = "create" onclick="return confirm('Are you sure to create exam paper?')">Save as published</button>
            </div>
        </div>
    </div> 
    </form>
    
<!-- footer -->
<?php 
}
include "./common/footer_lecturer.php"
?>
</body>
</html>