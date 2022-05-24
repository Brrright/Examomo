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

  // get current datetime
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $date_clicked = date('Y-m-d H:i:s');

  // retrieve drafted exam details
  $draftexamsql = "SELECT ExamID, ExamName, ExamDescription FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND isPublished LIKE 0 AND LecturerID = ".$_SESSION["userID"]." AND ExamEndDateTime >= '$date_clicked'";
  $draftresult = mysqli_query($con, $draftexamsql);

  // retrieve published exam details
  $pubexamsql = "SELECT ExamID, ExamName, ExamDescription FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND isPublished LIKE 1 AND LecturerID = ".$_SESSION["userID"]." AND ExamEndDateTime >= '$date_clicked'";
  $pubresult = mysqli_query($con, $pubexamsql);
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Manage Exam</title>

  </head>
  <body>

  <!-- header -->
  <?php require "common/header_lecturer.php"?>
  <br>

  
  <div style="text-align: left; padding-left: 170px;">
    <h3 style="font-family: caveat; color: rgb(19, 13, 135); font-weight: bold;">Manage Examination</h5>
  </div>

  <!-- button to create new exam -->
  <div style="text-align: right; padding-right: 140px;">
    <a class="btn btn-primary" href="lecturer_create_exam.php" role="button" style="border-radius: 10px;">Create Examination</a>
  </div>
  <br>

<!-- Table listing for exam -->
<div class= "row px-auto justify-content-center" style="min-height: 450px; margin: auto;">
    
    <!-- table for drafted exam -->
    <div class="col-xl-5">
    <div class ="shadow p-3 mb-5 bg-draftexam" style="background-color: white; border-radius: 10px; margin: 10px auto;">
    <table class="table table-striped" style="100%">
      <colgroup>
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 40%;">
        <col span="1" style="width: 15%;">
        <col span="1" style="width: 15%;">
      </colgroup>
      <thead>
        <p class="text-uppercase fw-bold main-color m-2 font-caveat lead">Drafted Exams</p>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>      
          <?php
            while ($data = mysqli_fetch_array($draftresult)) {
              $drafttable =
                '<tr>
                <th scope="row">'.$data["ExamID"].'</th>
                <td>'.$data["ExamName"].'</td>
                <td>'.$data["ExamDescription"].'</td>
                <td><a href="lecturer_edit_exam.php?id= '.$data["ExamID"].'" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                <td><a href="lecturer_delete_exam_backend.php?id= '.$data["ExamID"].'" class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></a></td>
                </tr>';
                echo $drafttable;
            }
          ?>
      </tbody>
    </table>
    </div>
    </div>
    

    <!-- table for published exam -->
    <div class="col-xl-5">
    <div class ="shadow p-3 mb-5 bg-pubexam" style="background-color: white; border-radius: 10px; margin: 10px auto;">
    <table class="table table-striped" style="100%">
    <colgroup>
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 40%;">
        <col span="1" style="width: 15%;">
        <col span="1" style="width: 15%;">
      </colgroup>
    <thead>
    <p class="text-uppercase fw-bold main-color m-2 font-caveat lead">Published Exams</p>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>      
        <?php
          while ($data = mysqli_fetch_array($pubresult)) {
            $pubtable =
              '<tr>
              <th scope="row">'.$data["ExamID"].'</th>
              <td>'.$data["ExamName"].'</td>
              <td>'.$data["ExamDescription"].'</td>
              <td><a href="lecturer_edit_exam.php?id= '.$data["ExamID"].'" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
              <td><a href="lecturer_delete_exam_backend.php?id= '.$data["ExamID"].'" class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></a></td>
              </tr>';
              echo $pubtable;
          }
        ?>
    </tbody>
    </table>
        </div>
    </div>
  </div>

  <!-- javascript to display confirmation when click delete button -->
  <script type="text/javascript">
    var elems = document.getElementsByClassName('delete-confirm');
    var confirmIt = function (e) {
        if (!confirm('Are you sure to delete exam?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
  </script>

<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>

</html>