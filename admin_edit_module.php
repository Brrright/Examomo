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
    $Moduleid = $_GET['id'];



    //sql to get student details
    $sql = "SELECT ModuleID, ModuleName
            FROM module
            WHERE ModuleID = $Moduleid";

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $mID= $row['ModuleID'];
        $mName= $row['ModuleName'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    <title>Admin | Module Edit</title>
</head>
<body>

<!-- header -->
<?php require "common/header_admin.php"?>
<center><h1 style="font-family: 'Caveat';">Edit Accounts</h1></center>
<div class="container">
    <form class ="was-validated" action="admin_edit_module_backend.php" method="post">
        <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
            <div class="moduleform">
                <div class="mx-auto" style="width:90%">
                    <input type="hidden" name="moduleid" value = "<?php echo $Moduleid; ?>"/>
                    <p class="text-uppercase fw-bold main-color m-2">
                    Module name
                    </p>
                    <div class="form-floating">
                        <input type="text" class="form-control is-invalid" id="floatingInput" name="modulename" placeholder="Module Name" required value = "<?php echo $mName?>">
                        <label class="text-secondary" for="stu-floatingInput">Module Name</label>
                    </div>
                    <br>
                    <div class= "d-flex flex-wrap justify-content-around">
                        <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>