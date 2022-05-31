<?php 
require "common/conn.php"

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
  <?php require "common/header_admin.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Add Feedback Response</h1></center>
  <div class="container">
    <div class="row g-0">
      <div class="col-sm-3">
        <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
          <div class="pill-nav">
            <a class="#">View Feedback List</a>
              <br>
            <a href="active">Respond to Enquiries</a>
          </div>
        </div>
      </div>
      <div class="col-sm-9">  
        <div class="profilecontainer my-4 p-4 shadow p-3 mb-5 font-caveat">
          <div class="col-md-8 mx-auto">
            <center><img src="img/admin/lecturer.png" class="img-thumbnail" style="border-radius: 15px;width:40%;height:40%;" alt="..."><center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require "common/footer_admin.php"  ?>
</body>
</html>