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

    // get admin id from url
    $lectid = $_GET['id'];

    $sql = "SELECT lecturer.LecturerID, lecturer.LecturerName, lecturer.LecturerGender, lecturer.LecturerEmail, lecturer.LecturerPassword, module.ModuleID, module.ModuleName 
            FROM lecturer 
            INNER JOIN module ON lecturer.CompanyID = module.CompanyID
            WHERE lecturer.LecturerID = $lectid";

    $result = mysqli_query($con, $sql);
    if(!$result) {
        echo "err" .mysqli_error($con);
        return;
    }
    while($row = mysqli_fetch_array($result)){
        $lectname = $row['LecturerName'];
        $lgender = $row['LecturerGender'];
        $lectmail = $row['LecturerEmail'];
        $lectpass = $row['LecturerPassword'];
        $lect_module = mysqli_query($con, "SELECT * FROM lecturer_module WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$row['LecturerID']."");
            if(!$lect_module) {
                echo "err" .mysqli_error($con);
                break;
            }
        $moduleidList = array();
        while ($module_data = mysqli_fetch_array($lect_module)) {
            $ModuleID = $module_data['ModuleID'];
            array_push($moduleidList, $ModuleID);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>
    <title>Admin|Profile Edit</title>
</head>

<body>
    
<!-- header -->
<?php require "common/header_admin.php"?>

<form class ="was-validated" action="admin_edit_lecturer_backend.php" method="post">

    <input type="hidden" name="lecturerid" value = "<?php echo $lectid; ?>"/>

    <input type="text" class="form-control is-invalid" id="floatingInput" name="lecturername" placeholder="Lecturer Name" required value = "<?php echo $lectname; ?>">

    <p class="text-uppercase fw-bold main-color m-2">Gender</p>
            <div class= "d-flex flex-wrap justify-content-around">
            <div>
            <input type="radio" name="lecturergender" <?php if($lgender=="male"){?> checked="true" <?php } ?> value="male"/> Male
            </div>
            <div>
            <input type="radio" name="lecturergender" <?php if($lgender=="female"){?> checked="true" <?php } ?> value="female"/> Female
            </div>
        
    <input type="email" class="form-control shadow-sm" id="stu-email-floatingInput" name="lecturermail" placeholder="Lecturer Email" required value = "<?php echo $lectmail?>">

    <input type="password" class="form-control shadow-sm" id="stu-pw-floatingInput" name="lecturerpass" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required value = "<?php echo $lectpass; ?>">

    <?php
        if (mysqli_num_rows($result) > 0){
            $recordnumber = count($moduleidList);
            foreach ($result as $modulerow){

                ?>
                <input type="checkbox" name="moduleselect[]" <?php for ($x= 0; $x < $recordnumber; $x++) { if($modulerow["ModuleID"] == $moduleidList[$x]) { ?>checked="true" <?php }} ?> value= <?php echo $modulerow['ModuleID'];   ?> > <?php echo $modulerow['ModuleName']; ?></input>
                <?php
                    }
                }
                else{
                    echo "No Module Found";
                }  
            
        ?>

    <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
    
</form>
</body>
</html>
