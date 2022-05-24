<?php require "common/conn.php";

$studentsql = "SELECT student.StudentID, student.StudentName, student.StudentGender, student.StudentEmail, student.StudentPassword, class.ClassName, company.CompanyName
              FROM ((student INNER JOIN company ON student.CompanyID = company.CompanyID) INNER JOIN class ON student.ClassID = class.ClassID)
              WHERE student.StudentID = ".$_SESSION["userID"]." AND student.CompanyID = ".$_SESSION["companyID"]."" ;

$studentprofileresult = mysqli_query($con, $studentsql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    </head>
<body>      
  <?php require "common/header_student.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Student Profile Page</h1></center>
  <div class="container">
  <div class="profilecontainer my-1 p-6 shadow p-3 mb-5 mx-auto">
  <div class="row g-0">
  <div class="col-sm-7 my-auto">
  <div class="text-start" style="font-size: 20px;">
    <?php
    $studentprofile = mysqli_fetch_array($studentprofileresult);

    $info = '
        <p class="text-uppercase fw-bold main-color m-2">
            Student Details
        </p>
        <h6 class="text-uppercase fw-bold m-2">
          Student Name  : '.$studentprofile["StudentName"].'</h6>
        <h6 class="text-uppercase fw-bold m-2">
          Student Gender  : '.$studentprofile["StudentGender"].'</h6>
        <h6 class="text-uppercase fw-bold m-2">  
          Student Email  : '.$studentprofile["StudentEmail"].'</h6>
        <h6 class="text-uppercase fw-bold m-2">
          Student Password  : '.$studentprofile["StudentPassword"].'</h6>
        <h6 class="text-uppercase fw-bold m-2">
          Student Class Name  : '.$studentprofile["ClassName"].'</h6>
        <h6 class="text-uppercase fw-bold m-2">
          Student Organization Name  : '.$studentprofile["CompanyName"].'</h6>';

          echo $info;

  ?> 
  </div>
        </div>
    <div class="col-sm-5">
      <img src="img/admin/students.png" class="img-fluid rounded-end" style="border-radius: 50%;" alt="...">
    </div>
  </div>
</div>
<?php require "common/footer_student.php";?>
</body>
</html>