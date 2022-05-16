<?php
    session_start();

    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    require "common/conn.php";

    // retrieve drafted exam details
    $draftexamsql = "SELECT ExamID, ExamName, ExamDescription FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND isPublished LIKE 0 AND LecturerID = ".$_SESSION["userID"]."";
    $draftresult = mysqli_query($con, $draftexamsql);

    // retrieve published exam details
    $pubexamsql = "SELECT ExamID, ExamName, ExamDescription FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND isPublished LIKE 1 AND LecturerID = ".$_SESSION["userID"]."";
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
  <div style="text-align: right; padding-right: 160px;">
    <a class="btn btn-primary" href="lecturer_create_exam.php" role="button" style="border-radius: 10px;">Create Examination</a>
  </div>
  <br>

  <!-- Table listing for exam -->
  <div class= "d-flex flex-wrap justify-content-center" style="min-height: 550px;">
    
    <!-- table for drafted exam -->
    <div class ="bg-draftexam" style="background-color: whitesmoke; border-radius: 10px; border: 3px solid #73AD21; box-shadow: 1px 1px darkseagreen; margin-right: 50px;">
    <table class="table table-striped" style="width: 550px;">
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
                <td><a href="lecturer_delete_exam_backend.php?id= '.$data["ExamID"].'" class="btn btn-primary delete-confirm"><i class="bi bi-trash"></i></a></td>
                </tr>';
                echo $drafttable;
            }
          ?>
      </tbody>
    </table>
    </div>
    <br><br>

    <!-- table for published exam -->
    <div class ="bg-pubexam" style="background-color: white; border-radius: 10px; border: 3px solid #73AD21; box-shadow: 1px 1px darkseagreen; margin-left: 50px;">
    <table class="table table-striped" style="width: 550px;">
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
              <td><a href="lecturer_delete_exam_backend.php?id= '.$data["ExamID"].'" class="btn btn-primary delete-confirm"><i class="bi bi-trash"></i></a></td>
              </tr>';
              echo $pubtable;
          }
        ?>
    </tbody>
    </table>
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