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
    $studentid = $_GET['id'];

    $classid ="SELECT ClassID, ClassName FROM class WHERE CompanyID =".$_SESSION['companyID']."";
    $classresult = mysqli_query($con, $classid);

    //sql to get student details
    $sql = "SELECT *
            FROM student INNER JOIN class ON student.ClassID = class.ClassID
            WHERE student.StudentID = $studentid";

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $sID= $row['StudentID'];
        $sName= $row['StudentName'];
        $sGender= $row['StudentGender'];
        $smail= $row['StudentEmail'];
        $spass= $row['StudentPassword'];
        $access = $row['isBanned'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    <title>Student|Student Profile Edit</title>
</head>
<body>
<?php require "common/header_admin.php"?>
<center><h1 style="font-family: 'Caveat';">Edit Student Details</h1></center>
<div class="container">
          <form class ="was-validated" action="admin_edit_student_backend.php" method="post">
          <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
          <div class="studentform">
          <div class="mx-auto" style="width:90%">
            <input type="hidden" name="studentid" value = "<?php echo $studentid; ?>"/>
            <p class="text-uppercase fw-bold main-color m-2">
            Student name
            </p>
            <div class="form-floating">
              <input type="text" class="form-control is-invalid" id="floatingInput" name="studentname" placeholder="Student Name" required value = "<?php echo $sName?>">
              <label class="text-secondary" for="stu-floatingInput">Student Name</label>
            </div>
            <p class="text-uppercase fw-bold main-color m-2">Gender</p>
            <div class= "d-flex flex-wrap justify-content-around">
            <div>
            <input type="radio" name="studentgender" <?php if($sGender=="male"){?> checked="true" <?php } ?> value="male"/> Male
            </div>
            <div>
            <input type="radio" name="studentgender" <?php if($sGender=="female"){?> checked="true" <?php } ?> value="female"/> Female
            </div>
            </div>
            <p class="text-uppercase fw-bold main-color m-2">Student Email</p>
            <input type="email" class="form-control shadow-sm" id="stu-email-floatingInput" name="studentmail" placeholder="Student Email" required value = "<?php echo $smail?>">
            <p class="text-uppercase fw-bold main-color m-2">Password</p>
            <input type="password" class="form-control shadow-sm" id="stu-pw-floatingInput" name="studentpass" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required value = "<?php echo $spass ?>">
            <p class="text-uppercase fw-bold main-color m-2">Student Class</p>
            <select name="studentclass" id="class-selection-stu" class="form-select fw-light shadow-sm" style="height:58px;" required>
                <?php
                    while ($classrow = mysqli_fetch_array($classresult)){
                        if ($classrow['ClassID'] == $sclass){
                            echo '<option value = '.$classrow['ClassID'].' selected>'.$classrow['ClassName'].'</option>';              
                        }
                        else{
                            echo '<option value = '.$classrow['ClassID'].'>'.$classrow['ClassName'].'</option>';
                        }
                    }
                ?>
            </select>
            <br>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="access" value="empty" <?php if($access==""){?> checked="true" <?php } ?>>
                <label class="form-check-label" for="flexSwitchCheckChecked">Allow User Access</label>
            </div>

            <br>
            <div class= "d-flex flex-wrap justify-content-around">
            <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php require "common/footer_admin.php";?>
</body>
</html>

<?php
}
?>