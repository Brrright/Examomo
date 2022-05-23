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
    if(!$moduleresult) {
        echo "err" .mysqli_error($con);
        return;
    }

    //sql to get student details
    $sql = "SELECT class.ClassID, class.ClassName, module.ModuleID, module.ModuleName
            FROM class INNER JOIN module ON class.CompanyID = module.CompanyID
            WHERE class.ClassID = $Classid";

    $result = mysqli_query($con, $sql);
    if(!$result) {
        echo "err" .mysqli_error($con);
        return;
    }

    while($row = mysqli_fetch_array($result)){
        $cID= $row['ClassID'];
        $cName= $row['ClassName'];
        $module_class = mysqli_query($con, "SELECT * FROM module_class WHERE CompanyID = ".$_SESSION['companyID']." AND ClassID = ".$row['ClassID']."");
            if(!$module_class) {
                echo 'Err' .mysqli_error($con);
                break;
            }

        $moduleIDList = array();
        while ($data_for_module_class = mysqli_fetch_array($module_class)) {
            $ModuleID = $data_for_module_class["ModuleID"];
            array_push($moduleIDList, $ModuleID);
        }
    }




    print_r($moduleIDList);

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
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        $numberOfRecord = count($moduleIDList); //get length
                      foreach ($result as $mod){

                  ?>
                  <input type="checkbox" name="moduleselect[]" <?php for ($x= 0; $x < $numberOfRecord; $x++) { if($mod["ModuleID"] == $moduleIDList[$x]) { ?>checked="true" <?php }} ?> value= <?php echo $mod['ModuleID'];   ?> > <?php echo $mod['ModuleName']; ?></input>
                  <?php
                        }
                    }
                    else{
                        echo "No Module Found";
                    }
                  ?>
    </div>
    <br>
    <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
    
</form>
</div>
</div>
</body>
</html>
