<?php 
  require "common/conn.php";
?>

<?php
    // get module info
    $classid ="SELECT ClassID, ClassName FROM class WHERE CompanyID =".$_SESSION['companyID']."";
    $result = mysqli_query($con, $classid);
    
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
  <center><h1 style="font-family: 'Caveat';">Add Students</h1></center>
  <div class="container">
    <div class="row g-0">
      <div class="col-sm-2">
        <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
          <div class="pill-nav">
            <a href="admin_account_list.php">View Admin List</a>
              <br>
            <a class="active">Add Admins</a>
          </div>
        </div>
      </div>
      <div class="col-sm-10">
      <form class="was-validated" action ="admin_add_admin_backend.php" method ="post">
        <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
        <div class="studentform">
        <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase fw-bold main-color m-2">
                        Admin name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="adminName" placeholder="Admin Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="adm-floatingInput">Admin Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase fw-bold main-color m-2">
                        Admin email
                        </p>
                        <div class="form-floating">
                            <input type="email" class="form-control shadow-sm" id="adm-email-floatingInput" name="adminEmail" placeholder="Admin Email" required>
                            <label class="text-secondary" for="adm-email-floatingInput">Admin Email</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase fw-bold main-color m-2">
                            password
                        </p>
                        <div class="form-floating">
                            <input type="password" class="form-control shadow-sm" id="adm-pw-floatingInput" name="adminPassword" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required>
                            <label class="text-secondary" for="adm-pw-floatingInput">Password</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <ul class="fw-light">
                            <li>At least one digit</li>
                            <li>At least one lowercase character</li>
                            <li>At least one uppercase character</li>
                            <li>At least one special character</li>
                            <li>At least 8 characters in length, but no more than 32.</li>
                        </ul>
                    </div>
                    <br>
                    <div class= "d-flex flex-wrap justify-content-around">
                    <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
                    </div>
                  </div>
            </div>
        </section>
    </form>
        </div>
      </div>
    </div>
  </div>
  <?php require "common/footer_admin.php"  ?>
</body>
</html>