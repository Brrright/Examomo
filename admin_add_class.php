<?php 
  require "common/conn.php";
?>

<?php
    // get module info
    $moduleid ="SELECT ModuleID, ModuleName FROM module WHERE CompanyID =".$_SESSION['companyID']."";
    $result = mysqli_query($con, $moduleid);
    
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
  <center><h1 style="font-family: 'Caveat';">Add Classes</h1></center>
  <div class="container">
    <div class="row g-0">
      <div class="col-sm-3">
        <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
          <div class="pill-nav">
            <a href="admin_class_list.php">View Class List</a>
              <br>
            <a class="active">Add Classes</a>
          </div>
        </div>
      </div>
      <div class="col-sm-9"> 
        <form class="was-validated" action ="admin_add_class_backend.php" method ="post"> 
          <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
            <div class="mx-auto" style="width:90%">
              <p class="text-uppercase fw-bold main-color m-2">
                  class name
              </p>
              <div class="form-floating">
                  <input type="text" class="form-control shadow-sm" id="cls-floatingInput" name="className" placeholder="Class Name" pattern="[a-zA-Z][a-zA-Z0-9- ]{3,}" required>
                  <label class="text-secondary" for="cls-floatingInput">Class Name</label>
                  <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                  <div class="invalid-feedback">Please fill out this field with valid input.</div>
              </div>
              <p class="text-uppercase fw-bold main-color m-2">
                  RELATED MODULE
              </p>
              <select name ="moduleid" id="module-selection" class="form-select fw-light shadow-sm" style="height:58px;" required>
                  <option value="">Please select the related module</option>
                  <?php
                    while ($data = mysqli_fetch_array($result)) {
                        $modulelist ='<option value ='.$data["ModuleID"].'>'.$data["ModuleName"].'</option>';
                        echo $modulelist;
                  }
                  ?>
              </select>
            </div>
            <br>
          <div class= "d-flex flex-wrap justify-content-around">
            <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
          </div>
        </form>
      </div>
  </div>
  <?php require "common/footer_admin.php"  ?>
</body>
</html>