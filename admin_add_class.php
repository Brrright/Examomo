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
              <div class="form-floating" id="name-field">
                  <input type="text" v-model="name" @keyup="checkName()" class="form-control shadow-sm" id="cls-floatingInput" name="className" placeholder="Class Name" pattern="[a-zA-Z][a-zA-Z0-9- ]{3,}" required>
                  <label class="text-secondary" for="cls-floatingInput">Class Name</label>
                  <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                  <div class="invalid-feedback">Please fill out this field with valid input.</div>
                  <span class="text-danger" v-bind:id="[isAvailable?'notavailable':'available']">{{responseMessage}}</span>
              </div>
              <p class="text-uppercase fw-bold main-color m-2">
                  RELATED MODULE
              </p>

                  <?php
                    if (mysqli_num_rows($result) > 0) {
                      foreach ($result as $mod){
                  ?>
                  <input type="checkbox" name="moduleselect[]" value= <?php echo $mod['ModuleID'];?> > <?php echo $mod['ModuleName']; ?></input>
                  <?php
                      }
                    } 
                    else{
                        echo "No Module Found";
                    }
                  ?>
             </div>
            <br>
          <div class= "d-flex flex-wrap justify-content-around">
            <button id="submit-btn" type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
          </div>
        </form>
      </div>
  </div>
  <?php require "common/footer_admin.php"  ?>
  <script src="https://unpkg.com/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
    <script>
        var app = new Vue({
            el: '#name-field',
            data: {
                name: '',
                isAvailable: 0,
                responseMessage: ''
            },
            methods: {
                checkName: function(){
                    var name = this.name.trim();
                    if(name != ''){
                
                    axios.get('backend_check_name.php?action=class', {
                        params: {
                          name: name
                        }
                    })
                    .then(function (response) {
                        app.isAvailable = response.data;
                        if(response.data == 0){
                        app.responseMessage = "";
                        document.getElementById("submit-btn").disabled = false;
                        }else{
                        app.responseMessage = "Name Has been used.";
                        }
                    })
                    .then(function() {
                      var checkEmail = document.getElementById("notavailable");
                      if (checkEmail != null) {
                        document.getElementById("submit-btn").disabled = true;
                      }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    }else{
                        this.responseMessage = "";
                        
                    }
                }
            }
        })
    </script>
</body>
</html>