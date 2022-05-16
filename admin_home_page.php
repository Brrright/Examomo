<?php require"common/conn.php";
  // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    </head>
<body>      
  <?php require "common/header_admin.php"  ?>
  <div class="admincontainer my-4 p-6 shadow p-3 mb-5 font-caveat">
      <div class="row">
        <div class="col-md-4">
          <img
            src="img/logo_big_with_text.png"
            class="hover-zoom img-fluid shadow-2-strong"
          />
        </div>
        <div class="col-md-6"><h3>
            <?php
              $sql = "SELECT AdminName FROM admin WHERE AdminID = ".$_SESSION['userID']."";
              $result = mysqli_query($con, $sql);

              $row = mysqli_fetch_array($result);
              echo "<br>"."Welcome, ";
              echo $row['AdminName']."."."<br>"."<br>";

            ?></h3>
        </div>
      </div>
  </div> 
  <center><h1 style="font-family: 'Caveat';">Your Management Functions</h1></center>     
    <div class="container">
      <div class="row justify-content-evenly">
        <div class="col-sm col-xs-12">
          <div class="card shadow p-3 mb-5">
              <img src="img/admin/students.png" class="card-img-top" style="border-radius: 15px;" alt="...">
              <div class="card-body">
                <h5 class="card-title">Students</h5>
                <p class="card-text">Student Management Functions.</p>
                <a href="admin_student_list.php" class="btn btn-primary">Manage Students</a>
              </div>
          </div>
        </div>
        <div class="col-sm col-xs-12">
          <div class="card shadow p-3 mb-5">
            <img src="img/admin/lecturer.png" class="card-img-top" style="border-radius: 15px;" alt="...">
            <div class="card-body">
              <h5 class="card-title">Lecturers</h5>
              <p class="card-text">Lecturer Management Functions.</p>
              <a href="admin_lecturer_list.php" class="btn btn-primary">Manage Lecturers</a>
            </div>
          </div>
        </div>
        <div class="col-sm col-xs-12">
          <div class="card shadow p-3 mb-5">
            <img src="img/admin/admin.png" class="card-img-top" style="border-radius: 15px;" alt="...">
            <div class="card-body">
              <h5 class="card-title">Admin</h5>
              <p class="card-text">Admin Management Functions</p>
              <a href="admin_account_list.php" class="btn btn-primary">Manage Admins</a>
            </div>
          </div>
        </div>
        <div class="col-sm col-xs-12">
          <div class="card shadow p-3 mb-5">
            <img src="img/admin/class.png" class="card-img-top" style="border-radius: 15px;" alt="...">
            <div class="card-body">
              <h5 class="card-title">Classes</h5>
              <p class="card-text">Class Management Functions</p>
              <a href="admin_class_list.php" class="btn btn-primary">Manage Classes</a>
            </div>
          </div>
        </div>
        <div class="col-sm col-xs-12">
          <div class="card shadow p-3 mb-5">
            <img src="img/admin/modules.png" class="card-img-top" style="border-radius: 15px;" alt="...">
            <div class="card-body">
              <h5 class="card-title">Modules</h5>
              <p class="card-text">Module Management Functions</p>
              <a href="admin_module_list.php" class="btn btn-primary">Manage Modules</a>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <?php require "common/footer_admin.php"  ?>
</body>