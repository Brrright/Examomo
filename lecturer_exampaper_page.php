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

    // retrieve drafted exam details
    $draftpapersql = "SELECT exam_paper.PaperID, exam_paper.PaperName, module.ModuleName FROM exam_paper INNER JOIN module ON exam_paper.ModuleID = module.ModuleID WHERE exam_paper.CompanyID = ".$_SESSION['companyID']." AND exam_paper.PaperName LIKE '%(drafted)%' AND exam_paper.LecturerID = ".$_SESSION["userID"]."";
    $draftpaper = mysqli_query($con, $draftpapersql);

    // retrieve published exam details
    $pubpapersql = "SELECT exam_paper.PaperID, exam_paper.PaperName, module.ModuleName FROM exam_paper INNER JOIN module ON exam_paper.ModuleID = module.ModuleID WHERE exam_paper.CompanyID = ".$_SESSION['companyID']." AND exam_paper.PaperName NOT LIKE '%(drafted)%' AND exam_paper.LecturerID = ".$_SESSION["userID"]."";
    $pubpaper = mysqli_query($con, $pubpapersql);
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Manage Exam Paper</title>

  </head>
  <body>

  <!-- header -->
  <?php require "common/header_lecturer.php"?>
  <br>

  
  <div style="text-align: left; padding-left: 170px;">
    <h3 style="font-family: caveat; color: rgb(19, 13, 135); font-weight: bold;">Manage Examination Paper</h5>
  </div>

  <!-- button to create new exam -->
  <div style="text-align: right; padding-right: 140px;">
    <a class="btn btn-primary" href="lecturer_create_exampaper.php" role="button" style="border-radius: 10px;">Create Examination Paper</a>
  </div>
  <br>

  <!-- Table listing for exam paper-->
  <div class= "row px-auto justify-content-center" style="min-height: 450px; margin: auto;">
    
    <!-- table for drafted exam -->
    <div class="col-xl-5">
    <div class ="shadow p-3 mb-5 bg-drafted" style="background-color: whitesmoke; border-radius: 10px; margin: 10px auto;">
    <table class="table table-striped" style="100%">
      <colgroup>
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 30%;">
        <col span="1" style="width: 30%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 10%;">
      </colgroup>
      <thead>
        <p class="text-uppercase fw-bold main-color m-2 font-caveat lead">Drafted Exam Papers</p>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Module</th>
          <th scope="col">Add</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>      
          <?php
            while ($data = mysqli_fetch_array($draftpaper)) {
              $drafttable =
                '<tr>
                <th scope="row">'.$data["PaperID"].'</th>
                <td>'.$data["PaperName"].'</td>
                <td>'.$data["ModuleName"].'</td>
                <td><a href="?id= '.$data["PaperID"].'" class="btn btn-primary"><i class="bi bi-plus-circle"></i></a></td>
                <td><a href="lecturer_edit_exampaper.php?id= '.$data["PaperID"].'" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                <td><a href="lecturer_delete_exampaper_backend.php?id= '.$data["PaperID"].'" class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></a></td>
                </tr>';
                echo $drafttable;
            }
          ?>
      </tbody>
    </table>
    </div>
    </div>
    <br><br>

    <!-- table for created exam paper-->
    <div class="col-xl-5">
    <div class ="shadow p-3 mb-5 bg-created" style="background-color: white; border-radius: 10px; margin: 10px auto;">
    <table class="table table-striped" style="100%">
      <colgroup>
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 30%;">
        <col span="1" style="width: 30%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 10%;">
      </colgroup>
    <thead>
    <p class="text-uppercase fw-bold main-color m-2 font-caveat lead">Published Exam Papers</p>
      <tr>
      <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Module</th>
          <th scope="col">Add</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>      
        <?php
          while ($data = mysqli_fetch_array($pubpaper)) {
            $pubtable =
              '<tr>
              <th scope="row">'.$data["PaperID"].'</th>
              <td>'.$data["PaperName"].'</td>
              <td>'.$data["ModuleName"].'</td>
              <td><a href="?id= '.$data["PaperID"].'" class="btn btn-primary"><i class="bi bi-plus-circle"></i></a></td>
              <td><a href="lecturer_edit_exampaper.php?id= '.$data["PaperID"].'" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
              <td><a href="lecturer_delete_exampaper_backend.php?id= '.$data["PaperID"].'" class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></a></td>
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
        if (!confirm('Are you sure to delete exam paper?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
  </script>

<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>

</html>