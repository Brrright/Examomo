<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // get module id received from module list
    $Classid = $_GET['id'];

    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $moduleresult = mysqli_query($con, $moduleid);

    //sql to get student details
    $sql = "SELECT class.ClassID, class.ClassName, module.ModuleName
            FROM class INNER JOIN module ON class.CompanyID = module.CompanyID
            WHERE class.ClassID = $Classid";

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $cID= $row['ClassID'];
        $cName= $row['ClassName'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    <title>Admin|Admin Edit</title>
</head>
<body>
<?php require "common/header_admin.php"?>
<center><h1 style="font-family: 'Caveat';">Edit Class</h1></center>
<div class="container">
<form class ="was-validated" action="admin_edit_class_backend.php" method="post">
    <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
    <div class="classform">
    <div class="mx-auto" style="width:90%">
    <input type="hidden" name="classid" value = "<?php echo $Classid; ?>"/>
    <p class="text-uppercase fw-bold main-color m-2">
        Class name
        </p>
        <div class="form-floating">
        <input type="text" class="form-control is-invalid" id="floatingInput" name="classname" placeholder="Class Name" required value = "<?php echo $cName?>">
        <label class="text-secondary" for="stu-floatingInput">Class Name</label>
        </div>
        <p class="text-uppercase fw-bold main-color m-2">Related Module</p>
    <select name="adminmodule" id="class-selection-stu" class="form-select fw-light shadow-sm" style="height:58px;" required>
        <?php
            while ($modulerow = mysqli_fetch_array($moduleresult)){
                if ($modulerow['ModuleID'] == $cmodule){
                    echo '<option value = '.$modulerow['ModuleID'].' selected>'.$Modulerow['ModuleName'].'</option>';              
                }
                else{
                    echo '<option value = '.$modulerow['ModuleID'].'>'.$modulerow['ModuleName'].'</option>';
                }
            }
        ?>
    </select>
    <br>
    <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
    
</form>
</body>
</html>
