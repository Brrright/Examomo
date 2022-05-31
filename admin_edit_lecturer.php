<?php
    require "common/conn.php";
     // identify if user logged in
     if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
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
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/commonCSS.css">
    <title>Admin|Lecturer Edit</title>
</head>

<body>
    
<!-- header -->
<?php require "common/header_admin.php"?>
<center><h1 style="font-family: 'Caveat';">Edit Lecturers Details</h1></center>
<div class="container">
    <form class ="was-validated" action="admin_edit_lecturer_backend.php" method="post">
    <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
    <div class="lecturerform">
    <div class="mx-auto" style="width:90%">
        <input type="hidden" name="lecturerid" value = "<?php echo $lectid; ?>"/>
        <p class="text-uppercase fw-bold main-color m-2">
        Lecturer name
        </p>
    <div class="form-floating">
    <input type="text" class="form-control is-invalid" id="floatingInput" name="lecturername" placeholder="Lecturer Name" required value = "<?php echo $lectname; ?>">
        <label class="text-secondary" for="stu-floatingInput">Lecturer Name</label>
    </div>
    <p class="text-uppercase fw-bold main-color m-2">Gender</p>
    <div class= "d-flex flex-wrap justify-content-around">
        <div>
            <input type="radio" name="lecturergender" <?php if($lgender=="male"){?> checked="true" <?php } ?> value="male"/> Male
            </div>
        <div>
            <input type="radio" name="lecturergender" <?php if($lgender=="female"){?> checked="true" <?php } ?> value="female"/> Female
            </div>
    </div>
    <p class="text-uppercase fw-bold main-color m-2">Lecturer Email</p>
    <input type="email" class="form-control shadow-sm" id="stu-email-floatingInput" name="lecturermail" placeholder="Lecturer Email" required value = "<?php echo $lectmail?>">
    <p class="text-uppercase fw-bold main-color m-2">Password</p>
    <input type="password" class="form-control shadow-sm" id="stu-pw-floatingInput" name="lecturerpass" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required value = "<?php echo $lectpass; ?>">
    <p class="text-uppercase fw-bold main-color m-2">Related Module</p>
    <?php
        if (mysqli_num_rows($result) > 0){
            $recordnumber = count($moduleidList);
            foreach ($result as $modulerow){

                ?>
                <div>
                <input type="checkbox" name="moduleselect[]" <?php for ($x= 0; $x < $recordnumber; $x++) { if($modulerow["ModuleID"] == $moduleidList[$x]) { ?>checked="true" <?php }} ?> value= <?php echo $modulerow['ModuleID'];   ?> ></input>
                <label><?php echo $modulerow['ModuleName']; ?></label>
                <?php
                    }
                }
                else{
                    echo "No Module Found";
                }  
            
        ?>
        <br>
    <div class="d-flex flex-wrap justify-content-around">
    <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
    </div>
</form>
</body>
</html>
