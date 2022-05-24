<?php require "common/conn.php";
  $sql= "SELECT lecturer.LecturerID, lecturer.LecturerName, lecturer.LecturerGender, lecturer.LecturerEmail, lecturer.LecturerPassword, company.CompanyName, module.ModuleName 
         FROM lecturer INNER JOIN company ON lecturer.CompanyID = company.CompanyID
         INNER JOIN lecturer_module ON lecturer.LecturerID = lecturer_module.LecturerID
         INNER JOIN module ON lecturer_module.ModuleID = module.ModuleID
         WHERE lecturer.LecturerID = ".$_SESSION["userID"]." AND lecturer.CompanyID = ".$_SESSION["companyID"]."";

$result = mysqli_query($con, $sql);
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
  <?php require "common/header_lecturer.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Lecturer Profile Page</h1></center>
  <div class="container">
  <div class="profilecontainer my-1 p-6 shadow p-3 mb-5 mx-auto">
  <div class="row g-0">
  <div class="col-sm-7 my-auto">
  <div class="text-start" style="font-size: 20px;">
    <?php
        $row = mysqli_fetch_array($result);

        $info = '
        <p class="text-uppercase fw-bold main-color m-2">
            Lecturer Details
        </p>
        <h6 class="text-uppercase fw-bold m-2">
        Lecturer Name : '.$row["LecturerName"].'
        </h6>

        <h6 class="text-uppercase fw-bold m-2">
        Lecturer Gender : '.$row["LecturerGender"].'
        </h6>

        <h6 class="text-uppercase fw-bold m-2">
        Lecturer Email : '.$row["LecturerEmail"].'
        </h6>

        <h6 class="text-uppercase fw-bold m-2">
        Lecturer Password : ••••••••
        </h6>
          <br>
        <h6 class="text-uppercase fw-bold m-2">
        Company Name : '.$row['CompanyName'].'
        </h6>
          <br>';

        echo $info;
      ?>
  </div>
        </div>
    <div class="col-sm-5">
      <img src="img/admin/lecturer.png" class="img-fluid rounded-end" style="border-radius: 50%;" alt="...">
    </div>
  </div>
</div>
<?php require "common/footer_lecturer.php";?>
</body>
</html>